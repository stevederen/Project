<?php
if (isset($_POST['submit'])){
    $file = $_FILES['file'];

    //File variables
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    //Files allowed
    $allowed = array('jpg', 'jpeg', 'png', 'pdf','gif', 'zip', 'txt', 'xls', 'doc', 'docx');
    //File acceptance and where it uploads to
    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) {
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = 'uploads/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                header("Location: index.php?uploadsuccess");
            //Error if file is too big
            } else {
                echo "The file is too big";
            }
        } else {
            echo "There was an error uploading your file";
        }
    //Wrong file type error
    } else{
        echo "Wrong File Type";
    }
}
?>
