<?php
  include "db_connect.php";

  $sql = "SELECT * FROM movies ORDER BY releaseDate ASC";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      $id = $row['id'];
      $name = $row['title'];
      $genre = $row['genre'];
      $language = $row['language'];
      $stars = $row['stars'];
      $rating = $row['rating'];
      $runtime = $row['runtime'];
      $poster = $row['poster'];
      
      echo "<a href='movie.php?id=".$id."' class='movieCell' style='background-image: url(posters/".$poster.")'>";
      echo "  <div class='details'>";
      echo "    <div class='title'>".$name."</div>";
      if ($rating && $language && $runtime) {
        echo    $rating."<br/>";
        echo    $language." | ";
        echo    $runtime."mins";
        echo "  <img src='stars/{$stars}.png' />";
        echo "  <div class='book'>Book tickets</div>";
      } else {
        echo "  Coming soon<br/><br/>";
        echo "  <div class='book'>Find out more</div>";
      }
      echo "  </div>";
      echo "</a>";

    }
  } else {
    echo "No movies :(";
  }

  mysqli_close($conn);
?>