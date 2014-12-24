@extends('instructor.dashboard')

@section('instructor_main_content')

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

				<form class = "form-horizontal" role = "form" method = "post" action = "{{ URL::route('add_course') }}">
					
					<div class = "form-group">
						<label for = "course_name" class = "col-sm-2 control-label">Course Name</label>
						<div class = "col-sm-10">
							<input type = "text" name = "course_name" id = "course_name" placeholder = "Enter the course name" class = "form-control"  value = "{{ (Input::old('course_name')) ? Input::old('course_name') : '' }}" autofocus required>
							<span style = "color:red;">{{ $errors->first('course_name') }}</span>
						</div>
					</div>

					<div class = "form-group">
						<label for = "course_number" class = "col-sm-2 control-label">Course Number</label>
						<div class = "col-sm-10">
							<input type = "text" name = "course_number" id = "course_number" placeholder = "Enter the course number" class = "form-control" value = "{{ (Input::old('course_number')) ? Input::old('course_number') : '' }}" required>
							<span style = "color:red;">{{ $errors->first('course_number') }}</span>
						</div>
					</div>

					<div class = "form-group">
						<label for = "course_description" class = "col-sm-2 control-label">Course Description</label>
						<div class = "col-sm-10">
							<textarea name = "course_description" id = "course_description" placeholder = "Enter course description or a link to course description page" class = "form-control textarea" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required>{{ (Input::old('course_description')) ? Input::old('course_description') : '' }}</textarea>
							<span style = "color:red;">{{ $errors->first('course_description') }}</span>
						</div>
					</div>

					<div class = "form-group">
						<label for = "course_contents" class = "col-sm-2 control-label">Course Contents</label>
						<div class = "col-sm-10">
							<textarea name = "course_contents" id =  "course_contents" placeholder = "Enter course contents or a link to course contents page" class = "form-control textarea" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required>{{ (Input::old('course_contents')) ? Input::old('course_contents') : '' }}</textarea>
							<span style = "color:red;">{{ $errors->first('course_contents') }}</span>
						</div>
					</div>

					<div class = "form-group">
						<label for = "start_date" class = "col-sm-2 control-label">Start Date</label>
						<div class = "col-sm-10">
							<input type = "date" name = "start_date" id = "start_date" class = "form-control" value = "{{ (Input::old('start_date')) ? Input::old('start_date') : '' }}">
							<span style = "color:red;">{{ $errors->first('start_date') }}</span>
						</div>
					</div>

					<div class = "form-group">
						<label for = "end_date" class = "col-sm-2 control-label">End Date</label>
						<div class = "col-sm-10">
							<input type = "date" name = "end_date" id = "end_date" class = "form-control" value = "{{ (Input::old('end_date')) ? Input::old('end_date') : '' }}">
							<span style = "color:red;">{{ $errors->first('end_date') }}</span>
						</div>
					</div>

					<div class = "form-group">
						<div class = "col-sm-10" style = "margin-left:16.5%;">
							<input type = "submit" name = "add_course" value = "Add Course" class = "btn btn-primary" style = "width:100%;">
						</div>
					</div>

				</form>

            </section><!-- /.Left col -->
                        
        </div><!-- /.row (main row) -->

    </section><!-- /.content -->

@stop