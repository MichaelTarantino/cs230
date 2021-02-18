<?php
require "includes/header.php"
?>

<main>
    <link rel="stylesheet" href="styles/login.css">
    <div class="bg-cover">
        <div class="container center-img">
            <div class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block mx-auto" src="images/m1.png" alt="Regular Monster">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block mx-auto" src="images/m2.png" alt="LO-Carb Monster">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block mx-auto" src="images/m3.png" alt="Monster Assault">
                    </div>
                </div>
            </div>
        </div>
        <div class="h-40 center-me">
            <div class="my-auto">
                <div class="signin-form">
                    <form action="includes/login-helper.php" method="post">
                        <div class="white-text">
                            <h1 class="h3 mb-3 font-weight-normal">Sign In</h1>
                        </div>
                        <input type="text" class="form-control" name="uname-email" placeholder="Username/Email" required
                            autofocus>
                        <label for="inputPassword" class="sr-only">Password</label>
                        <input type="password" id="inputPassword" class="form-control" name="pwd" placeholder="Password"
                            required>
                        <button class="btb btn-lg submit-btn btn-block" name="login-submit" type="submit">Sign
                            In</button>
                        <p class="hint-text white-text">Need an account? <a class="m-hyperlink" href="signup.php">Sign
                                Up</a></p>
                        <p class="mt-2 mb-3 text-muted">&copy: 2018-2023</p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>