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

               	<div class = "row">

               		<div class = "col-sm-4">
               			<div class = "box box-solid bg-navy">
               				<div class = "box-header">
               					<h3 class = "box-title">Add MCQ</h3>
               				</div>

               				<div class = "box-body">
               					<a href="#mcqModal{{ $quiz_id }}" data-toggle = "modal" class = "btn btn-primary">Choose Questions</a>
               				</div>

               			</div>
               		</div>

               		<div class = "col-sm-4">
               			<div class = "box box-solid bg-green">
               				<div class = "box-header">
               					<h3 class = "box-title">Add One Word Question</h3>
               				</div>

               				<div class = "box-body">
               					<a href="#onewordModal{{ $quiz_id }}" data-toggle = "modal" class = "btn btn-primary">Choose Questions</a>
               				</div>
               				
               			</div>
               		</div>

               		<div class = "col-sm-4">
               			<div class = "box box-solid bg-maroon">
               				<div class = "box-header">
               					<h3 class = "box-title">Add True/False Question</h3>
               				</div>

               				<div class = "box-body">
               		        	<a href="#truefalseModal{{ $quiz_id }}" data-toggle = "modal" class = "btn btn-primary">Choose Questions</a>
               				</div>
               		
               			</div>
               		</div>

               	</div>

               	<!-- MCQ Modal -->
               	<div class="modal fade" id = "mcqModal{{ $quiz_id }}">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					      		<h4>Choose Questions</h4>
							</div>
									      	
							<div class="modal-body">
								<form action = "{{ URL::route('insert_quiz_questions') }}" method = "post">
									<ol>
										@foreach($mcq as $question)

											<li>
												<div class = "form-group">
													<input type = "checkbox" name = "mcq[]" id = "checkbox" value = "{{ $question->id }}" class = "form-control">
													
													<p>{{ $question->problem_statement }}</p>
													<div class = "box bg-blue">
														{{ $question->option1 }}
														<br>
														{{ $question->option2 }}
														<br>
														{{ $question->option3 }}
														<br>
														{{ $question->option4 }}
													</div>
													ANSWER
													<div class = "box bg-green">
														{{ $question->correct_answer }}
													</div>

													@if($question->image != "")
                                            			<img src="{{ $question->image }}" height = "200" width = "400">
                									@endif

												</div>

												<div class = "form-group">
													<input type = "text" name = "{{ $question->id }}" placeholder = "Enter marks" class = "form-control">
												</div>
												
											</li>

										@endforeach	
									</ol>	          
							</div>

							<div class="modal-footer">
								<button type = "submit" class="btn btn-success" name = "mcq_button" value = "{{ $quiz_id }}">SUBMIT</button>
							    <button type = "button" class = "btn btn-danger" data-dismiss = "modal">CANCEL</button>
							</div>
								</form>
						</div><!-- /.modal-content -->
		     		</div><!-- /.modal-dialog -->
				</div>

				<!-- One Word Modal -->
               	<div class="modal fade" id = "onewordModal{{ $quiz_id }}">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					      		<h4>Choose Questions</h4>
							</div>
									      	
							<div class="modal-body">
								<form action = "{{ URL::route('insert_quiz_questions') }}" method = "post">
									<ol>
										@foreach($oneword as $question)

											<li>
												<div class = "form-group">
													<input type = "checkbox" name = "oneword[]" id = "checkbox" value = "{{ $question->id }}" class = "form-control">
													
													<p>{{ $question->problem_statement }}</p>
													
													ANSWER
													<div class = "box bg-green">
														{{ $question->answer }}
													</div>

													@if($question->image != "")
                                            			<img src="{{ $question->image }}" height = "200" width = "400">
                									@endif

												</div>

												<div class = "form-group">
													<input type = "text" name = "{{ $question->id }}" placeholder = "Enter marks" class = "form-control">
												</div>
											</li>

										@endforeach	
									</ol>	          
							</div>

							<div class="modal-footer">
								<button type = "submit" class="btn btn-success" name = "oneword_button" value = "{{ $quiz_id }}">SUBMIT</button>
							    <button type = "button" class = "btn btn-danger" data-dismiss = "modal">CANCEL</button>
							</div>
								</form>
						</div><!-- /.modal-content -->
		     		</div><!-- /.modal-dialog -->
				</div>

				<!-- True/False Modal -->
               	<div class="modal fade" id = "truefalseModal{{ $quiz_id }}">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					      		<h4>Choose Questions</h4>
							</div>
									      	
							<div class="modal-body">
								<form action = "{{ URL::route('insert_quiz_questions') }}" method = "post">
									<ol>
										@foreach($truefalse as $question)

											<li>
												<div class = "form-group">
													<input type = "checkbox" name = "truefalse[]" id = "checkbox" value = "{{ $question->id }}" class = "form-control">
													
													<p>{{ $question->problem_statement }}</p>
												
													ANSWER
													<div class = "box bg-green">
														{{ $question->answer }}
													</div>

													@if($question->image != "")
                                            			<img src="{{ $question->image }}" height = "200" width = "400">
                									@endif

												</div>

												<div class = "form-group">
													<input type = "text" name = "{{ $question->id }}" placeholder = "Enter marks" class = "form-control">
												</div>
											</li>

										@endforeach	
									</ol>	          
							</div>

							<div class="modal-footer">
								<button type = "submit" class="btn btn-success" name = "truefalse_button" value = "{{ $quiz_id }}">SUBMIT</button>
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