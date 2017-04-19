<?php

/**
 * Class to handle file uploads
 *
 * @author mike91doby
 */
class FileHandler {

    /**
     * Method used to upload files
     * 
     * @param type $keyName - name of the file to be uploaded
     */
    function upload($keyName) {

        // if file is undefined or there are multiple files throw error
        if (!isset($_FILES[$keyName]['error']) || is_array($_FILES[$keyName]['error'])) {
            throw new FileException('Invalid parameters.');
        }

        // check to see what the value of $_FILES['$keyName']['error'] is
        switch ($_FILES[$keyName]['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new FileException('No file sent.');
            case UPLOAD_ERR_INI_SIZE:
                throw new FileException('INI size problem.');
            case UPLOAD_ERR_FORM_SIZE:
                throw new FileException('Exceeded filesize limit.');
            default:
                throw new FileException('Unknown error.');
        }

        // also check the filesize in the $_FILES superglobal
        if ($_FILES[$keyName]['size'] > 1000000) {
            throw new FileException('Exceeded filesize limit.');
        }

        // check file MIME type
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $validExts = array(
            'txt' => 'text/plain',
            'html' => 'text/html',
            'pdf' => 'application/pdf',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'xls' => 'application/vnd.ms-excel',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif'
        );
        $ext = array_search($finfo->file($_FILES[$keyName]['tmp_name']), $validExts, true);

        // throw exception if file format is not accepted
        if ($ext === false) {
            throw new FileException('Invalid file format.');
        }

        // name file with a unique name
        $salt = uniqid(mt_rand(), true);
        $fileName = $ext . '_' . sha1($salt . sha1_file($_FILES[$keyName]['tmp_name']));

        // set location of file and move it there
        $location = sprintf('./uploads/%s.%s', $fileName, $ext);

        // create uploads directory if it doesn't exist
        if (!is_dir('./uploads')) {
            mkdir('./uploads');
        }

        // attempt to move file and throw error if the move fails
        if (!move_uploaded_file($_FILES[$keyName]['tmp_name'], $location)) {
            throw new FileException('Failed to move uploaded file.');
        }

        // return the file name with extension
        return $fileName . "." . $ext;
    }

}

?>