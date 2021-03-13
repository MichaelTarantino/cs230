<?php

require 'dbhandler.php';
session_start();

define('KB', 1024);
define('MB', 1048576);

if(isset($_POST['gallery-submit'])){

    $file = $_FILES['gallery-image'];
    $file_name = $file['name'];
    $file_temp = $file['tmp_name'];
    $file_error = $file['error'];
    $file_size = $file['size'];

    $title=$_POST['title'];
    $description=$_POST['description'];

    $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    $allowed = array('jpg', 'jpeg', 'png', 'svg');

    if($file_error ==0){
        if(in_array($ext, $allowed)){
            if($file_size < 8*MB){
                $new_name = uniqid('',true).".".$ext;
                $destination = '../gallery/'.$new_name;
                $sql = "INSERT INTO gallery (title, description, picpath) VALUES (?,?,?)";

                $stmt = mysqli_stmt_init($conn);

                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location ../admin.php?error=InjectionDetected");
                    exit();
                }else{

                    mysqli_stmt_bind_param($stmt, "sss", $title, $description, $destination);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);

                    move_uploaded_file($file_temp, $destination);
                    header("Location: ../admin.php?success=GalleryUpdated");
                    exit();
                }
            }else{
                header("Location: ../admin.php?error=FilesTooPowerful");
                exit();
            }
        }else{
            header("Location: ../admin.php?error=InvalidFileType");
            exit();
        }
    }else{
        header("Location: ../admin.php?error=UploadError");
        exit();
    }

}else{
    header("Location: ../admin.php?error=noAction");
    exit();
}
