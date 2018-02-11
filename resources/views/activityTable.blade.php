@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
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
    <table class="table table-bordered table-hover table-striped">
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
        <tbody>
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
@endsection
