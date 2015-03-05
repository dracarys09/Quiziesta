<html>
	<head>
		<title> Quiz Online </title>
		<style>
			li.questions{
				height:100px;
				width: 500px;
				background-color:#ccc;
				color: #000;
				list-style-type: none;
			}

		</style>
	</head>

	<body>

		<div class="quiz_room">

			<ul>
				<li class="questions">
					<p> Question 1</p>
				</li>

				<li class="questions">
					<p> Question 2</p>
				</li>
				
				<li class="questions">
					<p> Question 3</p>
				</li>
				
				<li class="questions">
					<p> Question 4</p>
				</li>
				
				<li class="questions">
					<p> Question 5</p>
				</li>
				
				<li class="questions">
					<p> Question 6</p>
				</li>
			</ul>
		</div>
		<script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
		<script>
			$('document').ready(function()
			{
				var button = $("<a></a>");
				button.addClass('btn btn-primary').attr('href','#');
				var nxtbutton = button.clone().append('Next').css('float','right').addClass('next-button');
				var prvbutton = button.clone().append('Previous').css('float','left').addClass('prev-button');
				// $('li.questions').each(function()
				// {
				// 	$(this).append(button);
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
		
	</body>

</html>