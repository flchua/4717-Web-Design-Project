<?php
  if (!isset($_GET['id'])) {
    echo "Movie not found";
    exit;
  }

  include "db_connect.php";

  $showtime_id = $_GET['id'];
  $alpha = array(NULL, 'A','B','C','D','E');

  // Get reserved seats
  $reserved = array();

  $sql =
    "SELECT
      reserved_seats.row_no,
      reserved_seats.seat_no
    FROM
      reserved_seats
      INNER JOIN bookings
      ON reserved_seats.booking_id = bookings.id
    WHERE
        bookings.showtime_id = {$showtime_id}";

  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {   
    while ($row = mysqli_fetch_assoc($result)) {
        $key = $alpha[$row['row_no']].$row['seat_no'];
        $reserved[$key] = true;
    }
  } else {
    consoleLog("No bookings :)");
  }

  $sql = "SELECT DATE_FORMAT(showtime, '%w') AS showtime FROM showtimes WHERE id = {$showtime_id}";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $isWeekend = ($row['showtime'] >= 6) ? "true" : "false";
  echo "<script> const isWeekend = ".$isWeekend."; </script>";
  // consoleLog($isWeekend);

  echo "<div id='screen'>SCREEN</div>";

  for ($i = 1; $i <= 5; $i++) {
    $row_alpha = $alpha[$i];
    echo "<div class='row-no'>{$row_alpha}</div>";
    for ($j = 1; $j <= 10; $j++) {
      $seating = $row_alpha.$j;
      $booked = array_key_exists($seating, $reserved);
      if ($booked) {
        echo "<div class='seat booked'>";
        echo $j;
        echo "</div>";
      } else {
        echo "<input type='checkbox' name='seats[]' id='{$seating}' value='{$seating}'>";
        echo "<label for='{$seating}' class='seat'>{$j}</label>";
      }
      if ($j === 5) echo "<div class='divider'></div>";
    }
    echo "<div class='row-no'>{$row_alpha}</div>";
    echo "<br />";
  }

  mysqli_close($conn);
?>