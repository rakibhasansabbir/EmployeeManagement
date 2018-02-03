@extends('layouts.app')

@section('content')

    <h2>Login</h2>
    <div class="jumbotron">
        {!! Form::open(['action' => 'AdminController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('email','Email')}}
            {{Form::text('email','',['class' => 'form-control', 'placeholder' => 'Email'])}}
        </div>
        <div class="form-group">
            {{Form::label('password','Password')}}
            {{Form::text('password','',['id' => 'article-ckeditor','class' => 'form-control', 'placeholder' => 'password'])}}
        </div>
        {{Form::submit('Login',['class' => 'btn btn-primary'])}}
        {!! Form::close() !!}
    </div>


@endsection