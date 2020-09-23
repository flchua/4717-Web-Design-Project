<?php 
	if (empty($_POST)) {
		echo "Error occured - Empty POST";
	} else {
		include "db_connect.php";

		// var_dump($_POST);
		if (isset($_SESSION['user_email'])) {
			$email = $_SESSION['user_email'];
		} else {
			$email = $_POST["email"];
		}

		$showtime_id = $_POST["showtime_id"];
		$total_price = $_POST["total_price"];

		$success = true;

		// INSERT BOOKING INTO DATABASE
		$sql = "INSERT INTO bookings (email, showtime_id, total_price) VALUES ('$email', $showtime_id, $total_price)";
		consoleLog($sql);

		if (mysqli_query($conn, $sql)) {
			$booking_id = mysqli_insert_id($conn);
			consoleLog("Booking #$booking_id confirmed");
			foreach ($_POST['seats'] as $seat) {
				$row_no = ord(strtolower(substr($seat, 0, 1))) - 96;
				$seat_no = substr($seat, 1);
				$sql = "INSERT INTO reserved_seats (booking_id, row_no, seat_no) VALUES ($booking_id, '$row_no', $seat_no)";
				consoleLog($sql);
				if (mysqli_query($conn, $sql)) {
					consoleLog($seat." reserved");
				} else {
					$success = false;
					consoleLog("Error occurred: ".mysqli_error($conn));
				}
			}
		} else {
			$success = false;
			consoleLog("Error occurred: ".mysqli_error($conn));
		}

		// DISPLAY BOOKING DETAILS
		$sql = "SELECT
				movies.title,
				DATE_FORMAT(showtimes.showtime, '%W, %e %b %y') AS showdate,
				DATE_FORMAT(showtimes.showtime, '%l:%i%p') AS showtime,
				cinemas.name
			FROM
				showtimes
				JOIN movies ON showtimes.movie_id = movies.id
				JOIN cinemas ON showtimes.cinema_id = cinemas.id
			WHERE showtimes.id =".$showtime_id;
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		
		if ($success) {
			$title = $row['title'];
			$showdate = $row['showdate'];
			$showtime = $row['showtime'];
			$cinema_name = $row['name'];
			$seats = implode(", ", $_POST['seats']);

			echo "<h1>BOOKING CONFIRMED</h1>";
			echo "The booking details have been sent to your email address.";
			echo "	<div class='ticket'>";
			echo "	<div class='title'>";
			echo 			$title;
			echo "	</div>";
			echo "	<div class='details'>";
			echo 			$showdate;
			echo "		<br/>";
			echo 			$showtime;
			echo "		<br/>";
			echo 			$cinema_name;
			echo "		<br/>";
			echo "		Seats: ".$seats;
			echo "	</div>";
			echo "	<div class='paid'>";
			echo "		Amount paid: $".$total_price;
			echo "	</div>";
			echo "</div>";
			
			include "email_booking.php"; // Sends email
		} else {
			echo "<h1>Booking failed</h1>";
			echo "Please try again.";
		}

		mysqli_close($conn);
	}
?>