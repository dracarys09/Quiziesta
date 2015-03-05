<html>
<head>
	<title>File Upload</title>
</head>
<body>

	<form name = "file-upload" method = "POST" action = "{{ URL::route('random2') }}" enctype = "multipart/form-data">

		<label for = "mcq">IMAGE</label>
		<input type = "file" name = "mcq" id = "mcq">

		<button type = "submit" name = "mcq-upload">UPLOAD IMAGE</button>
		
	</form>

</body>
</html>