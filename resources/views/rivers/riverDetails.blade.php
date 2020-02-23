@include('layouts.app')
@extends('base')
@section('main')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<div class="row">
<div class="col-sm-12">
    <h1 class="display-3">{{$river->name}}</h1> 
    <section id="contact">
    <div class="container d-flex flex-column text-center">
      <div class="row">
        <div class="col-lg-12 d-flex flex-column text-center">
        <script> 
          
          async function getData() {
            // console.log("HI");
            var data = await axios.get("{{ route('api.chartDetails',$river->id) }}");
            // console.log("FUCK");
            var table = document.getElementById("myTable");
            // const reader = data.body.getReader();
            // console.log(data.data);

            document.getElementById('waterLevel').innerHTML = data.data.data[1];
            document.getElementById('waterCurrent').innerHTML = data.data.data[0];
            document.getElementById('waterTemp').innerHTML = data.data.data[2];
          }

          setInterval(() => {
            getData();
          }, 1000);
        </script>
          <h2>Water Level:<span id="waterLevel"> 0</span> m</h2>
          <h2>Water Current Velocity:<span id="waterCurrent"> 0 </span> m/s</h2>
          <h2>Water Temperature:<span id="waterTemp"> 0 </span> &#x2103;</h2>
        </div>
      </div>
    </br>
    </br>
      <div class="row">
          <div class="col-6 text-center">
            <h2>Water Level vs. Time</h2>            
            <canvas id="myChart"></canvas>
            <!-- <iframe width="450" height="260" style="border: 1px solid #cccccc;" src="https://thingspeak.com/channels/952196/charts/1?days=3&bgcolor=%23ffc0cb&color=%23add8e6&dynamic=true&results=1440&title=Water+Velocity+%28m%2Fs%29&type=line&xaxis=Date&yaxis=Velocity+%28m%2Fs%29&update=60"></iframe>
            <iframe width="450" height="260" style="border: 1px solid #cccccc;" src="https://thingspeak.com/channels/952196/charts/2?bgcolor=%23ffffff&color=%23d62020&dynamic=true&title=Water+Level+%28m%29&type=line&xaxis=Date&yaxis=Water+Level+%28m%29&start=2019-12-29&end=2020-02-04"></iframe>
            <iframe width="450" height="260" style="border: 1px solid #cccccc;" src="https://thingspeak.com/apps/matlab_visualizations/329340"></iframe> -->

          </div>
          <div class="col-6 text-center">
            <h2>Hydrograph</h2>            
            <canvas id="myChart2"></canvas>
          </div>
      </div>
    </br>
    </br>
    <div>
    <content>
      <form>
        Date Picker(day/month/year):
        <br>
        <label for="start">Start date:</label>
        <input type="date" id="start" name="start" value="" ><br><br>
        <label for="start">End date:</label>
        <input type="date" id="end" name="end" value="" ><br>
        <a class="rotate-button">
        </a>
      </form>
      <button class="rotate-button-face" onclick="processInput()" type="submit">Enter</button>
    </content>
    <canvas id="myChart3"></canvas>
    </div>
    <br>
    </div>
  </section>
