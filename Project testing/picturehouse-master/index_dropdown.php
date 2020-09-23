<?php
  include "db_connect.php";
  
  echo "<div id='dropdowns'>";
  echo "  <select id='movie-select' required>";
  echo "    <option value='0' hidden>Select movie</option>";
  
  $sql = "SELECT id, title FROM movies WHERE releaseDate <= CURRENT_DATE";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      $id = $row['id'];
      $name = $row['title'];
      echo "  <option value='$id'>$name</option>";
    }
  }

  echo "  </select>";
  echo "  <select id='cinema-select'>";
  echo "    <option value='0' hidden>Select Cinema</option>";
  
  $sql = "SELECT id, name FROM cinemas";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      $id = $row['id'];
      $name = $row['name'];
      echo "<option value='$id'>$name</option>";
    }
  }

  echo "  </select>";
  echo "  <select id='date-select' disabled>";
  echo "    <option value='0' hidden>Date</option>";
  echo "  </select>";
  echo "  <select id='showtime-select' disabled>";
  echo "    <option value='0' hidden>Showtime</option>";
  echo "  </select>";
  echo "  <button id='submit' disabled>BOOK NOW</button>";
  echo "</div>";
  
  mysqli_close($conn);
?>

<script>
  $(document).ready(function() {
    $('#movie-select, #cinema-select').change(function() {
      // Disable showtime selection
      $('#showtime-select').children('option:not(:first)').remove();
      $('#showtime-select').prop('disabled', true);
      $('#submit').prop('disabled', true);

      let movie_id = $('#movie-select').val();
      let cinema_id = $('#cinema-select').val();
      if (movie_id != 0 && cinema_id != 0) { 
        getDates(movie_id, cinema_id);
      } else {
        // Disable date selection
        $('#date-select').children('option:not(:first)').remove();
        $('#date-select').prop('disabled', true);
      }
    });

    function setDates(dates) {
      console.log(JSON.parse(dates));
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
      console.log('getDates');
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
      console.log(JSON.parse(showtimes));
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
      console.log('getShowtimes');
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
      console.log('Date select');
      let movie_id = $('#movie-select').val();
      let cinema_id = $('#cinema-select').val();
      let date = $('#date-select').val();
      getShowtimes(movie_id, cinema_id, date);
    });

    
    $('#showtime-select').change(function() {
      $('#submit').prop('disabled', false);
    });

    $('#submit').click(function() {
      let showtime_id = $('#showtime-select').val();
      if (showtime_id === 0) {
        alert('Please select a valid showtime');
      } else {
        location.href = "booking.php?id=" + showtime_id;
      }
    });

  });
</script>