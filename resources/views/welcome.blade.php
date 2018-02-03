@extends('layouts.app')

@section('content')
    <div class="jumbotron text-center">
        <h1>Hello User!</h1>
        <p>Welcome to our company</p>
        <p><a class="btn btn-primary btn-lg" href="/admin" role="button">Admin</a>
            <a class="btn btn-success btn-lg" href="/employee" role="button">Employee</a>
        </p>
    </div>
@endsection