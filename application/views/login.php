<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assetbootstrap/css/bootstrap.min.css">
</head>
<body>
<div class="jumbotron"></div>
<div class="container">
    <h1 align="center">Login</h1>
    		 <!-- Add this code to display validation errors -->
        <!-- Add this code to display flash messages -->
    <?php if ($this->session->flashdata('login')): ?>
        <div class="alert alert-success">
            <?php echo $this->session->flashdata('login'); ?>
        </div>
    <?php endif; ?>
    <?php if(validation_errors()): ?>
	    <div class="alert alert-danger">
	        <?php echo validation_errors(); ?>
	    </div>
	<?php endif; ?>
    	<!-- End of code for displaying validation errors -->
    
    <form method="post" action="<?php echo base_url('Sign/login/'); ?>" enctype="multipart/form-data">

        <div class="form-group">
            <label for="Email_Id">Email ID </label>
            <input type="email" name="Email_Id" placeholder="Enter your Email-id" class="form-control">
        <div>
        <div class="form-group">
			<label for="password">Password <span class="required-label">*</span></label>
			<input type="password" name="password" placeholder="Enter your password" class="form-control" enctype="multipart/form-data" required>
		</div>
        <div class="form-group">
			<label for="confirm_password">Confirm Password <span class="required-label">*</span></label>
			<input type="password" name="confirm_password" placeholder="Please Confirm Password" class="form-control" enctype="multipart/form-data" required>
		</div>

        <input type="submit" name="Login" value="Login" class="btn-btn-primary">
        <!-- <button type="submit" onclick="window.location.href='<?php echo base_url('Firstpage'); ?>'">Sign Up</button> -->
    </form>
    </div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>
</html>