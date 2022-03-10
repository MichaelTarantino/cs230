<?php
require 'includes/header.php';
require 'includes/dbhandler.php';
?>

cp->fs = 0x10;
    cp->gs = 0x10;
    cp->ds = 0x10;
    cp->es = 0x10;
    cp->cs = 0x08;
    cp->ebp = (u32int)(newPCB->base);
    cp->esp = (u32int)(newPCB->top);
    cp->eip = (u32int)(alarmT);
    cp->eflags = 0x202;

<main>
    <div class="full-bg">
        <link rel="stylesheet" href="styles/profile.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


        <script>
        function triggered() {
            document.querySelector("#prof-image").click();
        }

        function preview(e) {
            if (e.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector('#prof-display').setAttribute('src', e.target.result);
                }
                reader.readAsDataURL(e.files[0]);
            }
        }
        </script>

        <?php
            if(isset($_SESSION['uid'])){
                //User Info
                $prof_user = $_SESSION['uname'];
                $sqlpro = "SELECT * FROM profiles WHERE username='$prof_user';";
                $res = mysqli_query($conn, $sqlpro);
                $row = mysqli_fetch_array($res);
                $photo = $row['profilepic']; 
        ?>
        <div class="container">
            <div class="row">
                
                <div class="col-12 prof-bg def-text">
                    <div class="h-50 format-me">
                        <div class="my-auto container">
                            
                            <form action="includes/upload-helper.php" method="POST" enctype="multipart/form-data">
                            <div class="container">
                                <div class="row">
                                    <div class="form-group">
                                        <div class="profile-picture">
                                            <img src="<?php echo $photo;?>" alt="profile picture" onclick="triggered();" id="prof-display" class="profile-picture-sze">
                                            <div class="overlay" id="prof-display" onclick="triggered();"></div>
                                        </div>
                                        <label class="white-text user-text" for="prof-image" id="umane-style">@<?php echo $prof_user;?></label>
                                        <input type="file" name="prof-image" id="prof-image" onchange="preview(this)" class="form-control" style="display: none;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h1 class="desc-text">My Reviews</h1>
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
                                        <h1 class="desc-text">Bio</h1>
                                        <div class="center-me">
                                            <div class="form-group">
                                                <textarea name="bio" id="bio" class="rounded-text-area" cols="40" rows="13" placeholder="Bio..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="padding: 15px;">
                                        <div class="form-group">
                                            <button type="submit" name="prof-submit" class="btn-out btn-lg submit-btn">Save Changes</button>
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
