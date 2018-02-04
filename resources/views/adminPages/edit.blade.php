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

                    {{--Add Name--}}
                    <div class="form-group">
                        {{Form::label('name','Name')}}
                        {{Form::text('name','',['class' => 'form-control','placeholder' => $SingleEmployee->id ])}}
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

            </div>
        </div>
</div>

@endsection