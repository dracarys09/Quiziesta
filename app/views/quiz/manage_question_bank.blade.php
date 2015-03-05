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

                <!-- Display mcq questions -->
                <div class = "row">
                	<div class = "col-xs-2">
						<a href="#createmcqModal{{ $course_id }}" data-toggle = "modal" class = "btn btn-primary">Add Question</a>
					</div>
	                <div class = "col-xs-10">
	                	<div class = "box">
	                		<div class = "box-header">
	                			<h3 class = "box-title">MCQ Type Questions</h3>
	                		</div>
	                			<div class = "box-body table-responsive">
	                				<div id = "mcq_wrapper" class = "dataTables_wrapper form-inline" role = "grid">
	                					<table id = "mcq_questions_table" class = "table table-bordered table-hover dataTable">
	                						<thead>
	                							<tr>
	                								<th>Problem</th>
	                								<th>Image</th>
	                								<th>Options</th>
	                								<th>Answer</th>
	                								<th>Action</th>
	                							</tr>
	                						</thead>
	                						<tbody>
	                							@foreach($mcq as $question)

	                								<tr>
	                									<td>{{$question->problem_statement}}</td>
	                									<td><img src="{{$question->image}}" height = "200" width = "400"></td>
	                									<td>
	                										<ol>
	                											<li>{{$question->option1}}</li>
	                											<li>{{$question->option2}}</li>
	                											<li>{{$question->option3}}</li>
	                											<li>{{$question->option4}}</li>
	                										</ol>
	                									</td>
	                									<td>{{$question->correct_answer}}</td>
	                									<td><a href="#deletemcqModal{{ $question->id }}" data-toggle = "modal" class = "btn btn-danger">Remove Question</a></td>
	                								</tr>

	                								<!-- Modal for delete -->
										           	<div class="modal fade" id = "deletemcqModal{{ $question->id }}">
													   <div class="modal-dialog">
														<div class="modal-content">
														    <form method = "post" action = "{{ URL::route('remove_question') }}" class = "form-horizontal">
														      	<div class="modal-header">
														       		 <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
														        	<h4 class="modal-title">Really ?</h4>
														      	</div>
														      	<div class="modal-body">
															        <p>ARE YOU SURE THAT YOU WANT TO DELETE THIS QUESTION ?</p>
																</div>
															    <div class="modal-footer">
																	<button type = "submit" class="btn btn-danger" name = "deletemcq" value = "{{ $question->id }}">YES</button>
												      				<button type = "button" class = "btn btn-primary" data-dismiss = "modal">CANCEL</button>
												      			</div>
															</form>
													    </div><!-- /.modal-content -->
													  </div><!-- /.modal-dialog -->
													</div>

	                							@endforeach
	                						</tbody>
	                					</table>
	                				</div>
	                			</div>
	                		</div>
	                	</div>
		            </div>
		        
		            	
	            <!-- Display oneword questions -->
	            <div class = "row">
                	<div class = "col-xs-2">
                		<a href="#createonewordModal{{ $course_id }}" data-toggle = "modal" class = "btn btn-primary">Add Question</a>
                	</div>
	                <div class = "col-xs-10">
	                	<div class = "box">
	                		<div class = "box-header">
	                			<h3 class = "box-title">One Word Type Questions</h3>
	                		</div>
	                			<div class = "box-body table-responsive">
	                				<div id = "mcq_wrapper" class = "dataTables_wrapper form-inline" role = "grid">
	                					<table id = "mcq_questions_table" class = "table table-bordered table-hover dataTable">
	                						<thead>
	                							<tr>
	                								<th>Problem</th>
	                								<th>Image</th>
	                								<th>Answer</th>
	                								<th>Action</th>
	                							</tr>
	                						</thead>
	                						<tbody>
	                							@foreach($oneword as $question)

	                								<tr>
	                									<td>{{$question->problem_statement}}</td>
	                									<td><img src="{{$question->image}}" height = "200" width = "400"></td>
	                									<td>{{$question->answer}}</td>
	                									<td><a href="#deleteonewordModal{{ $question->id }}" data-toggle = "modal" class = "btn btn-danger">Remove Question</a></td>
	                								</tr>

	                								<!-- Modal for delete -->
										           	<div class="modal fade" id = "deleteonewordModal{{ $question->id }}">
													   <div class="modal-dialog">
														<div class="modal-content">
														    <form method = "post" action = "{{ URL::route('remove_question') }}" class = "form-horizontal">
														      	<div class="modal-header">
														       		 <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
														        	<h4 class="modal-title">Really ?</h4>
														      	</div>
														      	<div class="modal-body">
															        <p>ARE YOU SURE THAT YOU WANT TO DELETE THIS QUESTION ?</p>
																</div>
															    <div class="modal-footer">
																	<button type = "submit" class="btn btn-danger" name = "deleteoneword" value = "{{ $question->id }}">YES</button>
												      				<button type = "button" class = "btn btn-primary" data-dismiss = "modal">CANCEL</button>
												      			</div>
															</form>
													    </div><!-- /.modal-content -->
													  </div><!-- /.modal-dialog -->
													</div>

	                							@endforeach
	                						</tbody>
	                					</table>
	                				</div>
	                			</div>
	                		</div>
	                	</div>
		            </div>
		        

	            <!-- Display true/false questions -->
                <div class = "row">
                	<div class = "col-xs-2">
                		<a href="#createtruefalseModal{{ $course_id }}" data-toggle = "modal" class = "btn btn-primary">Add Question</a>
                	</div>
	                <div class = "col-xs-10">
	                	<div class = "box">
	                		<div class = "box-header">
	                			<h3 class = "box-title">True/False Type Questions</h3>
	                		</div>
	                			<div class = "box-body table-responsive">
	                				<div id = "mcq_wrapper" class = "dataTables_wrapper form-inline" role = "grid">
	                					<table id = "mcq_questions_table" class = "table table-bordered table-hover dataTable">
	                						<thead>
	                							<tr>
	                								<th>Problem</th>
	                								<th>Image</th>
	                								<th>Answer</th>
	                								<th>Action</th>
	                							</tr>
	                						</thead>
	                						<tbody>
	                							@foreach($truefalse as $question)

	                								<tr>
	                									<td>{{$question->problem_statement}}</td>
	                									<td><img src="{{$question->image}}" height = "200" width = "400"></td>
	                									<td>{{$question->answer}}</td>
	                									<td><a href="#deletetruefalseModal{{ $question->id }}" data-toggle = "modal" class = "btn btn-danger">Remove Question</a></td>
	                								</tr>

	                								<!-- Modal for delete -->
										           	<div class="modal fade" id = "deletetruefalseModal{{ $question->id }}">
													   <div class="modal-dialog">
														<div class="modal-content">
														    <form method = "post" action = "{{ URL::route('remove_question') }}" class = "form-horizontal">
														      	<div class="modal-header">
														       		 <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
														        	<h4 class="modal-title">Really ?</h4>
														      	</div>
														      	<div class="modal-body">
															        <p>ARE YOU SURE THAT YOU WANT TO DELETE THIS QUESTION ?</p>
																</div>
															    <div class="modal-footer">
																	<button type = "submit" class="btn btn-danger" name = "deletetruefalse" value = "{{ $question->id }}">YES</button>
												      				<button type = "button" class = "btn btn-primary" data-dismiss = "modal">CANCEL</button>
												      			</div>
															</form>
													    </div><!-- /.modal-content -->
													  </div><!-- /.modal-dialog -->
													</div>

	                							@endforeach
	                						</tbody>
	                					</table>
	                				</div>
	                			</div>
	                		</div>
	                	</div>
		            </div>
		       


		        <!-- MCQ modal -->
		        <div class="modal fade" id = "createmcqModal{{ $course_id }}">
					<div class="modal-dialog">
						<div class="modal-content">
						  	<div class="modal-header">
						 		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
								<h4>Create New MCQ</h4>
							</div>
									      	
							<div class="modal-body">
								<form action = "{{ URL::route('manage_question_bank') }}" method = "post" enctype = "multipart/form-data">
									<div class="form-group">
										<label for="problem_statement" class="control-label">Problem Statement</label>
										<textarea id = "problem_statement" class = "form-control textarea" name = "problem_statement" placeholder = "Enter the problem statement" autofocus required></textarea>	
									</div>
									<div class="form-group">
										<label for="option1" class="control-label">Option1</label>
										<input type = "text" name = "option1" id = "option1" class = "form-control" placeholder = "Enter option 1" required>
									</div>
									<div class="form-group">
										<label for="option2" class="control-label">Option2</label>
										<input type = "text" name = "option2" id = "option2" class = "form-control" placeholder = "Enter option 2" required>
									</div>
									<div class="form-group">
										<label for="option3" class="control-label">Option3</label>
										<input type = "text" name = "option3" id = "option3" class = "form-control" placeholder = "Enter option 3" required>
									</div>
									<div class="form-group">
										<label for="option4" class="control-label">Option4</label>
										<input type = "text" name = "option4" id = "option4" class = "form-control" placeholder = "Enter option 4" required>
									</div>
									<div class="form-group">
										<label for="correct_option" class="control-label">Correct Option</label>
										<input type = "text" name = "correct_option" id = "correct_option" class = "form-control" placeholder = "Enter option number" required>
									</div>
									<!-- Image will come here -->
									<div class = "form-group">
										<label for = "mcq-file" class = "col-sm-2 control-label">Image</label>
										<input type =  "file" name = "mcq-file" id = "mcq-file" class = "form-control btn btn-primary">
									</div>

							</div>

							<div class="modal-footer">
								<button type = "submit" class="btn btn-success" name = "add_mcq" value = "{{ $course_id }}">ADD QUESTION</button>
				  				<button type = "button" class = "btn btn-danger" data-dismiss = "modal">CANCEL</button>
							</div>
								</form>
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div>


				<!-- OneWord modal -->
		        <div class="modal fade" id = "createonewordModal{{ $course_id }}">
					<div class="modal-dialog">
						<div class="modal-content">
						  	<div class="modal-header">
						 		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
								<h4>Create New One Word Question</h4>
							</div>
									      	
							<div class="modal-body">
								<form action = "{{ URL::route('manage_question_bank') }}" method = "post" enctype = "multipart/form-data">
									<div class="form-group">
										<label for="problem_statement" class="control-label">Problem Statement</label>
										<textarea id = "problem_statement" class = "form-control textarea" name = "problem_statement" placeholder = "Enter the problem statement" autofocus required></textarea>	
									</div>
									
									<div class="form-group">
										<label for="correct_answer" class="control-label">Correct Answer</label>
										<input type = "text" name = "correct_answer" id = "correct_answer" class = "form-control" placeholder = "Write correct answer" required>
									</div>
									<!-- Image will come here -->
									<div class = "form-group">
										<label for = "oneword-file" class = "col-sm-2 control-label">Image</label>
										<input type =  "file" name = "oneword-file" id = "oneword-file" class = "form-control btn btn-primary">
									</div>
							</div>

							<div class="modal-footer">
								<button type = "submit" class="btn btn-success" name = "add_oneword" value = "{{ $course_id }}">ADD QUESTION</button>
				  				<button type = "button" class = "btn btn-danger" data-dismiss = "modal">CANCEL</button>
							</div>
								</form>
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div>

				<!-- True/False modal -->
		        <div class="modal fade" id = "createtruefalseModal{{ $course_id }}">
					<div class="modal-dialog">
						<div class="modal-content">
						  	<div class="modal-header">
						 		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
								<h4>Create New True/False Question</h4>
							</div>
									      	
							<div class="modal-body">
								<form action = "{{ URL::route('manage_question_bank') }}" method = "post" enctype = "multipart/form-data">
									<div class="form-group">
										<label for="problem_statement" class="control-label">Problem Statement</label>
										<textarea id = "problem_statement" class = "form-control textarea" name = "problem_statement" placeholder = "Enter the problem statement" autofocus required></textarea>	
									</div>
									
									<div class="form-group">
										<label for="correct_answer" class="control-label">Correct Answer</label>
										<input type = "text" name = "correct_answer" id = "correct_answer" class = "form-control" placeholder = "Write correct answer" required>
									</div>
									<!-- Image will come here -->
									<div class = "form-group">
										<label for = "truefalse-file" class = "col-sm-2 control-label">Image</label>
										<input type =  "file" name = "truefalse-file" id = "truefalse-file" class = "form-control btn btn-primary">
									</div>
							</div>

							<div class="modal-footer">
								<button type = "submit" class="btn btn-success" name = "add_truefalse" value = "{{ $course_id }}">ADD QUESTION</button>
				  				<button type = "button" class = "btn btn-danger" data-dismiss = "modal">CANCEL</button>
							</div>
								</form>
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div>

				
			</section>		<!-- /.left col -->
			
		</div>	<!-- /.row (main row) -->
	
	</section>	<!-- /.content -->

@stop