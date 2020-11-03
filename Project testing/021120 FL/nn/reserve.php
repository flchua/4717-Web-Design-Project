<?php
include "dbconnect.php";

if (empty($_POST['rsvName']) || empty ($_POST['rsvPhone'])
|| empty ($_POST['rsvEmail']) || empty ($_POST['rsvDate'])) {
		echo '<script language="javascript">';
		echo "alert('Invalid submission with empty form.');";
		echo "window.location.href = 'reservation.php';";
		echo '</script>';
		exit;
}
else {
	$rsvSalulation = $_POST['rsvSalulation'];
	$rsvName = $_POST['rsvName'];
	$rsvPhone = $_POST['rsvPhone'];
	$rsvEmail = $_POST['rsvEmail'];
	$rsvDate = $_POST['rsvDate'];
	$rsvTime = $_POST['rsvTime'];
	$rsvPax = $_POST['rsvPax'];
	$rsvComment = $_POST['rsvComment'];

	$sql = "INSERT INTO reserve (rsv_salulation, rsv_name, rsv_phone, rsv_email, rsv_date, rsv_time, rsv_pax, rsv_comment) 
	VALUES ('$rsvSalulation', '$rsvName', '$rsvPhone', '$rsvEmail', '$rsvDate', '$rsvTime', '$rsvPax', '$rsvComment')";
	$$result = $conn->query($sql);
	if (!$result) {
		echo '<script language="javascript">';
		echo "alert('Reservation failed. Please try again later.')";
		echo '</script>';	}
	else{
		//Send email
		$msg = "Thank you, $rsvName!\nYou have successfully reserved on:\n$rsvTime, $rsvDate \nWe look forward to seeing you soon! \n";
		mail("f35ee@localhost","Reservation sucessfully!",$msg);    

		echo '<script language="javascript">';
		echo 'alert("You have sucessfully made a reservation! A confirmation email has been sent to you.");';
		echo "window.location.href = 'home.html';";
		echo '</script>';
	}
}
?>