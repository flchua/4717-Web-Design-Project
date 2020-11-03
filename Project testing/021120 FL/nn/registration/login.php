<?php
include "../dbconnect.php";
session_start();

//Check if the user has already logged in
if (isset($_SESSION['user_id'])){
	$email = $_SESSION['user_email'];
	echo '<script language="javascript">';
	echo "alert('You are aleady logged in as $email')";
	echo "window.location.href = 'register.php';";
	echo '</script>';
}
else{
	//If the user has just tried to log in
	$email = $_POST['user_email'];
	$password = $_POST['user_password'];

	$password = md5($password);
	$sql1 = "select * from users where user_email='$email' and user_password='$password'";
	//echo "select * from users where user_email='$email' and user_password='$password'";
	$result = $conn->query($sql1);

  // output data of each row


	
	//Convert query result as associative array
	
	if ($result-> num_rows > 0) {
		while($row = $result->fetch_assoc()){ 
		//echo $row['user_firstName'];
		$_SESSION['user_id'] = session_id();
		$_SESSION['user_email'] = $row['user_email'];
		$_SESSION['user_firstName'] = $row['user_firstName'];
		$user_firstName = $row['user_firstName'];
		//echo $_SESSION['user_id'];
		} 
		//$con->close();

		//Assign session_id to session as user_id
		
		echo '<script language="javascript">';
		echo "alert('Welcome $user_firstName!');";
		echo "window.location.href = 'register.php';";
		echo '</script>';
	}
	else{
		echo '<script language="javascript">';
		echo "alert('Login failed. Please check your email address and password and try again.');";
		echo "window.location.href = 'register.php';";
		echo '</script>';
	}
}
?>