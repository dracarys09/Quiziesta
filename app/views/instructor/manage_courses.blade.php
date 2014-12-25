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

                <div>
	               	<table id="conversation_table" class="table table-bordered table-striped table-hover">
					    <thead>
					        <tr>
					            <th>Course Name</th>
					            <th>Course Number</th>
					            <th>Create</th>
					            <th>View Performance</th>
					            <th>Question Bank</th>
					        </tr>
					    </thead>
					    <tbody>
					    	
					    	@foreach($courses as $course)
					        
					        <tr>

					        	<td>{{ link_to("/instructor/dashboard/show_course/{$course->id}", $course->course_name) }}</td>
					           	<td>{{ link_to("/instructor/dashboard/show_course/{$course->id}", $course->course_number) }}</td>
					           	<td><a href="#createModal{{ $course->id }}" data-toggle = "modal" class = "btn btn-primary">New Quiz</a>
					           		{{ link_to("/instructor/dashboard/insert_questions/{$course->id}", "Insert Questions", array('class'=>'btn btn-warning')) }}
					           	</td>
					           	<td>{{ link_to("/instructor/dashboard/view_performance/{$course->id}", "View Performance", array('class'=>'btn btn-info')) }}</td>
					           	<td>{{ link_to("/instructor/dashboard/manage_question_bank/{$course->id}", "Create New Question Bank/Update Existing Question Bank", array('class'=>'btn btn-success')) }}</td>

					           	<!-- Modal for new quiz -->
					           	<div class="modal fade" id = "createModal{{ $course->id }}">
								   <div class="modal-dialog">
									<div class="modal-content">
									      	<div class="modal-header">
									       		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
									      		<h4>Create New Quiz</h4>
									      	</div>
									      	
									      	<div class="modal-body">
										        <form action = "{{ URL::route('create_quiz') }}" method = "post">
										          <div class="form-group">
										            <label for="quiz_title" class="control-label">Quiz Title</label>
										            <input type="text" name = "quiz_title" class="form-control" id="quiz_title" autofocus required>
										          </div>
										          <div class="form-group">
										            <label for="quiz_date" class="control-label">Quiz Date</label>
										          	<input type="date" name = "quiz_date" class="form-control" id="quiz_date" required>  
										          </div>
										          <div class="form-group">
										            <label for="start_time" class="control-label">Start Time</label>
										          	<input type="time" name = "start_time" class="form-control" id="start_time" required>  
										          </div>
										          <div class="form-group">
										            <label for="end_time" class="control-label">End Time</label>
										          	<input type="time" name = "end_time" class="form-control" id="end_time" required>  
										          </div>
										        
										    </div>

										    <div class="modal-footer">
												<button type = "submit" class="btn btn-success" name = "create" value = "{{ $course->id }}">CREATE</button>
							      				<button type = "button" class = "btn btn-danger" data-dismiss = "modal">CANCEL</button>
							      			</div>
											</form>
								    </div><!-- /.modal-content -->
								  </div><!-- /.modal-dialog -->
								</div>

					        </tr>

					        @endforeach
					    </tbody>
					</table>
				</div>

			</section>		<!-- /.left col -->
			
		</div>	<!-- /.row (main row) -->
	
	</section>	<!-- /.content -->

@stop