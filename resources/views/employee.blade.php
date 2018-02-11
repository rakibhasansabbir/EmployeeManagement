@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default"L>
                <div class="panel-heading">EMPLOYEE Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    You are logged in as <strong>Employee</strong>
                    <form  action="{{ route('employee.activity.submit') }}" method="get">
                         <h1>Your IP = {{$_SERVER['REMOTE_ADDR']}}</h1>
                         <input type="hidden"  name="ip" value={{$_SERVER['REMOTE_ADDR']}}>
                         <input type="hidden"  name="mac" value="B0:C0:90:4E:31:B4">
                         <input type="hidden"  name="id" value={{ Auth::user()->id }}>
                         <input type="hidden"  name="pcName" value="rakib-pc">
                         <!-- <h1>Your Mac Address = {{$_SERVER['HTTP_USER_AGENT']}}</h1> -->

                      <button class="btn btn-primary" type="submit" name="button">Start Countdown</button>
                    </form>

                     {!! Form::open(['route' => ['activity.stop.submit', Auth::user()->id],'method' => 'put']) !!}

                   {{--Edit Designation--}}
                   <div class="form-group">
                       {{Form::hidden('id', Auth::user()->id,['class' => 'form-control'])}}
                   </div>

                   {{--Edit Department--}}
                   <div class="form-group">
                       {{Form::hidden('ip',$_SERVER['REMOTE_ADDR'],['class' => 'form-control' ])}}
                   </div>

                   {{--Add Name--}}
                   <div class="form-group">
                       {{Form::hidden('mac',"B0:C0:90:4E:31:B4",['class' => 'form-control' ])}}
                   </div>

                   {{--Add Email--}}
                   <div class="form-group">
                       {{Form::hidden('pcName',"rakib-pc",['id' => 'article-ckeditor','class' => 'form-control email'])}}
                   </div>

                   {{Form::hidden('_method','PUT')}}
                   {{Form::submit('STOPPED',['class' => 'btn btn-primary'])}}
                   {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
