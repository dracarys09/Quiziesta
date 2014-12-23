<?php	 
	$selectvalue 	= $_GET['svalue'];
	
 		if($selectvalue == "student")
 		{
 			echo '

 			<div class = "form-group">
 				<label for = "name" class = "col-sm-2 control-label">Name</label>
 				<div class = "col-sm-10">
 					<input type = "text" name = "name" id = "name" class = "form-control" placeholder = "Your name" required />
 				</div>
 			</div>

 			<div class = "form-group">
 				<label for = "rollno" class = "col-sm-2 control-label">Roll No.</label>
 				<div class = "col-sm-10">
 					<input type = "text" name = "rollno" id = "rollno" class = "form-control" placeholder = "Your roll number" required />
 				</div>
 			</div>

 			<div class = "form-group">
 				<label for = "email" class = "col-sm-2 control-label">Email</label>
 				<div class = "col-sm-10">
 					<input type = "email" name = "email" id = "email" class = "form-control" placeholder = "someone@example.com" required />
 				</div>
 			</div>

 			<div class = "form-group">
 				<label for = "branch" class = "col-sm-2 control-label">Branch</label>
 				<div class = "col-sm-10">
 					<input type = "text" name = "branch" id = "branch" class = "form-control" placeholder = "Your branch" required />
 				</div>
 			</div>

 			<div class = "form-group">
 				<label for = "year" class = "col-sm-2 control-label">Year</label>
 				<div class = "col-sm-10">
 					<input type = "text" name = "year" id = "year" class = "form-control" placeholder = "Your batch year" required />
 				</div>
 			</div>

 			<div class = "form-group">
 				<label for = "dob" class = "col-sm-2 control-label">DOB</label>
 				<div class = "col-sm-10">
 					<input type = "date" name = "dob" id = "dob" class = "form-control" required />
 				</div>
 			</div>

 			';
 		}
 		else if($selectvalue == "instructor")
 		{
 			echo '

 			<div class = "form-group">
 				<label for = "name" class = "col-sm-2 control-label">Name</label>
 				<div class = "col-sm-10">
 					<input type = "text" name = "name" id = "name" class = "form-control" placeholder = "Your name" required />
 				</div>
 			</div>

 			<div class = "form-group">
 				<label for = "department" class = "col-sm-2 control-label">Department</label>
 				<div class = "col-sm-10">
 					<input type = "text" name = "department" id = "department" class = "form-control" placeholder = "Your department" required />
 				</div>
 			</div>

 			<div class = "form-group">
 				<label for = "email" class = "col-sm-2 control-label">Email</label>
 				<div class = "col-sm-10">
 					<input type = "email" name = "email" id = "email" class = "form-control" placeholder = "someone@example.com" required />
 				</div>
 			</div>

 			<div class = "form-group">
 				<label for = "dob" class = "col-sm-2 control-label">DOB</label>
 				<div class = "col-sm-10">
 					<input type = "date" name = "dob" id = "dob" class = "form-control" required />
 				</div>
 			</div>

 			';
 		}

 		echo '

 			<div class = "form-group">
 				<div class = "col-sm-10" style = "margin-left:17%;">
 					<input type = "submit" name = "submit" class = "btn btn-success" value = "Sign Up" style = "width:100%;" />
 				</div>
 			</div>

 		';
?>