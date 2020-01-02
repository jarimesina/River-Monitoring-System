@extends('base')
@include('layouts.app')
@section('main')
<div class="row">
<div class="col-sm-12">
    <h1 class="display-3">{{$river->name}}</h1> 
    <section id="contact">
    <div class="container d-flex flex-column text-center">
      <div class="row">
        <div class="col-lg-12 d-flex flex-column text-center">
          <h2>Water Level: 24.8 mm</h2>
          <h2>Water Current Velocity: 24.8 mm/s</h2>
          <h2>Water Temperature: 27 &#x2103;</h2>
        </div>
      </div>
    </br>
    </br>
      <div class="row">
          <div class="col-6 text-center">
            <h2>Hydrograph</h2>            
            <img src="hydrograph.png">
          </div>
          <div class="col-6 text-center">
            <h2>Water Level vs. Time</h2>            
            <img src="hydrograph.png">
          </div>
      </div>
    </br>
    </br>

    <div>
    <content>
      <form>
        <!-- Enter day:
        <input type="text"><br><br>
        Enter month:
        <input type="text"><br><br>
        Enter year:
        <input type="text"><br><br>
        <button type="submit">Enter Date</button> -->
        Date Picker:
        <br>
        <label for="start">Start date:</label>

        <input type="date" id="start" name="trip-start" value="2018-07-22" min="2018-01-01" max="2018-12-31"><br><br>

        <label for="start">End date:</label>

        <input type="date" id="start" name="trip-start" value="2018-07-22" min="2018-01-01" max="2018-12-31"><br>
        <a class="rotate-button">
          <span class="rotate-button-face">Enter</span>
          <span class="rotate-button-face-back">Cool</span>
        </a>
      </form>
    </content>
    </div>
    <br>
    <div class="row">
      <div class="myBox">
        <table style="width:100%">
          <tr>
            <th>Time(minutes)</th>
            <th>Velocity(m/s)</th>
            <th>Liquid Level(mm)</th>
            <th>Temperature(&#x2103;)</th>
          </tr>
          <tr>
            <td>5:01 PM</td>
            <td>0.5</td>
            <td>1000</td>
            <td>21</td>
          </tr>
          <tr>
            <td>5:02 PM</td>
            <td>0.5</td>
            <td>1050</td>
            <td>21</td>
          </tr>
          <tr>
            <td>5:03 PM</td>
            <td>0.5</td>
            <td>1450</td>
            <td>21</td>
          </tr>
          <tr>
            <td>5:04 PM</td>
            <td>0.5</td>
            <td>1120</td>
            <td>21</td>
          </tr>
          <tr>
            <td>5:05 PM</td>
            <td>0.5</td>
            <td>1050</td>
            <td>21</td>
          </tr>
          <tr>
            <td>5:06 PM</td>
            <td>0.5</td>
            <td>1050</td>
            <td>21</td>
          </tr>
          <tr>
            <td>5:07 PM</td>
            <td>0.5</td>
            <td>1050</td>
            <td>21</td>
          </tr>
          <tr>
            <td>5:08 PM</td>
            <td>0.5</td>
            <td>1050</td>
            <td>21</td>
          </tr>
          <tr>
            <td>5:09 PM</td>
            <td>0.5</td>
            <td>1050</td>
            <td>21</td>
          </tr>
          <tr>
            <td>5:10 PM</td>
            <td>0.5</td>
            <td>1050</td>
            <td>21</td>
          </tr>
        </table>
      </div>
    </div>

    </div>
  </section>
<div>


</div>
@endsection