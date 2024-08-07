<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Listing</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
        }
        .pagination-box {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }
        .pagination-box a {
            display: inline-block;
            padding: 10px;
            margin: 05px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-decoration: none;
        }
        .pagination-box a.active {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }
        .pagination-box a.disabled {
            pointer-events: none;
            color: #6c757d;
            background-color: #f8f9fa;
            border-color: #dee2e6;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-body">
            <h2 class="text-center card-title">Employee Listing</h2>
            <p class="card-text">Welcome to the listing page. You can search, export data, and upload files.</p>
        </div>
    </div>

    <!-- Search Form -->
    <form method="get" action="<?php echo base_url('Firstpage/index'); ?>" class="mt-3 mb-3">
        <div class="input-group">
            <input type="text" name="search" placeholder="Search..." class="form-control" value="<?php echo $this->input->get('search'); ?>">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Search</button>
                <a href="<?php echo base_url('Firstpage/index'); ?>" class="btn btn-secondary">Reset</a>
                <a href="<?php echo base_url('Firstpage/exportData'); ?>" class="btn btn-success">Export Data</a>
            </div>
        </div>
    </form>

    <form action="<?php echo base_url('Firstpage/uploadimage'); ?>" method="post" enctype="multipart/form-data">
        <input type="file" name="image" />
        <input type="submit" value="Upload Image" />
    </form>
    <div>
        <!-- Display success message if set -->
        <?php if (isset($success_message)): ?>
            <div class="alert alert-success"><?php echo $success_message; ?></div>
        <?php endif; ?>

        <!-- Display uploaded image if set -->
        <?php if (isset($upload_data['file_name'])): ?>
            <img src="<?php echo base_url('upload/sanjeev/' . $upload_data['file_name']); ?>" alt="Uploaded Image">
        <?php endif; ?>
    </div>

    

    <?php if (!empty($Employee_details)) : ?>
    <!-- Employee Data Table -->
    <div class="table-responsive mt-4">
        <table class="table table-hover table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Employee Name</th>
                    <th>Role</th>
                    <th>Department</th>
                    <th>Mobile Number</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($Employee_details as $employee) : ?>
                    <tr>
                        <td><?php echo $employee->id; ?></td>
                        <td><?php echo $employee->Emp_name; ?></td>
                        <td><?php echo $employee->emp_role; ?></td>
                        <td><?php echo $employee->Department; ?></td>
                        <td><?php echo $employee->Mobile_Number; ?></td>
                        <td><?php echo $employee->Email_Id; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <!-- Pagination Links -->
    <div class="pagination-box mt-4">
        <?php echo $pagination_links; ?>
    </div>
    <?php else : ?>
    <div class="alert alert-warning mt-4">No records found.</div>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body> 
</html>
