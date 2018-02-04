@extends('layouts.app')

@section('content')
<div class="container">

    <!-- Modal -->

        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Employee</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['action' => ['AdminController@update', $SingleEmployee->id], 'method' => 'PUT']) !!}

                    {{--Edit Designation--}}
                    <div class="form-group">
                        {{Form::label('name','Designation')}}
                        {{Form::text('name', $SingleEmployee->employeeDesignation,['class' => 'form-control','value'=> 565362635])}}
                    </div>

                    {{--Edit Department--}}
                    <div class="form-group">
                        {{Form::label('name','Department')}}
                        {{Form::text('name',$SingleEmployee->employeeDepartment,['class' => 'form-control','placeholder' => $SingleEmployee->id ])}}
                    </div>

                    {{--Add Name--}}
                    <div class="form-group">
                        {{Form::label('name','Name')}}
                        {{Form::text('name',$SingleEmployee->employeeName,['class' => 'form-control','placeholder' => $SingleEmployee->id ])}}
                    </div>

                    {{--Add Email--}}
                    <div class="form-group">
                        {{Form::label('email','Email')}}
                        {{Form::text('email',$SingleEmployee->employeeEmail,['id' => 'article-ckeditor','class' => 'form-control', 'placeholder' => 'Email'])}}
                    </div>

                    {{--Add ContactNumber--}}
                    <div class="form-group">
                        {{Form::label('contactNumber','Contact Number')}}
                        {{Form::text('contactNumber',$SingleEmployee->employeeContactNumber,['id' => 'article-ckeditor','class' => 'form-control', 'placeholder' => 'Contact Number'])}}
                    </div>

                    {{--Date of birth--}}
                    <div class="form-group">
                        {{Form::label('dob','Date of Birth: ')}}
                        {{Form::date('dob',$SingleEmployee->employeeDateOfBirth)}}
                    </div>

                    {{--Add password--}}
                    <div class="form-group">
                        {{Form::label('password','Password')}}
                        {{Form::text('password',$SingleEmployee->employeePassword,['id' => 'article-ckeditor','class' => 'form-control', 'placeholder' => 'Password'])}}
                    </div>


                    {{Form::hidden('_method','PUT')}}
                    {{Form::submit('Save',['class' => 'btn btn-primary'])}}
                    {!! Form::close() !!}

                </div>

            </div>
        </div>
</div>

@endsection