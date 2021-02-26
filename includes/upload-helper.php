<?php

require 'dbhandler.php';
session_start();

define('KB', 1024);
define('MB', 1048576);

if(isset($_POST['prof-submit'])){

    $uname = $_SESSION['uname'];

}else{
    header("Location: ../profile.php");
    exit;
}
