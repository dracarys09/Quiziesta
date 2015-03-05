@extends('student.dashboard')
@section('student_main_content')

    <script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>

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

                <div class = "box box-primary">
                	<div class = "box-header">
                		<div class = "row">
                			<div class = "col-sm-5"></div>
                			<div class = "col-sm-4">
                				<h3 class = "box-title">{{ $quiz->quiz_title }}</h3>
                			</div>
                		</div>
                		<div class = "row">
                			<div class = "col-sm-4"></div>
                			<div class = "col-sm-4" style = "margin-left:4%;">
                				<h5 class = "h5"> {{ $course->course_name }} &nbsp; ({{ $course->course_number }})</h5>
                			</div>
                		</div>
                		<div class = "row">
                			<div class = "col-sm-4"></div>
                			<div class = "col-sm-4" style = "margin-left:9%;">
                				<h6 class = "h6"> {{ $quiz->quiz_date }} </h6>
                			</div>
                		</div>
                	</div>

                	<hr>

                	<div class = "box-body">
                        <form method = "POST" action = "{{ URL::route('submit_quiz') }}">

                        <!-- Questions -->
                        <div class = "quiz_room">
                            <ul>
                                @foreach($mcq as $question)
                                    <li class = "questions">
                                        <p>{{ $question->problem_statement }}</p>
                                        @if($question->image != "")
                                            <img src="{{ $question->image }}" height = "400" width = "500">
                                        @endif
                                        <hr>
                                        <ol type = "A">
                                            <li>{{$question->option1}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type = "checkbox" name = "mcq{{ $question->id }}[]" value = "option1"></li>
                                            <li>{{$question->option2}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type = "checkbox" name = "mcq{{ $question->id }}[]" value = "option2"></li>
                                            <li>{{$question->option3}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type = "checkbox" name = "mcq{{ $question->id }}[]" value = "option3"></li>
                                            <li>{{$question->option4}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type = "checkbox" name = "mcq{{ $question->id }}[]" value = "option4"></li>
                                        </ol>
                                        <br>
                                        <br>
                                    </li>
                                @endforeach
                                @foreach($truefalse as $question)
                                    <li class = "questions">
                                        <p>{{ $question->problem_statement }}</p>
                                        @if($question->image != "")
                                            <img src="{{ $question->image }}" height = "400" width = "500">
                                        @endif
                                        <hr>
                                        <input type = "radio" name = "truefalse{{ $question->id }}" value = "true">TRUE
                                        <input type = "radio" name = "truefalse{{ $question->id }}" value = "false">FALSE
                                        <br>
                                        <br>
                                    </li>
                                @endforeach
                                @foreach($oneword as $question)
                                    <li class = "questions">
                                        <p>{{ $question->problem_statement }}</p>
                                        @if($question->image != "")
                                            <img src="{{ $question->image }}" height = "400" width = "500">
                                        @endif
                                        <hr>
                                        <input type = "text" name = "oneword{{ $question->id }}" class = "form-control" placeholder = "Type your answer here">
                                        <br>
                                        <br>
                                    </li>
                                @endforeach
                            </ul>
                        </div>  
                        <br>
                        <br>
                		<button type = "submit" name = "submit_quiz" value = "{{ $quiz->id }}" class = "btn btn-success" style = "width:100%;">SUBMIT ANSWERS</button>
                        </form>
                	</div>

                </div>

			</section>		<!-- /.left col -->
			
		</div>	<!-- /.row (main row) -->
	
	</section>	<!-- /.content -->

    <script>
            $('document').ready(function()
            {
                var button = $("<a></a>");
                button.addClass('btn btn-primary').attr('href','#');
                var nxtbutton = button.clone().append('Next').css('float','right').addClass('next-button');
                var prvbutton = button.clone().append('Previous').css('float','left').addClass('prev-button');
                // $('li.questions').each(function()
                // {
                //  $(this).append(button);
                // })

                $('li.questions:not(:last-child)').append(nxtbutton);
                
                $('li.questions:not(:first-child)').fadeOut().append(prvbutton);

                $('.next-button').bind('click',function()
                {
                    var nxtdiv = $(this).parent('li.questions').next();
                    $(this).parent('li.questions').fadeOut('fast',function(){
                        nxtdiv.fadeIn();
                    })
                    
                })

                $('.prev-button').bind('click',function()
                {
                    var nxtdiv = $(this).parent('li.questions').prev();
                    $(this).parent('li.questions').fadeOut('fast',function(){
                        nxtdiv.fadeIn();
                    })
                    
                })
                    // $('li.questions').each.append(button);
            })
        </script>
        

@stop