<h3>File Uploaded Successfully</h3>
<?php if (isset($error)): ?>
        print_r('hello');
    <p><?php echo $error; ?></p>
<?php endif; ?>

<?php if (isset($upload_data) && is_array($upload_data)): ?>
    <ul>
        <?php foreach ($upload_data as $item => $value): ?>
            <li><?php echo $item; ?>: <?php echo $value; ?></li>
            
        <?php endforeach; ?>
        print_r('sanjeev ydava');
    </ul>
<?php endif; ?>

<?php if (isset($file_url)): ?>
    <?php $file_extension = pathinfo($file_url, PATHINFO_EXTENSION); ?>
    <?php if ($file_extension === 'pdf'): ?>
        <iframe src="<?php echo $file_url; ?>" width="100%" height="500px"></iframe>
    <?php elseif (in_array($file_extension, array('jpg', 'jpeg'))): ?>
        <img src="<?php echo $file_url; ?>" alt="Uploaded Image" width="100%">
    <?php endif; ?>
    <!-- print_r('s3242937489327493287a'); -->
<?php endif; ?>
