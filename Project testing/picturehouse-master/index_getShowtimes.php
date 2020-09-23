<?php 
  // var_dump($_GET);
  if (!isset($_GET['movie_id']) || !isset($_GET['cinema_id']) || !isset($_GET['date'])) {
    // Missing parameters
    exit;
  }
  
  include "db_connect.php";

  $movie_id = $_GET['movie_id'];
  $cinema_id = $_GET['cinema_id'];
  $date = $_GET['date'];
  // echo $movie_id.", ".$cinema_id.", ".$date;
  $showtimes = array();

  $sql =
    "SELECT
      id, TIME_FORMAT(showtime, '%l:%i%p') AS time
    FROM showtimes
    WHERE
      movie_id={$movie_id} AND
      cinema_id={$cinema_id} AND
      DATE(showtime) = '{$date}'
    ORDER BY showtime";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      // echo $row['id']." - ".$row['time']."<br>";
      $showtimes[] = array('id' => $row['id'], 'time' => $row['time']);
    }
    // echo $showtimes; 
    echo json_encode($showtimes);
  } else {
    echo NULL;
  }

  mysqli_close($conn);
?>