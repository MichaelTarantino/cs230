<?php 
require 'includes/dbhandler.php';
require 'includes/header.php'; 
require 'includes/review-helper.php';
?>

<main>
    <link rel="stylesheet" href="styles/review.css">
    <span id="testAvg"></span>
    <div class="container" align="center" style="max-width: 600px; margin-top: 40px;">
        <div class="my-auto">
            <form class="review-form" id="review-form" action="includes/review-helper.php" method="post">
                <div class="container">
                    <i class="fa fa-star fa-2x star-rev" data-index="1"></i>
                    <i class="fa fa-star fa-2x star-rev" data-index="2"></i>
                    <i class="fa fa-star fa-2x star-rev" data-index="3"></i>
                    <i class="fa fa-star fa-2x star-rev" data-index="4"></i>
                    <i class="fa fa-star fa-2x star-rev" data-index="5"></i>
                </div>
                <div class="form-group">
                    <input type="text" name="review-title" id="review-title" style="width: 40%; margin-bottom: 10px;" placeholder="Title">
                    <textarea name="review" id="review-text" cols="50" rows="3" placeholder="Write a review here..."></textarea>
                    <input type="hidden" name="rating" id="rating">
                    <input type="hidden" name="item_id" value="<?php echo $_GET['id'];?>">
                </div>
                <div class="form-group">
                <button type="submit" name="rev-submit" class="btn-out btn-lg submit-btn">Post Review</button>
                </div>
            </form>
        </div>
    </div>
    <span id="review_list"></span>
</main>

<script type="text/javascript">
var rateIndex = -1;
var id = <?php echo $_GET['id'];?>;


$(document).ready(function() {
    reset_star();

    // get reviews
    xhr_getter('display-reviews.php?id=', "review_list");
    //avg();
    xhr_getter('includes/get-ratings.php?id=', "testAvg");

    if (localStorage.getItem('rating') != null) {
        setStars(parseInt(localStorage.getItem('rating')));
    }
    $('.star-rev').on('click', function() {
        rateIndex = parseInt($(this).data('index'));
        localStorage.setItem('rating', rateIndex);
    });
    $('.star-rev').mouseover(function() {
        reset_star();
        var currIndex = parseInt($(this).data('index'));
        setStars(currIndex);

    });
    $('.star-rev').mouseleave(function() {
        reset_star();

        if (rateIndex != -1) {
            setStars(rateIndex);
        }
    });

    function setStars(max) {
        for (var i = 0; i < max; i++) {
            $('.star-rev:eq(' + i + ')').css('color', 'rgb(149, 214, 0)');
        }
        document.getElementById('rating').value = parseInt(localStorage.getItem('rating'));
        console.log(id);
    }

    function reset_star() {
        $('.star-rev').css('color', 'grey');
    }


    //Used to interchangeably send GET requests for review display data. 
    function xhr_getter(prefix, element) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            // If the GET request was successful, fill in the span element with the review_list id with reviews
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById(element).innerHTML = this.responseText;
            }
        };
        url = prefix + id;
        xhttp.open("GET", url, true);
        xhttp.send();
    }
});
</script>