<?php
  if (!isset($_GET['id'])) {
    echo "Movie not found";
    exit;
  }

  include "db_connect.php";

  $movie_id = $_GET['id'];

  $sql = 
    "SELECT
      showtimes.id,
      showtimes.cinema_id,
      cinemas.name AS cinema_name,
      showtimes.showtime
    FROM
      showtimes
      JOIN cinemas
      ON showtimes.cinema_id=cinemas.id
    WHERE
      movie_id={$movie_id} AND
      DATE(showtime) >= CURDATE()
    ORDER BY cinema_id, showtime";

  $result = mysqli_query($conn, $sql);
  
  if (mysqli_num_rows($result) > 0) {
    echo "<div class='order-section'>";
    echo "  <h1 class='center'>";
    echo "    Showtimes";
    echo "  </h1>";
    echo "  <div class='width-wrap'>";
    echo "    <div class='showtimes'>";
    echo "    <div class='floatRight border-left'>";
    echo "      <div class='header'>Select a timeslot</div>";
    $currentDate = NULL;
    $currentCinema = NULL;
    $currentDate = NULL;

    while ($row = mysqli_fetch_assoc($result)) {
      $id = $row['id'];
      $cinema_id = $row['cinema_id'];
      $cinema_name = $row['cinema_name'];
      
      $showObj = date_create($row['showtime']);
      $showdate = date_format($showObj, "l, j M");
      $showtime = date_format($showObj, "g:ia");
      
      if ($currentCinema != $cinema_name) {
        if ($currentCinema !== NULL) {
          echo "</div>";
        }
        echo "<div id='{$cinema_name}' class='padding cinema-group'>";
        echo "<h2>".$cinema_name."</h2>";
        $currentCinema = $cinema_name;
        $currentDate = NULL;
      }

      if ($currentDate != $showdate) {
        echo "<h3>".$showdate."</h3>";
        $currentDate = $showdate;
      }

      echo "<a class='timeslot' href='booking.php?id=$id'>";
      echo    $showtime;
      echo "</a>";
      $cinemas[] = $cinema_name;
    }
    echo "  </div>";
    echo "  </div>";

    echo "  <div class='cinemas floatLeft'>";
    echo "    <div class='header'>Select a cinema</div>";
    echo "    <div class='padding'>";
    foreach(array_unique($cinemas) as $cinema) {
      echo "  <span class='cinema-name'>$cinema</span><br/>";
    }
    echo "    </div>";
    echo "  </div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
  } else {
    // There are no available showtimes for this movie
  }

  mysqli_close($conn);
?>

<script>
  $(document).ready(function() {
    $('.cinema-name').click(function() {
      $('.cinema-name').removeClass('selected');
      $(this).toggleClass('selected');
      let name = $(this).text();
      console.log(name);
      $('.cinema-group').hide();
      $('[id="' + name + '"]').show();
    });
    $('.cinema-name').first().click();
  })
</script>