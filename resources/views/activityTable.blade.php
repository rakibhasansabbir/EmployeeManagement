@extends('layouts.app')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div cclass="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <a type="button" class="btn btn-success" href="/home">
                            Show Employee Info </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="table-responsive container">
    <h2 class="text-info">Employee Activities</h2>
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
@endsection
