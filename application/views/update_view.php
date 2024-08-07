<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>document</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assetbootstrap/css/bootstrap.min.css">
</head>
<body>

	<div class="jumbotron">
			

	</div>
	<div class="container">
		<h1 align="center">Edit EmpData</h1>
		 <!-- Add this code to display validation errors -->
	    <?php if(validation_errors()): ?>
	        <div class="alert alert-danger">
	            <?php echo validation_errors(); ?>
	        </div>
	    <?php endif; ?>
    	<!-- End of code for displaying validation errors -->

		<form action="<?php echo base_url('Firstpage/update/' . $singleEmp->id); ?>" method="post">

			
			<div class="form-group">
			    <label for="password">Password <span class="required-label">*</span></label>
			    <input type="password" name="password" placeholder="Enter your password" class="form-control" enctype="multipart/form-data" required maxlength="8">
			</div>

      		<div class="from-group">
       			<lable for="Emp_name">Employee Name</lable>
       			<input type="text" name="Emp_name" placeholder="enter employee name" class="form-control" value="<?php echo $singleEmp->Emp_name; ?>">
       		</div>
			<div class="from-group">
       			<lable for="emp_role">Employee role</lable>
       			<input type="text" name="emp_role" placeholder="enter employee role" class="form-control" value="<?php echo$singleEmp->emp_role; ?>">
       		</div>
       		<div class="from-group">
       			<lable for="Department">Department</lable>
       			<input type="text" name="Department" placeholder="enter employee Department" class="form-control" value="<?php echo$singleEmp->Department; ?>">
       		</div>
       		<input type="submit" name="Update" value="update" class="btn-btn-primary">
       		<button type="button" class="btn btn-secondary" onclick="window.location.href='<?php echo base_url('Firstpage'); ?>'">Close</button>
       		
       	</form>

	</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

