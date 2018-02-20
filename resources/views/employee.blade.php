@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <header class="text-right"> EMPLOYEE Dashboard </header>
                        <time class=" panel-title" id="demo"></time>

                    </div>

                    <div class="panel-body">
                    @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                            <form action="{{ route('employee.activity.submit') }}" method="get">
                            <input type="hidden" name="ip" value={{$_SERVER['REMOTE_ADDR']}}>
                            <input type="hidden" name="mac" value="B0:C0:90:4E:31:B4">
                            <input type="hidden" name="id" value={{ Auth::user()->id }}>
                            <input type="hidden" name="pcName" value="rakib-pc">
                            <button class="btn btn-primary" type="submit" name="button">Start Countdown</button>
                        </form>
                            <br>

                            {!! Form::open(['route' => ['activity.stop.submit'],'method' => 'put']) !!}

                            {{Form::hidden('id', Auth::user()->id)}}
                            {{Form::hidden('ip',$_SERVER['REMOTE_ADDR'])}}
                            {{Form::hidden('mac',"B0:C0:90:4E:31:B4")}}
                            {{Form::hidden('pcName',"rakib-pc")}}

                            {{Form::submit('STOPPED',['class' => 'btn btn-danger'])}}
                            {!! Form::close() !!}
                            <div >

                            <script>
                                // Set the date we're counting down to
                                var countDownDate = new Date("{{$time}}").getTime();

                                // Update the count down every 1 second
                                var x = setInterval(function() {

                                    // Get todays date and time
                                    var now = new Date().getTime();

                                    // Find the distance between now an the count down date
                                    var distance = now - countDownDate;

                                    // Time calculations for days, hours, minutes and seconds

                                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                    // Output the result in an element with id="demo"
                                    document.getElementById("demo").innerHTML = hours + "h : "
                                        + minutes + "m : " + seconds + "s ";

                                    // If the count down is over, write some text
                                    if (distance < 0) {
                                        clearInterval(x);
                                        document.getElementById("demo").innerHTML = "EXPIRED";
                                    }
                                }, 1000);
                            </script>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="table-responsive container">
            <h2 class="text-info">Your Activities</h2>
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
