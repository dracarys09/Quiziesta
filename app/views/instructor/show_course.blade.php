@extends('instructor.dashboard')

@section('instructor_main_content')

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

                <div role="tabpanel">

				  <!-- Nav tabs -->
				  <ul class="nav nav-tabs" role="tablist">
				    <li role="presentation" class="active"><a href="#course" aria-controls="course" role="tab" data-toggle="tab">Course Information</a></li>
				    @if($entity->type == "instructor")
				    	<li role="presentation"><a href="#quiz" aria-controls="quiz" role="tab" data-toggle="tab">Course Quizzes</a></li>
				  	@endif
				  </ul>

				  <!-- Tab panes -->
				  <div class="tab-content">
				    <div role="tabpanel" class="tab-pane fade in active" id="course">

				    	<div class = "box box-primary">
				    		<div class = "box-header">
				    			<h3 class = "box-title">{{ $course->course_name }} &nbsp; ({{ $course->course_number }})</h3>
				    		</div>
				    		<div class = "box-body">

				    			<h4 class = "h4">Course Description</h4>

				    			<p>{{ $course->description }}</p>

				    			<hr>

				    			<h4 class = "h4">Course Contents</h4>

				    			<p>{{ $course->course_contents }}</p>

				    			<hr>

				    		</div>

				    		<div class = "box-footer">
				    			<h6 class = "h6">Start Date: &nbsp; {{ $course->start_date }}</h6>
				    			<h6 class = "h6">End Date: &nbsp;&nbsp;&nbsp; {{ $course->end_date }}</h6>
				    		</div>
				    	</div>

				    </div>
				    
				    @if($entity->type == "instructor")

				    	<div role="tabpanel" class="tab-pane fade" id="quiz">

					    	<div class = "box box-success">
					    		<div class = "box-header">
					    			<h3 class = "box-title">List of Created Quizzes</h3>
					    		</div>

					    		<div class = "box-body">
					    			@if(count($quizzes) == 0)
					    				
					    				<h4 class = "h4"> You haven't created any quizzes for this course yet! </h4>
					    				
					    			@else
					    				<ol>
						    				@foreach($quizzes as $quiz)
						    					<li>
						    						<h4 class = "h4">{{ link_to("/instructor/dashboard/show_quiz/{$quiz->id}",$quiz->quiz_title) }}</h4>
						    					</li>
						    				@endforeach
						    			</ol>	
					    			@endif
					    		</div>

					    	</div>

				    	</div>

				    @endif

				  </div>

				</div>

			</section>		<!-- /.left col -->
			
		</div>	<!-- /.row (main row) -->
	
	</section>	<!-- /.content -->

@stop