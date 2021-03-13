<?php
require 'includes/header.php';
require 'includes/dbhandler.php';
?>

<main>
    <div class="full-bg">
        <link rel="stylesheet" href="styles/admin.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


        <script>
        function triggered() {
            document.querySelector("#gallery-image").click();
        }

        function preview(e) {
            if (e.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector('#gallery-display').setAttribute('src', e.target.result);
                }
                reader.readAsDataURL(e.files[0]);
            }
        }
        </script>

        <?php
            if(isset($_SESSION['uid'])){
                //User Info
                $prof_user = $_SESSION['uname'];
                $sqlpro = "SELECT * FROM  WHERE username='$prof_user';";
                $res = mysqli_query($conn, $sqlpro);
                $row = mysqli_fetch_array($res);
                $photo = $row['pic']; 
        ?>
        <div class="container">
            <div class="row">
                
                <div class="col-12 prof-bg def-text">
                    <div class="h-50 format-me">
                        <div class="my-auto container">
                            
                            <form action="includes/gallery-helper.php" method="POST" enctype="multipart/form-data">
                            <div class="container">
                                <div class="row center-me">
                                    <div class="form-group">
                                        <div class="profile-picture">
                                            <img src="images/CEO.jpg" alt="gallery picture" onclick="triggered();" id="gallery-display" class="gallery-picture-sze">
                                            <div class="overlay" id="gallery-display" onclick="triggered();"></div>
                                        </div>
                                        <input type="text" name="title" id="gallery-title" class="form-control" placeholder="Title">
                                        <input type="file" name="gallery-image" id="gallery-image" onchange="preview(this)" class="form-control" style="display: none;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h1 class="desc-text center-me">Preview Review</h1>
                                        <div class="center-me">
                                            <div class="card" style="width: 18rem;">
                                                <img class="card-img-top" src="images/exampleReviewimg.jpg" alt="Example Review Image">
                                                <div class="card-body">
                                                    <h5 class="card-title">Example Review</h5>
                                                    <div style="padding: 5px";>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star"></span>
                                                    </div>
                                                    <p class="card-text">Short review content stored in this card, will eventually come from database of reviews.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <h1 class="desc-text center-me">Description</h1>
                                        <div class="center-me">
                                            <div class="form-group">
                                                <textarea name="description" id="description" class="rounded-text-area" cols="40" rows="13" placeholder="Description"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="padding: 15px;">
                                        <div class="form-group">
                                            <button type="submit" name="gallery-submit" class="btn-out btn-lg submit-btn">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <?php
            }else{
                header('Location: login.php?error=pathedFromProfile');
            }
        ?>
    </div>
</main>