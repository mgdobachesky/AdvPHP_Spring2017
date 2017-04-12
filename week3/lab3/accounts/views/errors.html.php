<?php if ( isset($errors) && is_array($errors) ) : ?>
    <?php foreach ($errors as $error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endforeach; ?>
<?php endif; ?>
