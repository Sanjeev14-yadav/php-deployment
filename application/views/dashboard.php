<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assetbootstrap/css/bootstrap.min.css">
</head>
<body>



	<div class="container">
	
	</div>

<!-- 	<div class="box1">
		<h1 align="center">Employee Data</h1>
	</div> -->
			<!-- Box for simple text and heading -->

	<div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <h2  align="center" color="pink" class="card-title">Employee Data</h2>
                <p class="card-text">Welcome to employee page.</p>
            </div>
        </div>
    </div>
    <!-- Image at a desired location -->
    <div class="container">
        <img src="<?php echo base_url(); ?>C:/Users/HP/Downloads/img1.jpg" alt="img.jpg" class="img-fluid">
    </div>
	<div class="container">
		<div class="clear-fix">




    
<h3 style="float: left">All Employee Data</h3>
			<!-- <a href="#" class="btn btn-primary" style="float: right" >Add Employee</a> -->

<!-- 		
	</div>

		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add Employee</button>
	</div> -->
		<!-- <table class="table table-hover table-bordered table-striped"> --------table formatting --> 
	<table class="table table-hover table-bordered table-striped">
		<!-- Table headers -->
		<thead>
			<tr>
				<th>id</th>
				<th>Employee name</th>
				<th>emp_role</th>
				<th>Department</th>
				<th>Mobile Number</th>
				<th>Email ID</th>
				<th>Password</th>
				<th>Update</th>
				<th>Delete</th>

			</tr>
		</thead>
		<tbody>
		<?php 
$id=1;
			foreach($Employee_details as $employee):?>
<!-- Display employee data -->
				<tr>
					<td>
						<?php echo $id; ?>
					</td>
					<td>
						<?php echo $employee->Emp_name; ?>
					</td>
					<td>
						<?php echo $employee->emp_role; ?>
					</td>
					<td>
						<?php echo $employee->Department; ?>
					</td>
					<td>
						<?php echo $employee->Mobile_Number; ?>
					</td>
					<td>
						<?php echo $employee->Email_Id; ?>
					</td>
					<td>
						<?php echo $employee->password; ?>
					</td>
					<td>
						<a href="<?php echo base_url(); ?>Firstpage/updateEmployee/<?php echo $employee->id; ?>" class="btn btn-success">Update</a>
					</td>
					<td>
						<!-- Use simple onclick for delete confirmation -->
						<button class="btn btn-danger" onclick="confirmDelete(<?php echo $employee->id; ?>)">Delete</button>
					</td>
				</tr>
			<?php $id++; endforeach;?>
		</tbody>
	</table>
	<!-- Add Employee button -->
	<a href="<?php echo base_url(); ?>Firstpage/addEmployee/" class="btn btn-success">Add Employee</a>

    <script>
    // JavaScript function to show delete confirmation-- To show pop up message on Screen jab delete karenge.
    function confirmDelete(employeeId) {
        // Use the built-in confirm function
        var confirmed = confirm("Are you sure you want to delete this employee?");
        
        // If the user confirms, redirect to the delete URL
        if (confirmed) {
            window.location.href = "<?php echo base_url(); ?>Firstpage/deleteEmployee/" + employeeId;
        }
    }
</script>


<?php if($this->session->flashdata('error')): ?>
<div align="center" style="color: #FFF" class="bg-danger">
<?php echo ($this->session->flashdata('error')); ?>
</div>

<?php endif; ?>

<?php if($this->session->flashdata('inserted')): ?>
<div align="center" style="color: #FFF" class="bg-success">
<?php echo ($this->session->flashdata('inserted')); ?>
</div>

<?php endif; ?>

<?php if($this->session->flashdata('updated')): ?>
<div align="center" style="color: #FFF" class="bg-success">
<?php echo ($this->session->flashdata('updated')); ?>
</div>

<?php endif; ?>

<?php if($this->session->flashdata('deleted')): ?>
<div align="center" style="color: #FFF" class="bg-success">
<?php echo ($this->session->flashdata('deleted')); ?>
</div>

<?php endif; ?>



<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body> 
</html>  
