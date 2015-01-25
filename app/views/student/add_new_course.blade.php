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
									<td><a href="#enrolModal{{ $course->id }}" data-toggle = "modal" class = "btn btn-primary">ENROL</a></td>

									<!-- Enrol Modal -->
									<div class="modal fade" id = "enrolModal{{ $course->id }}">
									   	<div class="modal-dialog">
										<div class="modal-content">
										    <div class="modal-header">
										     	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
										      		<h4>Are You Sure ?</h4>
										    </div>
										     	
										    <div class="modal-body">
										       	<form action = "{{ URL::route('student_add_course') }}" method = "post">
										    </div>

										    <div class="modal-footer">
												<button type = "submit" class="btn btn-success" name = "enrol" value = "{{ $course->id }}">CONFIRM</button>
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

            </section><!-- /.Left col -->
                        
        </div><!-- /.row (main row) -->

    </section><!-- /.content -->

@stop