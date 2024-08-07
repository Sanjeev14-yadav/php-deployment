

<h3>Uploaded Image</h3>
<?php if (isset($upload_data) && is_array($upload_data)): ?>
    <p>Image uploaded successfully!</p>
    <img src="<?php echo base_url('upload/sanjeev' . $upload_data['file_name']); ?>" alt="Uploaded Image">
<?php else: ?>
    <p>Image upload failed.</p>
<?php endif; ?>


<!-- Display uploaded image
<img src="<?php echo base_url('upload/sanjeev' . $image_path); ?>" alt="Uploaded Image"> -->
