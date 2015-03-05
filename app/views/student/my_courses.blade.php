@extends('student.dashboard')

@section('student_main_content')

	<section class="content">

        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-10 connectedSortable">   
            	
            	<div class = "row">
            		<div class = "col-lg-10">
            			@if(Session::has('flash_message'))
                    		<div class = "container col-sm-10">
                        		<div class = "alert alert-success alert-dismissible" role = "alert">
                        			<i class = "fa fa-check"></i>
                        			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>{{ Session::get('flash_message') }}</strong>
                        		</div>
                    		</div>
                		@endif   
                	</div>                      
                </div>
				<table id = "courses_table" class = "table table-bordered table-striped table-hover">
						
						<thead>
							<th>Course Name</th>
							<th>Course Number</th>
							<th>Action</th>
						</thead>

						<tbody>

							@foreach($courses as $course)

								<tr>

									<td>{{ link_to("/instructor/dashboard/show_course/{$course->id}", $course->course_name) }}</td>
									<td>{{ link_to("/instructor/dashboard/show_course/{$course->id}", $course->course_number) }}</td>
									<td>
										<a href="#takequizModal{{ $course->id }}" data-toggle = "modal" class = "btn btn-success" style = "width:30%;">Take Quiz</a>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<a href="#viewperformanceModal{{ $course->id }}" data-toggle = "modal" class = "btn btn-info" style = "width:60%;">View Performance</a>
									</td>

									<!-- Take Quiz Modal -->
									<div class="modal fade" id = "takequizModal{{ $course->id }}">
									   	<div class="modal-dialog">
										<div class="modal-content">
										    <div class="modal-header">
										     	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
										      		<h4>Select Quiz</h4>
										    </div>
										     	
										    <div class="modal-body">
										    	
										    		<ol>
										    			@foreach($quizzes as $quiz)

										    				@if($quiz->course_id == $course->id && $quiz->set_visible == "true")
										    					<li>{{ link_to("/student/dashboard/take_quiz/{$quiz->id}", $quiz->quiz_title) }}</li>
										    					<div style = "display:none;">{{ $counter++ }}</div>
															@endif
										    				
										    			@endforeach

										    			@if($counter == 0)

											        		<li>There are no available quizzes at this moment...</li>

											        	@elseif($counter != 0)

											        		<div style = "display:none;">{{ $counter = 0 }}</div>
											        
											        	@endif

										    		</ol>
										    	
										    </div>

										    <div class="modal-footer">
												<button type = "button" class = "btn btn-danger" data-dismiss = "modal">CANCEL</button>
							      			</div>
											
									    </div><!-- /.modal-content -->
									  </div><!-- /.modal-dialog -->
									</div>

									<!-- View Performance Modal -->
									<div class="modal fade" id = "viewperformanceModal{{ $course->id }}">
									   	<div class="modal-dialog">
										<div class="modal-content">
										    <div class="modal-header">
										     	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
										      		<h4>Select Quiz</h4>
										    </div>
										     	
										    <div class="modal-body">
										    	
										    		<ol>
										    			@foreach($attempted_quizzes as $quiz)

										    				@if($quiz->course_id == $course->id)
										    					<li>{{ link_to("/student/dashboard/view_performance/{$quiz->id}", $quiz->quiz_title) }}</li>
										    					<div style = "display:none;">{{ $counter++ }}</div>
															@endif
										    				
										    			@endforeach

										    			@if($counter == 0)

											        		<li>There are no available quizzes at this moment...</li>

											        	@elseif($counter != 0)

											        		<div style = "display:none;">{{ $counter = 0 }}</div>
											        
											        	@endif

										    		</ol>
										    	
										    </div>

										    <div class="modal-footer">
												<button type = "button" class = "btn btn-danger" data-dismiss = "modal">CANCEL</button>
							      			</div>
											
									    </div><!-- /.modal-content -->
									  </div><!-- /.modal-dialog -->
									</div>


								</tr>

							@endforeach

						</tbody>

				</table>	

            </section><!-- /.Left col -->
                        
        </div><!-- /.row (main row) -->

    </section><!-- /.content -->

@stop