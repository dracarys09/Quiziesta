<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Automated Quiz System</title>

    <!-- Bootstrap core CSS -->
    {{ HTML::style('css/bootstrap.min.css') }}

    <!-- Custom styles for this template -->
    {{ HTML::style('css/cover.css') }}

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    {{ HTML::script('js/ie-emulation-modes-warning.js') }}

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class = "site-wrapper">
      <div class = "site-wrapper-inner">
        <div class = "cover-container">

          @yield('content')
        
          <div class="mastfoot">
            <div class="inner col-sm col-sm-11">
              <p><a href="{{ URL::to('/') }}">Automated Quiz System</a>, by <a href="#">Abhijeet Dubey</a></p>
            </div>
          </div>
        
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!--jquery-->
    {{ HTML::script('js/jquery-2.1.1.js') }}

    <!--Bootstrap-->
    {{ HTML::script('js/bootstrap.min.js') }}
    
    {{ HTML::script('js/docs.min.js') }}
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    {{ HTML::script('js/ie10-viewport-bug-workaround.js') }}

    <!-- signup form display script -->
    <script>

      $(document).ready(function($) {
            var list_select_id = 'entity'; //second select list ID
            var list_target_id = 'remaining-form'; //div id
            var initial_target_html = 'select a valid type';

            $('#'+list_select_id).change(function(e) {
            //Grab the chosen value on first select list change
            var selectvalue = $(this).val();
 
            if (selectvalue == "") {
            //Display initial prompt in target select if blank value selected
            $('#'+list_target_id).html(initial_target_html);
            } else {
            //Make AJAX request, using the selected value as the GET
            $.ajax({url: '/getRemainingForm.blade.php?svalue='+selectvalue,
             success: function(output) {
                //alert(output);
                $('#'+list_target_id).html(output);
            },
              error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + " "+ thrownError);
            }});
              }
            });
          });

    </script>

  
  </body>

</html>
