@include('layouts.app')
@extends('base')
@section('main')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
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
            var table = document.getElementById("myTable");

            document.getElementById('waterLevel').innerHTML = data.data.data[1];
            document.getElementById('waterCurrent').innerHTML = data.data.data[0];
            document.getElementById('waterTemp').innerHTML = data.data.data[2];
          }

          getData();
          setInterval(() => {
            getData();
          }, 60000);
        </script>
          <h2>Water Level:&nbsp;<span id="waterLevel">0</span> m</h2>
          <h2>Water Current Velocity:&nbsp;<span id="waterCurrent"> 0 </span> m/s</h2>
          <h2>Water Temperature:&nbsp;<span id="waterTemp"> 0 </span> &#x2103;</h2>
          <!-- <button onclick="refresh()">Refresh</button> -->
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
      <!-- <href href="{{URL::route('index')}}" >Enter</href> -->
    </content>
    <canvas id="myChart3"></canvas>
    </div>
    <br>
    </div>
  </section>
<div>
</div>
<script>
  function refresh(){
    getData();
    updateChart();
    updateChart2();
  }

  function processInput(){
    // var start= document.getElementById("start").value.split('-');
    // var end= document.getElementById("end").value.split('-');
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

  async function updateChart(){  
    try {
      var response = await axios.get("{{ route('api.chart',$river->id) }}");
      myChart.data.labels = response.data.labels;
      myChart.data.datasets[0].data = response.data.data;
      myChart.update();
    } catch (e) {
      console.error(e);
    }
  }

  async function updateChart2(){
    try {
      var response = await axios.get("{{ route('api.getFlowRate',$river->id) }}");
      myChart2.data.labels = response.data.labels;
      myChart2.data.datasets[0].data = response.data.data;
      myChart2.update();
    } catch (e) {
      console.error(e);
    }
  }

  var updateChart3 = function() {

    var start= document.getElementById("start").value;
    var end= document.getElementById("end").value;

    $.ajax({
      url: "{{ route('api.process')}}",
      type: 'POST',
      dataType: 'json',
      data: { start: start, end : end,id: {{$river->id}}},
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
      }
    });
  }
  
  updateChart();
  updateChart2();
  setInterval(() => {
    updateChart();
    updateChart2();
  }, 60000);

</script>
<div class="container">    
  <br />
  <h3 align="center">Table</h3>
  <br/>
  <br/>
  <div class="row input-daterange">
      <div class="col-md-4">
          <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" readonly />
      </div>
      <div class="col-md-4">
          <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" readonly />
      </div>
      <div class="col-md-4">
          <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
          <button type="button" name="refresh" id="refresh" class="btn btn-default">Refresh</button>
      </div>
  </div>
  <br />
  <div class="table-responsive">
    <table class="table table-bordered table-striped" id="order_table">
      <thead>
      <tr>
          <th>Created At</th>
          <th>Water Level</th>
          <th>Water Velocity</th>
          <th>Temperature</th>
      </tr>
      </thead>
    </table>
  </div>
</div>
<!-- Pusher -->
<!-- <script src="https://js.pusher.com/5.1/pusher.min.js"></script>

<script>
  // Enable pusher logging - don't include this in production
  Pusher.logToConsole = true;

  var pusher = new Pusher('9d370124fc2b8ba7d2f8', {
    cluster: 'ap1',
    forceTLS: true
  });

  var channel = pusher.subscribe('my-channel');
  channel.bind('my-event', function(data) {
    console.log('test')
  });
</script> -->

<script>
  $(document).ready(function(){
  $('.input-daterange').datepicker({
    todayBtn:'linked',
    format:'yyyy-mm-dd',
    autoclose:true
  });

  load_data();

  function load_data(from_date = '', to_date = '')
  {
    $('#order_table').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url:'{{ route("meta",$river->id) }}',
        data:{from_date:from_date, to_date:to_date}
      },
      columns: [
        {
        data:'date_taken',
        name:'date_taken'
        },
        {
        data:'level',
        name:'level'
        },
        {
        data:'velocity',
        name:'velocity'
        },
        {
        data:'temperature',
        name:'temperature'
        },
      ]
    });
 }

  $('#filter').click(function(){
  var from_date = $('#from_date').val();
  var to_date = $('#to_date').val();
  if(from_date != '' &&  to_date != '')
  {
    $('#order_table').DataTable().destroy();
    load_data(from_date, to_date);
  }
  else
  {
    alert('Both Date is required');
  }
  });

  $('#refresh').click(function(){
  $('#from_date').val('');
  $('#to_date').val('');
  $('#order_table').DataTable().destroy();
  load_data();
 });
});
</script>
@endsection

@push('scripts')
<!-- <script>
  $(document).ready( function () {
    $('.table').DataTable();
  });
</script> -->
@endpush