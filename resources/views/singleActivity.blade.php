@extends('layouts.app')


@section('content')

  <div class="container">

          <h1 class="text-info text-center"><strong>Activity of {{$Name}}</strong></h1>
          <br>

      <div class="col-xs-3" style="width: 370px; height: 200px">
            <div class="thumbnail" style="background-color: rgba(227,239,242,0.76)">
                <div class="caption">
                    <h4>Total hours worked today</h4>
                    <h5>{{$todayTotalTime}}</h5>
                    <h5></h5>
                </div>
            </div>
        </div>
        <div class="col-xs-3" style="width: 370px; height: 200px">
            <div class="thumbnail" style="background-color: rgba(227,239,242,0.76)">
                <div class="caption">
                    <h4>Total hours worked over past 7 days</h4>
                    <h5>{{$last7DaysTotalTime}}</h5>
                    <h5></h5>
                </div>
            </div>
        </div>
    <div class="col-xs-3" style="width: 370px; height: 200px">
      <div class="thumbnail" style="background-color: rgba(227,239,242,0.76)">
        <div class="caption">
          <h4>Average activity over past 7 days</h4>
          <h5>{{$last7DaysPercentage}}%</h5>
          <h5></h5>
        </div>
      </div>
    </div>
      <div class="table-responsive container">
          <input class="form-control" id="myInput" type="text" placeholder="Search..">
          <br>
          <table class="table table-bordered table-striped">
              <thead>
              @if(count($Activities)>0)
                  <tr>
                      <th>Date</th>
                      <th>Employee ID</th>
                      <th>Employee Name</th>
                      <th>Department</th>
                      <th>PC Name</th>
                      <th>IP Address</th>
                      <th>Mac Address</th>
                      <th>In Time</th>
                      <th>Out Time</th>
                      <th>Stay</th>
                      {{--<th class="text-center">Action</th>--}}
                  </tr>
              </thead>
              <tbody id="myTable">
              @foreach($Activities as $activities)
                  <tr>
                      <td>{{$activities->created_at->format('d-m-Y')}}</td>
                      <td>{{$activities->employee_id}}</td>
                      <td>{{$activities->employee->name}}</td>
                      <td>{{$activities->employee->department}}</td>
                      <td>{{$activities->pcName}}</td>
                      <td>{{$activities->ipAddress}}</td>
                      <td>{{$activities->macAddress}}</td>
                      <td>{{$activities->created_at->format('h:i:sa')}}</td>
                      <td>{{$activities->updated_at->format('h:i:sa')}}</td>
                      <td>{{$activities->stay}}</td>
                      {{--<td style="width: 150px" class="text-center">--}}
                      {{--<div class="btn-group btn-group-sm">--}}
                      {{--<a href="/admin/{{$activities->id}}" class="btn btn-danger">Delete</a>--}}

                      {{--{!! Form::open(['action' => ['AdminController@destroy', $activities->id],--}}
                      {{--'method' => 'POST', 'class' => 'pull-right']) !!}--}}

                      {{--{{Form::hidden('_method', 'DELETE')}}--}}
                      {{--{{Form::submit('Delete',['class' => 'btn btn-danger'])}}--}}
                      {{--{!! Form::close() !!}--}}

                      {{--</div>--}}
                      {{--</td>--}}
                      @endforeach
                      @else
                          <simple class="text">No activites found</simple>
                      @endif
                  </tr>

              </tbody>
          </table>
      </div>
      <script>
          $(document).ready(function(){
              $("#myInput").on("keyup", function() {
                  var value = $(this).val().toLowerCase();
                  $("#myTable tr").filter(function() {
                      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                  });
              });
          });
      </script>
    </div>
@endsection
