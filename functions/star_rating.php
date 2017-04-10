<!--
  Team Databased 2017: Movie-DB
  Author(s): Evan Heaton

  Name: star_rating.php

  Description: This file contains the PHP code used displaying star ratings

-->
<?php
  // size=1 is smallish icons, size=2 are larger.
  // rating should be out of 10.
  function displayStarRating($rating, $size) {
    if ($size == 1) {
      $full_star = '<i class="fa fa-star" aria-hidden="true"></i> ';
      $half_star = '<i class="fa fa-star-half-o" aria-hidden="true"></i> ';
      $empty_star = '<i class="fa fa-star-o" aria-hidden="true"></i> ';
    } else {
      $full_star = '<i class="fa fa-star fa-2x" aria-hidden="true"></i> ';
      $half_star = '<i class="fa fa-star-half-o fa-2x" aria-hidden="true"></i> ';
      $empty_star = '<i class="fa fa-star-o fa-2x" aria-hidden="true"></i> ';
    }

    if ($rating > 9)       {for ($i=0; $i<5; $i++) echo $full_star;}
    else if ($rating > 8)  {for ($i=0; $i<4; $i++) echo $full_star; echo $half_star;}
    else if ($rating > 7)  {for ($i=0; $i<4; $i++) echo $full_star; echo $empty_star;}
    else if ($rating > 6)  {for ($i=0; $i<3; $i++) echo $full_star; echo $half_star; echo $empty_star;}
    else if ($rating > 5)  {for ($i=0; $i<3; $i++) echo $full_star; for ($i=0; $i<2; $i++) echo $empty_star;}
    else if ($rating > 4)  {for ($i=0; $i<2; $i++) echo $full_star; echo $half_star; for ($i=0; $i<2; $i++) echo $empty_star;}
    else if ($rating > 3)  {for ($i=0; $i<2; $i++) echo $full_star; for ($i=0; $i<3; $i++) echo $empty_star;}
    else if ($rating > 2)  {for ($i=0; $i<1; $i++) echo $full_star; echo $half_star; for ($i=0; $i<3; $i++) echo $empty_star;}
    else if ($rating > 1)  {for ($i=0; $i<1; $i++) echo $full_star; for ($i=0; $i<4; $i++) echo $empty_star;}
    else if ($rating > 0)  {echo $half_star; for ($i=0; $i<4; $i++) echo $empty_star;}
    else {for ($i=0; $i<5; $i++) echo $empty_star;}
  }
?>
