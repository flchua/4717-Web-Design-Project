<?php 
  // var_dump($_GET);
  if (!isset($_GET['movie_id']) || !isset($_GET['cinema_id'])) {
    // Missing parameters
    exit;
  }
  
	include "db_connect.php";

  $movie_id = $_GET['movie_id'];
  $cinema_id = $_GET['cinema_id'];
  $dates = array();

  $sql =
    "SELECT
      DISTINCT(DATE(showtime)) AS showdate,
      DATE_FORMAT(showtime, '%a %e %b') AS showday
    FROM showtimes
    WHERE
      movie_id={$movie_id} AND
      cinema_id={$cinema_id} AND
      DATE(showtime) >= CURDATE()
    ORDER BY showdate ASC";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      // echo $row['showdate']." - ".$row['showday']."<br>";
      $dates[$row['showdate']] = $row['showday'];
    }
    // echo $dates;
    echo json_encode($dates);
  } else {
    echo NULL;
  }

  mysqli_close($conn);
?>