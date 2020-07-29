@extends('layouts.app')
@section('content')

<!-- new -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">

<style>
   .box
   {
    width:900px;
    padding:10px;
    background-color:#fff;
    border:1px solid #ccc;
    border-radius:5px;
    margin-top:10px;
   }
   th.sorting,th.sorting_desc,th.sorting_asc{
    width: 200px;
   }
</style>
<br/>
<a href="{{ route('rivers.index')}}">&#8592;Back</a>
<div class="row">
  <div class="col">
    <div class="card" id="rname">
      <div class="container">
        <h1 class="display-3">{{$river->name}}</h1> 
        <div class="line"></div>
        <h3>Location: {{$river->location}}</h3> 
      </div>
    </div>
  </div>

  <div class="col text-center" id ="chart1">
    <h2>Water Level vs. Time</h2>            
    <canvas id="myChart"></canvas>
    <!-- <iframe width="450" height="260" style="border: 1px solid #cccccc;" src="https://thingspeak.com/channels/952196/charts/1?days=3&bgcolor=%23ffc0cb&color=%23add8e6&dynamic=true&results=1440&title=Water+Velocity+%28m%2Fs%29&type=line&xaxis=Date&yaxis=Velocity+%28m%2Fs%29&update=60"></iframe>
    <iframe width="450" height="260" style="border: 1px solid #cccccc;" src="https://thingspeak.com/channels/952196/charts/2?bgcolor=%23ffffff&color=%23d62020&dynamic=true&title=Water+Level+%28m%29&type=line&xaxis=Date&yaxis=Water+Level+%28m%29&start=2019-12-29&end=2020-02-04"></iframe>
    <iframe width="450" height="260" style="border: 1px solid #cccccc;" src="https://thingspeak.com/apps/matlab_visualizations/329340"></iframe> -->

  </div>
</div>

<br/>

<div class="row" style="display-flex">
  <div class="col text-center">
    <script>
      async function getData() {
        var data = await axios.get("{{ route('api.chartDetails',$river->id) }}");
        var table = document.getElementById("myTable");
        console.log(data.data);
        document.getElementById('waterLevel').innerHTML = data.data.data[1];
        document.getElementById('waterCurrent').innerHTML = data.data.data[0];
        document.getElementById('waterTemp').innerHTML = data.data.data[3];
      }

      getData();
      setInterval(() => {
        getData();
      }, 60000);
    </script>

    <div id="display">
      <h2>
        River Info
      </h2>
      <div class="hint  hint--top" data-hint="Water Level" style="display:inline-block;vertical-align:bottom;">
        <img src='/images/arrow.png' width="50px" id="arrow">
      </div>

      <div style="display:inline-block;">
        <h2>&nbsp;<span id="waterLevel">0</span> m</h2>
      </div>

      <br/>
      <div class="hint  hint--top" data-hint="Water Velocity" style="display:inline-block;vertical-align:bottom;">
        <img src='/images/wave.png' width="50px" id="wave">
      </div>
      <div style="display:inline-block;">
        <h2>&nbsp;<span id="waterCurrent"> 0 </span> m/s</h2>
      </div>

      <br/>
      <div class="hint  hint--top" data-hint="Water Temperature" style="display:inline-block;vertical-align:bottom;">
        <img src='/images/thermometer.png' width="50px" id="thermometer">
      </div>
      <div style="display:inline-block;">
        <h2>&nbsp;<span id="waterTemp"> 0 </span> &#x2103;</h2>
      </div>

    </div>
  </div>

  <div class="col text-center" id ="chart2">
    <h2>Hydrograph</h2>            
    <canvas id="myChart2"></canvas>
  </div>
  
</div>

<script>
  function refresh(){
    getData();
    updateChart();
    updateChart2();
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

  async function updateChart(){  
    try {
      var response = await axios.get("{{ route('api.chart',$river->id) }}");
      myChart.data.labels = response.data.labels;
      myChart.data.datasets[0].data = response.data.data;
      myChart.update();
    } catch (e) {
      console.log("ERROR1");
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
      console.log("ERROR2");
      console.error(e);
    }
  }
  
  updateChart();
  updateChart2();
  setInterval(() => {
    updateChart();
    updateChart2();
  }, 60000);

</script>
<br/>
<div class="container box">
  <h3 align="center">Data in Table Format</h3>
  <br/>
  <div class="row input-daterange" style="width:100%">
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
    <table class="table table-bordered table-striped " id="order_table">
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
 

<script>
  $(document).ready(function(){
    $('.input-daterange').datepicker({
      todayBtn:'linked',
      format:'yyyy-mm-dd',
      autoclose:true,
    });

    load_data();

    function load_data(from_date = '', to_date = '')
    {
      $('#order_table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 'pdf','csv', 'print'
        ],
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
          }
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-html5-1.6.1/b-print-1.6.1/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-html5-1.6.1/b-print-1.6.1/datatables.min.js"></script> -->


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.bootstrap4.min.css"/>
 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
@endsection