@extends('layouts.master')

@section('content')
  

    <div class="masthead clearfix">
            <div class="inner">
              <h3 class="masthead-brand">Automated Quiz System</h3>
              <ul class="nav masthead-nav">
                <li><a href="{{ URL::to('/') }}">Home</a></li>
              </ul>
            </div>
    </div>

   @if(Session::has('flash_message'))
    <div class = "container col-sm-10">
      <div class = "alert alert-danger alert-dismissible" role = "alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>{{ Session::get('flash_message') }}</strong></div>
    </div>
   @endif

      <div class = "container col-sm-10">
              <form class="form-horizontal" role="form" method = "POST" action = "{{ URL::route('signup') }}">
              
                <div class = "form-group">
                  <label for = "entity" class = "col-sm-2 control-label">Type</label>
                  <div class = "col-sm-10">
                    <select name = "entity" id = "entity" class = "form-control" required>
                      <option value = "">Select</option>
                      <option value = "student">Student</option>
                      <option value = "instructor">Instructor</option>
                    </select>
                  </div>
                </div>

                <!-- remaining form will be displayed after the entity type is selected by the use of AJAX -->
              
                <div id = "remaining-form">
                  <!-- AJAX will display the form according to the selected type -->
                </div>


                {{ Form::token() }}
              </form>
      </div>



  @stop

