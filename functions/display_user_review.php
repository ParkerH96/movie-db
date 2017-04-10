<!--
  Team Databased 2017: Movie-DB
  Author(s): Evan Heaton

  Name: display_user_review.php

  Description: This file contains the PHP code used for displaying user reviews on a movie page

-->

<?php
  function displayUserReview($first_name, $last_name, $rating, $review) {
    include_once 'star_rating.php';
    echo '<div class="user-review">
            <h3>' . $first_name . ' ' . $last_name . '</h3>
            <div class="rating">';
              displayStarRating($rating, 1);
    echo '  </div>
            <span>' . $review . '</span>
          </div>';

  }
?>