<div>
</div>
<script>
  function processInput(){
    // console.log(document.getElementById("start").value);
    // console.log(document.getElementById("end").value);

    var start= document.getElementById("start").value.split('-');
    var end= document.getElementById("end").value.split('-');
    // console.log(start[0]);
    // console.log(start[1]);
    // console.log(start[2]);

    // console.log(end[0]);
    // console.log(end[1]);
    // console.log(end[2]);
    // var url = 'https://api.thingspeak.com/channels/952196/fields/2.json?api_key=RGBK34NEJJV41DY7&start='+start[0]+'-'+start[1]+'-'+start[2]+'&end='+end[0]+'-'+end[1]+'-'+end[2];
    // console.log(url);
    // var data = axios.get(url);
    // console.log(data.response);
    // var data = axios.get(url)
    //   .then((response) => {
    //     console.log(response.data.feeds); 
    //     return response.data.feeds;
    //   });
    // console.log(data);
    updateChart3();

  }
  var ctx = document.getElementById("myChart");
  var ctx2 = document.getElementById("myChart2");
  var ctx3 = document.getElementById("myChart3");
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: [],
      datasets: [ {
        label: 'Water Level',
        data: [],
        borderWidth: 1
      } ]
    },
    options: {
      scales: {
        xAxes:[],
        yAxes: [{
          ticks: {
            beginAtZero:true
          }
        }]
      }
    }
  });

  var myChart2 = new Chart(ctx2, {
    type: 'line',
    data: {
      labels: [],
      datasets: [{
        label: 'Flow Rate',
        data: [],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        xAxes: [],
        yAxes: [{
          ticks: {
            beginAtZero:true
          }
        }]
      }
    }
  });

  var myChart3 = new Chart(ctx3, {
    type: 'line',
    data: {
      labels: [],
      datasets: [{
        label: 'Data from start to end',
        data: [],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        xAxes: [],
        yAxes: [{
          ticks: {
            beginAtZero:true
          }
        }]
      }
    }
  });

  var updateChart = function() {
    $.ajax({
      url: "{{ route('api.chart',$river->id) }}",
      type: 'GET',
      dataType: 'json',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data) {
        // console.log("JARI");
        myChart.data.labels = data.labels;
        myChart.data.datasets[0].data = data.data;
        myChart.update();
      },
      error: function(data){
        console.log("ERROR");
      }
    });
  }

  var updateChart2 = function() {
    $.ajax({
      url: "{{ route('api.getFlowRate',$river->id) }}",
      type: 'GET',
      dataType: 'json',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data) {
        myChart2.data.labels = data.labels;
        myChart2.data.datasets[0].data = data.data;
        myChart2.update();
      },
      error: function(data){
        console.log("ERROR2");
        // console.log(data);
      }
    });
  }

  var updateChart3 = function() {

    var start= document.getElementById("start").value;
    var end= document.getElementById("end").value;

    $.ajax({
      url: "{{ route('api.process') }}",
      type: 'POST',
      dataType: 'json',
      data: { start: start, end : end, id: {{$river->id}}},
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data) {

        myChart3.data.labels = data.labels;
        myChart3.data.datasets[0].data = data.data;
        myChart3.update();

      },
      error: function(data){
        console.log("ERROR3");
        // console.log(data.data);
      }
    });
  }
  
  updateChart();
  updateChart2();
  setInterval(() => {
    updateChart();
    updateChart2();
  }, 1000);

</script>

<!-- <div class="container-fluid">
 <div class="row">
  <div class="col-12">
   <div class="card">
    <div class="card-block">
     <table></table>
    </div>
   </div>
  </div>
 </div>
 <div class="row">
  <div class="col-12">
   <div class="card">
    <div class="card-block">
     <button class="btn btn-primary" id="add">Add 1000 Rows</button>
    </div>
   </div>
  </div>
 </div>	
</div> -->

<script>
var highlightNumbers = function(xhr) {
    // Parse the JSON string
    var data = JSON.parse(xhr.responseText);
    data = data.temp;
    console.log(data);
    var obj = {
      // Quickly get the headings
      headings: Object.keys(data[0]),
      // data array
      data: []
    };

    // Loop over the objects to get the values
    for ( var i = 0; i < data.length; i++ ) {
        obj.data[i] = [];
        for (var p in data[i]) {
            if( data[i].hasOwnProperty(p) ) {
                obj.data[i].push(data[i][p]);
            }
        }
    }
    // Return the formatted data	
    return JSON.stringify(obj.data);
}

var datatable = new DataTable('table', {
  ajax: {
    url:"{{ route('api.getFields') }}",
    load: highlightNumbers
  },
	perPageSelect: [10, 20, 30, 40, 50, 100, 200, 300, 400, 500, 1000],
	perPage: 10,
	data: {
		"headings": [
      "Created_at",
			"Entry ID",
			"Water Level",
			"Water Velocity",
			"Temperature"
		],
		"data": []
	},	
});

document.getElementById("add").addEventListener("click", function(e) {
	datatable.insert({
		data: datatable.options.data.data
	});
});

// setInterval(() => {
//   datatable.refresh();
//   console.log("hi");
// }, 1000);
</script>
@endsection

@push('scripts')
<script>
// setInterval(function(){ 
//   $(document).ready( function () {

//     $('.table').DataTable();
//   });
// }, 1000);

</script>
@endpush