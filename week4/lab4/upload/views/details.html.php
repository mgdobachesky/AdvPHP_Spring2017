<p><strong>Direct Link: </strong><a href="<?php echo $file ?>"><?php echo $name ?></a></p>
<p><strong>Size: </strong><?php echo $size ?> bytes</p>
<p><strong>Type: </strong><?php echo $type; ?></p>
<p><strong>Date Created: </strong><?php echo date("l F j, Y, g:i a", $finfo->getMTime()); ?></p>
<a href="./files.php?<?php echo 'action=delete&name=' . $name; ?>"><button type="button" class="btn btn-danger">Delete</button></a>

<p></p>

<div class="embed-responsive embed-responsive-4by3">
    <?php echo $displayFile; ?>
</div>