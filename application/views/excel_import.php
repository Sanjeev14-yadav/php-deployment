<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Import Excel data into DB</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assetbootstrap/css/bootstrap.min.css">
</head>
<body>

<div class="jumbotron"></div>
<div class="container">
    <h1 align="center">Import Excel data into DB</h1>
    <form id="import_form" action="<?php echo site_url('Excel_import_data/import'); ?>" method="post" enctype="multipart/form-data">
        <p><label>Select Excel file</label>
            <input type="file" name="file" id="file" required accept=".xls, .xlsx"></p>
        <br>
        <input type="submit" name="import" value="Import" class="btn btn-primary">
         
    </form>
   
    <br>
    <div class="table-responsive" id="customer_data">
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // Load data after importing
    $(document).ready(function(){
        load_data();
    });

    function load_data(){
        $.ajax({
            url: '<?php echo base_url(); ?>excel_import_data/fetch',
            method: 'POST',
            success: function(data){
                $('#customer_data').html(data);
            }
        });
    }
</script>
</body>
</html>
