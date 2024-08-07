<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assetbootstrap/css/bootstrap.min.css">
</head>
<body>

<div class="jumbotron"></div>
<div class="container">
    <h1 align="center">Add Employee Data</h1>
    
    <!-- Add this code to display flash messages -->
    <?php if ($this->session->flashdata('inserted')): ?>
        <div class="alert alert-success">
            <?php echo $this->session->flashdata('inserted'); ?>
        </div>
    <?php endif; ?>
    <!-- End of code for displaying flash messages -->

    <!-- Add this code to display validation errors -->
    <?php if (validation_errors()): ?>
        <div class="alert alert-danger">
            <?php echo validation_errors(); ?>
        </div>
    <?php endif; ?>
    <!-- End of code for displaying validation errors -->

    <form action="<?php echo base_url('Firstpage/addEmployee/'); ?>" method="post">
        <div class="form-group">
            <label for="Emp_name">Employee Name *</label>
            <input type="text" name="Emp_name" placeholder="Enter employee name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="emp_role">Employee role *</label>
            <input type="text" name="emp_role" placeholder="Enter employee role" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="Department">Department *</label>
            <input type="text" name="Department" placeholder="Enter employee Department" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="Mobile_Number">Mobile Number *</label>
            <input type="text" name="Mobile_Number" placeholder="Enter employee contact number" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="Email_Id">Email ID </label>
            <input type="text" name="Email_Id" placeholder="Enter employee Email-id" class="form-control">
        </div>
        <input type="submit" name="insert" value="Add Employee" class="btn btn-primary">
        <button type="button" class="btn btn-secondary" onclick="window.location.href='<?php echo base_url('Firstpage'); ?>'">Close</button>
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
