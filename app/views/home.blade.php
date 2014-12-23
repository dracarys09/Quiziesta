@extends('layouts.master')

@section('content')


          <div class="masthead clearfix">
            <div class="inner">
              <h3 class="masthead-brand">AUTOMATED QUIZ SYSTEM</h3>
              <ul class="nav masthead-nav">
                <li class="active"><a href="{{ URL::to('/') }}">Home</a></li>
              </ul>
            </div>
          </div>

          @if(Session::has('flash_message'))

               @if(Session::has('flash_message'))
                <div class = "container col-sm-10">
                  <div class = "alert alert-success alert-dismissible" role = "alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>{{ Session::get('flash_message') }}</strong></div>
                </div>
          @endif


          @endif

          <div class="inner cover">
            <h1 class="cover-heading col-sm col-sm-11">You've Arrived! Sign In Below...</h1>
            <div class = "container" style = "max-width:500px;">

              <form class="form-horizontal" role="form" method = "POST" action = "{{URL::route('login')}}">
                <div class = "form-group">
                  <div class = "col-sm-10">
                    <h4 class = "h5">Experience the whole new learning environment</h4>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name = "email" placeholder="someone@example.com" value = "{{ (Input::old('email')) ?  Input::old('email')  : ''}}" required autofocus>
                    <span style = "color:red;">{{ $errors->first('email') }}</span>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name = "password" placeholder="Your Password" required>
                    <span style = "color:red;">{{ $errors->first('password') }}</span>
                  </div>
                </div>
                
                <div class = "form-group">
                  <div class = "col-sm-10">
                    <select name = "entity" class = "form-control" id = "entity" required>
                      <option value = "student">Student</option>
                      <option value = "instructor">Instructor</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm col-sm-10">
                    <button type="submit" class="btn btn-danger">Login</button>
                  </div>
                </div>
                {{ Form::token() }}
              </form>

            </div>
            <div class = "col-sm col-sm-10">
              <p class="lead">
                Not a member?<a href = "{{ URL::route('signup') }}" style = "color:green;">Click Here</a> to Signup!
              </p>
            </div>
          </div>

@stop