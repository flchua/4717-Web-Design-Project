<?php
  include "db_connect.php";

  if (!isset($_GET['id'])) {
    echo "Movie not found";
    exit;
  }

  $sql = "SELECT *, DATE_FORMAT(releaseDate, '%e %M %Y') AS releaseDate FROM movies WHERE id=".$_GET['id'];
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    $id = $row['id'];
    $title = $row['title'];
    $releaseDate = $row['releaseDate'];
    $cast = $row['cast'];
    $director = $row['director'];
    $description = $row['description'];
    $genre = $row['genre'];
    $language = $row['language'];
    $stars = $row['stars'];
    $rating = $row['rating'] ? $row['rating'] : 'TBD';
    $runtime = $row['runtime'];
    $poster = $row['poster'];
    $trailer = $row['trailer'];
    
    echo "<script> document.title = '$title'; </script>"; // Set title of page

    echo "<div id='poster-bg' style='background-image: url(posters/".$poster.")'></div>";
    echo "<div class='movie-section'>";
    echo "  <div class='width-wrap'>";
    echo "    <div class='floatLeft center'>";
    echo "      <img id='poster' src='posters/".$poster."'>";
    if ($trailer) echo "<span id='watch'>Watch trailer</span>";
    echo "    </div>";
    echo "    <div class='details floatRight'>";
    echo "      <h1>".$title."</h1>";
    echo "      <table>";
    echo "        <tr>";
    echo "          <td>";
    echo "            <div class='label'>language</div>";
    echo              $language;
    echo "          </td>";
    echo "          <td>";
    echo "            <div class='label'>rating</div>";
    echo              $rating;
    echo "          </td>";
    echo "          <td>";
    echo "            <div class='label'>length</div>";
    if ($runtime)
      echo            $runtime."mins";
    else 
      echo "          -";
    echo "          </td>";
    echo "        </tr>";
    echo "        <tr>";
    echo "          <td>";
    echo "            <div class='label'>director</div>";
    echo              $director;
    echo "          </td>";
    echo "          <td>";
    echo "            <div class='label'>release</div>";
    echo              $releaseDate;
    echo "          </td>";
    echo "          <td>";
    echo "            <div class='label'>IMDb score</div>";
    if ($stars)
      echo "          <img src='stars/{$stars}.png' />";
    else 
      echo "          -";
    echo "          </td>";
    echo "        </tr>";
    echo "      </table>";
    echo "      <div class='label'>cast</div>";
    echo        $cast;
    echo "      <div class='label'>synopsis</div>";
    echo        $description."<br />";
    echo "    </div>";
    echo "  </div>";
    echo "</div>";

    echo "<script> let videoId = '$trailer'; </script>";

  } else {
    echo "Opps. Movie not found";
  }

  mysqli_close($conn);
?>

<div id='trailer'>
  <div id='player'></div>
  <div class='x'></div>
</div>

<script>
let tag = document.createElement('script');
tag.src = "http://www.youtube.com/player_api";
let firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

let player;

function onYouTubePlayerAPIReady() {
  if (videoId) {
    player = new YT.Player('player', {
      width: '1000',
      height: '562',
      videoId: videoId,
    });
    $('.x').click(function() {
      $('#trailer').fadeOut(200);
      player.pauseVideo();
    });
    
    $('#watch').click(function() {
      $('#trailer').fadeIn(200);
      player.playVideo();
    });
  }
}
</script>