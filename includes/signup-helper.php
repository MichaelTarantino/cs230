<?php

if (isset($_POST['signup-submit'])) {

    require 'dbhandler.php';

    $username = $_POST['uname'];
    $firstName = $_POST['fname'];
    $lastName = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['pwd'];
    $password_rep = $_POST['con-pwd'];

    if($password !== $password_rep){
        header("Location: ../signup.php?error=mismatchedPasswords");
        exit();
    }
    else{
        $sql = "SELECT uname FROM users WHERE uname=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../signup.php?error=sqlInjection");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $check = mysqli_stmt_num_rows($stmt);

            if($check>0){
                header("Location: ../signup.php?error=UsernameTaken");
                exit();
            }
            else{
                $sql = "INSERT INTO users (fname, lname, email, uname, password) VALUES(?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                 if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../signup.php?error=sqlInjection");
                    exit();
                }
                else{
                    $hashed = password_hash($password, PASSWORD_BCRYPT);
                    mysqli_stmt_bind_param($stmt, "sssss", $firstName, $lastName, $email, $username, $hashed);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);

                    $sqlImg = "INSERT INTO profiles (username, fname) VALUES ('$username', '$firstName')";
                    mysqli_query($conn, $sqlImg);

                    header("Location: ../signup.php?signup=success");
                    exit();
                }
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }  
} 
else{
     header("Location: ../signup.php");
     exit();   
}
