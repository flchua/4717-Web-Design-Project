<?php
include "dbconnect.php";

if (empty($_POST['cttName']) || empty ($_POST['cttEmail']) || empty ($_POST['cttComment'])) {
		echo '<script language="javascript">';
		echo "alert('Invalid submission with empty form.');";
		echo "window.location.href = 'contact.html';";
		echo '</script>';
		exit;
}
else {
	$cttSalulation = $_POST['cttSalulation'];
	$cttName = $_POST['cttName'];
	$cttEmail = $_POST['cttEmail'];
	$cttComment = $_POST['cttComment'];

	$query = "INSERT INTO contact (ctt_salulation, ctt_name, ctt_email, ctt_comment) 
	VALUES ('$cttSalulation', '$cttName', '$cttEmail', '$cttComment')";
	$result = mysqli_query($con, $query);
	if (!$result) {
		echo '<script language="javascript">';
		echo "alert('Contact failed. Please try again later.')";
		echo '</script>';	}
	else{
		//Send email
		$msg = "Thank you, $cttName!\nWe have received your inquiry:\n$cttComment \nWe will get back you soon! \n";
		mail("f31ee@localhost","We have received your inquiry!",$msg);    

		echo '<script language="javascript">';
		echo 'alert("You have sucessfully submitted an inquiry! A confirmation email has been sent to you.");';
		echo "window.location.href = 'home.html';";
		echo '</script>';
	}
}
?>