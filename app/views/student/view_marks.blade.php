@extends('student.dashboard')

@section('student_main_content')

	<section class = "col-lg-12 connectedSortable">
		<div class = "row" style = "margin-top:2%;">
			<div class = "col-sm-12">
		        <div class = "box box-solid bg-green">
		            <div class = "box-header">
		               	<h2 class = "box-title">Your Performance Statistics</h2>
		            </div>

		            <div class = "box-body">
		        		
		        		@if(count($marks) > 0)
		            		<div class = "total-marks"> <h3>TOTAL MARKS</h3>{{ $marks->total_marks }} </div>
		            		<div class = "awarded-marks"> <h3>MARKS OBTAINED</h3>{{ $marks->marks_obtained }} </div>	
		            	@else
		            		<div> <p>You have not attempted this quiz yet...</p> </div>
		            	@endif

		            </div>
				</div>
		    </div>
		</div>
    </section>

@stop