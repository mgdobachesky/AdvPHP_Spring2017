<?php
// add in html header
include './views/header.html.php';

// add in ability to autoload classes
include './autoload.php';

// initialize required classes
$util = new Util();

// initialize get parameters
$action = $util->getUrlParam('action');
$name = $util->getUrlParam('name');

// declare folder variable and check if files exist
$folder = './uploads';
if(!is_dir($folder)) {
    die('Folder <strong>' . $folder . '</strong> does not exist.');
}

// if a delete is requested then unlink the file
if($action == 'delete') {
    unlink('./uploads/' . $name);
}

// initialize directory iterator
$directory = new DirectoryIterator($folder);

// add in necessary view
include './views/view-all.html.php';

// add in html footer
include './views/footer.html.php';
?>
