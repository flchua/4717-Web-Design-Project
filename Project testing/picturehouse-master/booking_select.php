<?php 
  if (!isset($_GET['id'])) {
    echo "Showtime not found";
    exit;
  }

  $showtime_id = $_GET['id'];
  // echo $showtime_id;

  include "db_connect.php";
  
  $sql =
    "SELECT
      movies.id AS movie_id,
      movies.title,
      movies.poster,
      showtimes.cinema_id,
      DATE(showtimes.showtime) AS date,
      TIME_FORMAT(showtime, '%l:%i%p') AS time
    FROM movies
    INNER JOIN
      showtimes ON showtimes.movie_id = movies.id
    WHERE showtimes.id = {$showtime_id}";
  // echo $sql;
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) === 0) {
    echo "Movie not found";
    exit;
  }
  
  $row = mysqli_fetch_assoc($result);
  $movie_id = $row['movie_id'];
  $title = $row['title'];
  $poster = $row['poster'];  
  $current_cinema_id = $row['cinema_id'];
  $current_date = $row['date'];
  $current_showtime = $row['time'];

  echo "<script> let movie_id = {$movie_id}; </script>";
  echo "<div class='poster-bg'>";
  echo "  <div class='width-wrap'>";
  echo "    <h1 class='title'>{$title}</h1>";
  echo "    <div id='dropdowns'>";

  // CINEMA SELECT
  echo "      <select id='cinema-select'>";
  echo "        <option value='0' hidden>Cinema</option>";
  $sql = "SELECT id, name FROM cinemas";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      $cinema_id = $row['id'];
      $cinema_name = $row['name'];
      $isCurrent = $current_cinema_id == $cinema_id;
      echo "<option value='$cinema_id'";
      echo $isCurrent ? 'selected' : '';
      echo ">{$cinema_name}</option>";
    }
  }
  echo "      </select>";

  // DATE SELECT
  echo "      <select id='date-select'>";
  echo "        <option value='0' hidden>Date</option>";
  $sql =
    "SELECT
      DISTINCT(DATE(showtime)) AS showdate,
      DATE_FORMAT(showtime, '%a %e %b') AS showday
    FROM showtimes
    WHERE movie_id={$movie_id} AND cinema_id={$current_cinema_id}";
  echo $sql;
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      $showdate = $row['showdate'];
      $showday = $row['showday'];
      $isCurrent = $current_date == $showdate;
      echo "  <option value='$showdate'";
      echo $isCurrent ? 'selected' : '';
      echo ">$showday</option>";
    }
  }
  echo "      </select>";

  // SHOWTIME SELECT
  echo "      <select id='showtime-select'>";
  echo "        <option value='0' hidden>Showtime</option>";
  $sql =
    "SELECT
      id, TIME_FORMAT(showtime, '%l:%i%p') AS time
    FROM showtimes
    WHERE
      movie_id={$movie_id} AND
      cinema_id={$current_cinema_id} AND
      DATE(showtime) = '{$current_date}'
    ORDER BY showtime";
  echo $sql;
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      $id = $row['id'];
      $showtime = $row['time'];
      $isCurrent = $current_showtime == $showtime;
      echo "  <option value='{$id}'";
      echo $isCurrent ? 'selected' : '';
      echo ">$showtime</option>";
    }
  }
  echo "      </select>";
  echo "    </div>";
  echo "  </div>";
  echo "</div>";
  
  mysqli_close($conn);
?>

<script>
  $(document).ready(function() {
    $('#cinema-select').change(function() {
      console.log('Cinema selected');
      // Disable showtime selection
      $('#showtime-select').children('option:not(:first)').remove();
      $('#showtime-select').prop('disabled', true);
      $('#submit').prop('disabled', true);
      
      let cinema_id = $('#cinema-select').val();
      let date = $('#date-select').val();
      getDates(movie_id, cinema_id);
    });

    function setDates(dates) {
      console.log({ dates: JSON.parse(dates) });
      $('#date-select').children('option:not(:first)').remove();
      $.each(JSON.parse(dates), function(key, date) {
        $('#date-select').append(
          $("<option></option>")
            .attr("value", key)
            .text(date)
        );
      });
      $('#date-select').prop('disabled', false);
    }

    function getDates(movie_id, cinema_id) {
      console.log({ getDates: { movie_id, cinema_id } });
      $.ajax({
          url: 'index_getDates.php',
          type: 'GET',
          data: {
              movie_id: movie_id,
              cinema_id: cinema_id
          },
          success: setDates
      });
    };

    function setShowtimes(showtimes) {
      // console.log(JSON.parse(showtimes));
      $('#showtime-select').children('option:not(:first)').remove();
      $.each(JSON.parse(showtimes), function(key, showtime) {
        $('#showtime-select').append(
          $("<option></option>")
            .attr("value", showtime.id)
            .text(showtime.time)
        );
      });
      $('#showtime-select').prop('disabled', false);
    }

    function getShowtimes(movie_id, cinema_id, date) {
      console.log({ getShowtimes: { movie_id, cinema_id, date } });
      $.ajax({
          url: 'index_getShowtimes.php',
          type: 'GET',
          data: {
              movie_id: movie_id,
              cinema_id: cinema_id,
              date: date
          },
          success: setShowtimes
      });
    };

    $('#date-select').change(function() {
      console.log('Date selected');
      let cinema_id = $('#cinema-select').val();
      let date = $('#date-select').val();
      getShowtimes(movie_id, cinema_id, date);
    });

    function setShowtimes(showtimes) {
      $('#showtime-select').children('option:not(:first)').remove();
      console.log({ showtimes: JSON.parse(showtimes) });
      $.each(JSON.parse(showtimes), function(key, showtime) {
        $('#showtime-select').append(
          $("<option></option>")
            .attr("value", showtime.id)
            .text(showtime.time)
        );
      });
      $('#showtime-select').prop('disabled', false);
    }
    
    $('#showtime-select').change(function() {
      let new_showtime_id = $(this).val();
      if (new_showtime_id === 0) {
        alert('Please select a valid showtime');
      } else {
        location.href = "booking.php?id=" + new_showtime_id;
      }
    });
  });
</script>