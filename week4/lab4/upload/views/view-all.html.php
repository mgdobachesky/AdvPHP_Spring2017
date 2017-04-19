<h1>Files</h1>
<?php $fileNumber = 0 ?>

<table class="table">
    <thead>
        <tr>
            <th>File Name</th>
            <th>View</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        
    <?php foreach($directory as $file): ?>
        <?php if($file->isFile()): ?>
        <tr>
            <td>
                <strong><?php echo ++$fileNumber ?>. </strong>
                <span><?php echo $file->getFilename(); ?></span>
            </td>
            <td><a href="./file-read.php?&name=<?php echo $file->getFilename(); ?>"><span class="glyphicon glyphicon-eye-open"></span></a></td>
            <td><a href="./files.php?action=delete&name=<?php echo $file->getFilename(); ?>"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
        <?php endif; ?>
    <?php endforeach; ?>
        
    </tbody>
</table>


