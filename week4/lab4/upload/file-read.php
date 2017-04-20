<?php
// add in html header
include './views/header.html.php';

// add in ability to autoload classes
include './autoload.php';

// initialize required classes
$util = new Util();

// initialize get parameters
$name = $util->getUrlParam('name');

// define the file
$file = '.' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $name;

// declare finfo and get MIME type of file
$mimeInfo = new finfo(FILEINFO_MIME_TYPE);
$type = $mimeInfo->file($file);

// define $finfo to hold an SqlFileInfo object
$finfo = new SplFileInfo($file);

// define the file size
$size = $finfo->getSize();

// prepare the file to be displayed
switch($type) { 
    case ($type == 'image/jpeg') || ($type == 'image/png') || ($type == 'image/gif'):
        $displayFile = '<img src="' . $file . '" />';
        break;
    case ($type == 'text/plain'):
        $fileObject = new SplFileObject($file, "r");
        $contents = $fileObject->fread($fileObject->getSize());
        $displayFile = '<textarea class="embed-responsive-item">' . $contents . '</textarea>';
        break;
    case ($type =='text/html') || ($type == 'application/pdf'):
        //$displayFile = '<object src="' . $file . '"><embed src="' . $file . '"></embed></object>';
        $displayFile = '<iframe class="embed-responsive-item" src="' . $file . '"></iframe>';
        break;
    default:
        $displayFile = "";
 } 

// add in necessary view
include './views/details.html.php';

// add in html footer
include './views/footer.html.php';
?>