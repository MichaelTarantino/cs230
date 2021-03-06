<?php

require 'dbhandler.php';
session_start();

define('KB', 1024);
define('MB', 1048576);

if(isset($_POST['prof-submit'])){

    $uname = $_SESSION['uname'];
    $file = $_FILES['prof-image'];
    $file_name = $file['name'];
    $file_temp = $file['tmp_name'];
    $file_error = $file['error'];
    $file_size = $file['size'];

    $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    $allowed = array('jpg', 'jpeg', 'png', 'svg');

    if($file_error ==0){
        if(in_array($ext, $allowed)){
            if($file_size < 8*MB){
                $new_name = uniqid('',true).".".$ext;
                $destination = 'profiles/'.$new_name;
                $sql = "UPDATE profiles SET profilepic='$destination' WHERE username='$uname'";
                mysqli_query($conn, $sql);
                move_uploaded_file($file_temp, $destination);
                header("Location: ../profile.php?success=UploadComplete");
                exit();
            }else{
                header("Location: ../profile.php?error=FilesTooPowerful");
                exit();
            }
        }else{
            header("Location: ../profile.php?error=InvalidFileType");
            exit();
        }
    }else{
        header("Location: ../profile.php?error=UploadError");
        exit();
    }

}else{
    header("Location: ../profile.php?error=noAction");
    exit();
}
