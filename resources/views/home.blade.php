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
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add
                            Employee
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">

        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Employee</h4>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['action' => 'AdminController@store', 'method' => 'POST']) !!}

                        {{--Add Designation--}}
                        <div class="form-group">
                            {{Form::label('name','Designation')}}
                            {{Form::text('name','',['class'=> 'form-control', 'placeholder' => 'Name'])}}
                        </div>

                        {{--Add Department--}}
                        <div class="form-group">
                            {{Form::label('name','Department')}}
                            {{Form::text('name','',['class' => 'form-control', 'placeholder' => 'Name'])}}
                        </div>

                        {{--Add Name--}}
                        <div class="form-group">
                            {{Form::label('name','Name')}}
                            {{Form::text('name','',['class' => 'form-control', 'placeholder' => 'Name'])}}
                        </div>

                        {{--Add Email--}}
                        <div class="form-group">
                            {{Form::label('email','Email')}}
                            {{Form::text('email','',['id' => 'article-ckeditor','class' => 'form-control', 'placeholder' => 'Email'])}}
                        </div>

                        {{--Add ContactNumber--}}
                        <div class="form-group">
                            {{Form::label('contactNumber','Contact Number')}}
                            {{Form::text('contactNumber','',['id' => 'article-ckeditor','class' => 'form-control', 'placeholder' => 'Contact Number'])}}
                        </div>

                        {{--Date of birth--}}
                        <div class="form-group">
                            {{Form::label('dob','Date of Birth: ')}}
                            {{Form::date('dob')}}
                        </div>

                        {{--Add password--}}
                        <div class="form-group">
                            {{Form::label('password','Password')}}
                            {{Form::text('password','',['id' => 'article-ckeditor','class' => 'form-control', 'placeholder' => 'Password'])}}
                        </div>


                        {{Form::submit('Add',['class' => 'btn btn-primary'])}}
                        {!! Form::close() !!}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="table-responsive container">
        <h2 class="text-info">Employee Info</h2>
        <table class="table table-bordered table-hover table-striped">
            <thead>
            @if(count($Employee)>0)
                <tr>
                    <th>ID</th>
                    <th>Designation</th>
                    <th>Department</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>ContactNumber</th>
                    <th>Date of birth</th>
                    <th>Password</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($Employee as $employee)
                <tr>
                    <td>{{$employee->id}}</td>
                    <td>{{$employee->employeeDesignation}}</td>
                    <td>{{$employee->employeeDepartment}}</td>
                    <td>{{$employee->employeeName}}</td>
                    <td>{{$employee->employeeEmail}}</td>
                    <td>{{$employee->employeeContactNumber}}</td>
                    <td>{{$employee->employeeDateOfBirth}}</td>
                    <td>{{$employee->employeePassword}}</td>
                    <td style="width: 150px" class="text-center">
                        <div class="btn-group btn-group-sm">
                            <a href="/admin/{{$employee->id}}/edit" class="btn btn-success">Edit</a>
                            {{--<a href="/admin/{{$employee->id}}" class="btn btn-danger">Delete</a>--}}

                            {!! Form::open(['action' => ['AdminController@destroy', $employee->id],
          'method' => 'POST', 'class' => 'pull-right']) !!}

                            {{Form::hidden('_method', 'DELETE')}}
                            {{Form::submit('Delete',['class' => 'btn btn-danger'])}}
                            {!! Form::close() !!}

                        </div>
                    </td>
                    @endforeach
                    @else
                        <p class="text">No employee found</p>
                    @endif
                </tr>

            </tbody>
        </table>
    </div>
@endsection
