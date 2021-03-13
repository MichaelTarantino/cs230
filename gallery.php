<?php
require 'includes/header.php';
?>

<main class="full-bg">
    <link rel="stylesheet" href="styles/gallery.css">
    <h1 style="text-align:center;">Reviews</h1>
    <div class="container gallery-grad-bg">
        <div class="row">
            <?php
            include_once 'includes/dbhandler.php';
            $sql = "SELECT * FROM gallery ORDER BY upload_date DESC";
            $query = mysqli_query($conn, $sql);

            while($row = mysqli_fetch_assoc($query)){
                echo'
                <div class="card custom-card" style="width: 21rem;">
                    <a class="custom-a" href="review.php?id='.$row['pid'].'">
                        <img class="card-img-top format-img-size" src="'.$row["picpath"].'" alt="',$row['title'].' picture">
                        <div class="card-body text-format">
                            <h5 class="card-title">'.$row['title'].'</h5>
                                <div style="padding: 5px";>';
                                echo'
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                ';
                                echo'
                                </div>
                                <p class="card-text">'.$row['description'].'</p>
                            </div>
                        </a>
                    </div>
                ';
            }
            ?>
        </div>
    </div>
</main>