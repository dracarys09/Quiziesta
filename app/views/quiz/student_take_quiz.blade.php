@extends('student.dashboard')
@section('student_main_content')

	<section class = "content">
		
		<!-- Main row -->
		<div class = "row">

			<!-- Left col -->
			<section class = "col-lg-12 connectedSortable">

				<div class = "row">
            		<div class = "col-lg-10">
            			@if(Session::has('flash_message'))
                    		<div class = "container col-sm-10">
                        		<div class = "alert alert-danger alert-dismissible" role = "alert">
                        			<i class = "fa fa-check"></i>
                        			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>{{ Session::get('flash_message') }}</strong>
                        		</div>
                    		</div>
                		@endif   
                	</div>                      
                </div>

                <div class = "box box-primary">
                	<div class = "box-header">
                		<div class = "row">
                			<div class = "col-sm-5"></div>
                			<div class = "col-sm-4">
                				<h3 class = "box-title">{{ $quiz->quiz_title }}</h3>
                			</div>
                		</div>
                		<div class = "row">
                			<div class = "col-sm-4"></div>
                			<div class = "col-sm-4" style = "margin-left:4%;">
                				<h5 class = "h5"> {{ $course->course_name }} &nbsp; ({{ $course->course_number }})</h5>
                			</div>
                		</div>
                		<div class = "row">
                			<div class = "col-sm-4"></div>
                			<div class = "col-sm-4" style = "margin-left:9%;">
                				<h6 class = "h6"> {{ $quiz->quiz_date }} </h6>
                			</div>
                		</div>
                	</div>

                	<hr>

                	<div class = "box-body">
                        <form method = "POST" action = "{{ URL::route('submit_quiz') }}">
                		<!-- MCQ -->
                		@if(count($mcq) > 0)
                			<h3 class = "h3">Multiple Choice Questions</h3>
                			<br>
                			<ol>
                				@foreach($mcq as $question)
                					<li>
                						<!-- Problem Statement -->
                						<p>{{ $question->problem_statement }}</p>

                						<!-- Image will come here -->

                						<!-- Options -->
                						<ol type = "A">
                							<li>{{$question->option1}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type = "checkbox" name = "mcq{{ $question->id }}[]" value = "option1"></li>
                							<li>{{$question->option2}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type = "checkbox" name = "mcq{{ $question->id }}[]" value = "option2"></li>
                							<li>{{$question->option3}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type = "checkbox" name = "mcq{{ $question->id }}[]" value = "option3"></li>
                							<li>{{$question->option4}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type = "checkbox" name = "mcq{{ $question->id }}[]" value = "option4"></li>
                						</ol>

                                        <br>
                                        
                					</li>
                					<hr>
                				@endforeach
                			</ol>
                			<br>
    
                		@endif

                        <!-- True/False Questions -->
                        @if(count($truefalse) > 0)
                            <h3 class = "h3">True/False Questions</h3>
                            <br>
                            <ol>
                                @foreach($truefalse as $question)
                                    <li>
                                        <!-- Problem Statement -->
                                        <p>{{ $question->problem_statement }}</p>

                                        <!-- Image will come here -->

                                        <!-- True/False -->
                                        <input type = "radio" name = "truefalse{{ $question->id }}" value = "true">TRUE
                                        <input type = "radio" name = "truefalse{{ $question->id }}" value = "false">FALSE
                                    </li>
                                    <hr>
                                @endforeach
                            </ol>
                            <br>
                        @endif

                        <!-- One Word Questions -->
                        @if(count($oneword) > 0)
                            <h3 class = "h3">One Word Questions</h3>
                            <br>
                            <ol>
                                @foreach($oneword as $question)
                                    <li>
                                        <!-- Problem Statement -->
                                        <p>{{ $question->problem_statement }}</p>

                                        <!-- Image will come here -->

                                        <br>
                                        <!-- Space for answer -->
                                        <div class = "form-group">
                                            <input type = "text" name = "oneword{{ $question->id }}" class = "form-control" placeholder = "Type your answer here">
                                        </div>
                                    </li>
                                    <hr>
                                @endforeach
                            </ol>
                            <br>
                        @endif

                        <button type = "submit" name = "submit_quiz" value = "{{ $quiz->id }}" class = "btn btn-success" style = "width:100%;">SUBMIT ANSWERS</button>

                        </form>
                	</div>

                </div>

			</section>		<!-- /.left col -->
			
		</div>	<!-- /.row (main row) -->
	
	</section>	<!-- /.content -->

@stop