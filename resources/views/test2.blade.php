@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default" L>
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

						<div>

							<script>
                                // Set the date we're counting down to
                                var countDownDate = new Date("{{$value}}").getTime();

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
	</div>
@endsection
