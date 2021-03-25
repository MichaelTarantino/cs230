<?php

$servename = "localhost";
$DBuname = "phpmyadmin";
$DBPass = "cs230lab";
$DBname = "cs230";

$conn = mysqli_connect($servename, $DBuname, $DBPass, $DBname);

if (!$conn) {
    die("Connection failed...".mysqli_connect_error());
    # code...
}

$item = $_GET['id'];

$sql= "SELECT * FROM reviews where itemid='$item'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        $uname = $row['uname'];
        $profpic = "SELECT profilepic FROM profiles WHERE username = '$uname';";
        $res = mysqli_query($conn, $profpic);
        $picpath = mysqli_fetch_assoc($res);

        echo'    
        <div class="card mx-auto" style="width: 30%; padding: 5px; margin-bottom: 10px;">
            <div class="media">
                <img class="mr-3" src="'.$picpath['profilepic'].'" style="width: 75px; min-height: 75px; max-height: auto; border-radius: 50%;">
                <div class="media-body">
                    <h5 class="mt-0">'.$row['uname'].'</h5>
                    <h5>'.$row['ratingnum'].'/5</h5>
                    <p>'.$row['revdate'].'</p>
                    <p>'.$row['reviewtext'].'</p>
                </div>
            </div>
        </div>
        ';
    }
}
else{
    echo'<h5 style="text-align: center;">No reviews, yet. Be the first to review!</h5>';
}