<?php

// add in html header
include './views/header.html.php';

// add in ability to autoload classes
include './autoload.php';

// initialize required classes
$fileHandler = new FileHandler();
$util = new Util();

// set up model data for views to display
$errors = [];
$message = '';

// if request is of post type then handle file uploads
if($util->isPostRequest()) {
    try {
        $fileName = $fileHandler->upload('upFile');
        $message = 'File uploaded successfully.';
    } catch(FileException $e) {
        $errors[] = $e->getMessage();
    }
}

// include necessary views
include './views/errors.html.php';
include './views/messages.html.php';
include './views/upload-form.html.php';

// add in html footer
include './views/footer.html.php';
?>
