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
	               	<table id="courses_table" class="table table-bordered table-striped table-hover">
					    <thead>
					        <tr>
					            <th>Course Name</th>
					            <th>Course Number</th>
					            <th>Action</th>
					        </tr>
					    </thead>
					    <tbody>
					    	
					    	@foreach($courses as $course)
					        
					        <tr>

					        	<td><a href = "{{ URL::route('show_course') }}">{{ $course->course_name }}</a></td>
					           	<td><a href = "{{ URL::route('show_course') }}">{{ $course->course_number }}</a></td>
					           	<td><a href="#deleteModal{{ $course->id }}" data-toggle = "modal" class = "btn btn-danger">Delete</a></td>

					           	<!-- Modal for delete -->
					           	<div class="modal fade" id = "deleteModal{{ $course->id }}">
								   <div class="modal-dialog">
									<div class="modal-content">
									    <form method = "post" action = "{{ URL::route('remove_course') }}" class = "form-horizontal">
									      	<div class="modal-header">
									       		 <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
									        	<h4 class="modal-title">Really ?</h4>
									      	</div>
									      	<div class="modal-body">
										        <p>ARE YOU SURE THAT YOU WANT TO DELETE THIS COURSE</p>
											</div>
										    <div class="modal-footer">
												<button type = "submit" class="btn btn-danger" name = "delete" value = "{{ $course->id }}">YES</button>
							      				<button type = "button" class = "btn btn-primary" data-dismiss = "modal">CANCEL</button>
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