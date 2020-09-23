<?php
session_start();

if (isset($_POST['event_qty0'])){
    $qty0 = $_POST['event_qty0'];
    $qty1 = $_POST['event_qty1'];
    $user_email = $_SESSION['user_email'];

    $total = 20 * $qty0 + 30 * $qty1;
    $_SESSION['trans_dollars'] = $total;
    if ($qty0 == 0){
        //Only second event is booked
        $show_table = " <h2>Event Booking Summary for $user_email</h2>
                        <table>
                            <tr>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                            </tr>

                            <tr>
                                <td>Stories in A Tea Cup</th>
                                <td>$qty1</td>
                                <td>S$30</td>
                            </tr>

                            <tr>
                                <td>Total</td>
                                <td> </td>
                                <td>S$$total</td>
                            </tr>
                        </table>";
        $_SESSION['events_booked'] = array(
            'event1' => $qty1,
        );
		$_SESSION['events_booked_email'] = array(
			'Stories in A Tea Cup' => $qty1,
		);   
    }
    else if ($qty1 == 0){
        //Only first event is booked
        $show_table = " <h2>Event Booking Summary for $user_email</h2>
                        <table>
                            <tr>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                            </tr>

                            <tr>
                                <td>Mid-autumn Mooncake Festival</th>
                                <td>$qty0</td>
                                <td>S$20</td>
                            </tr>

                            <tr>
                                <td>Total</td>
                                <td> </td>
                                <td>S$$total</td>
                            </tr>
                        </table>";
        $_SESSION['events_booked'] = array(
            'event0' => $qty0,
		); 
		$_SESSION['events_booked_email'] = array(
			'Mid-autumn Mooncake Festival' => $qty0,
		);    
    }
    else {
        //Both events are booked
        $show_table = " <h2>Event Booking Summary for $user_email</h2>
                        <table>
                            <tr>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                            </tr>

                            <tr>
                                <td>Mid-autumn Mooncake Festival</th>
                                <td>$qty0</td>
                                <td>S$20</td>
                            </tr>
                            <tr>
                                <td>Stories in A Tea Cup</th>
                                <td>$qty1</td>
                                <td>S$30</td>
                            </tr>
                            <tr>
                                <td></td><td></td><td></td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td> </td>
                                <td>S$$total</td>
                            </tr>
                        </table>";
        $_SESSION['events_booked'] = array(
            'event0' => $qty0,
            'event1' => $qty1,
		);
		$_SESSION['events_booked_email'] = array(
			'Mid-autumn Mooncake Festival' => $qty0,
			'Stories in A Tea Cup' => $qty1,
		);          
    }

}
else if (isset($_POST['delivery0'])){
	//Payment for delivery
	include "../dbconnect.php";
	$user_email = $_SESSION['user_email'];
	$query = array("", "", "", "", "", "", "", "", "", "");
	$price = array("", "", "", "", "", "", "", "", "", "");
	$product_name = array("", "", "", "", "", "", "", "", "", "");
	for ($i = 0; $i < 10; $i++){
		$query[$i] = "select * from menu where product_id = ".$i;
		$result = $con -> query($query[$i]) -> fetch_assoc();
		$price[$i] = $result['product_price'];
		$product_name[$i] = $result['product_name'];
	}
	

	$qty0 = $_POST['delivery0'];
    $qty1 = $_POST['delivery1'];
	$qty2 = $_POST['delivery2'];
	$qty3 = $_POST['delivery3'];
	$qty4 = $_POST['delivery4'];
	$qty5 = $_POST['delivery5'];
	$qty6 = $_POST['delivery6'];
	$qty7 = $_POST['delivery7'];
	$qty8 = $_POST['delivery8'];
	$qty9 = $_POST['delivery9'];
	
	$qtys = array($qty0, $qty1, $qty2, $qty3, $qty4, $qty5, $qty6, $qty7, $qty8, $qty9);

	$show_table = " <h2>Delivery Ordering Summary for $user_email</h2>
					<table>
					<tr>
						<th>Food</th>
						<th>Quantity</th>
						<th>Price</th>
					</tr>";
	$total = 0;

	//Store orders as JSON format in database
	$order_arr = array();

	//For sending email
	$order_arr_email = array();
	for ($i = 0; $i < 10; $i++){
		if($qtys[$i]>0){
			$name_i = $product_name[$i];
			$qty_i = $qtys[$i];
			$price_i = $price[$i] * $qty_i;

			$order_arr['food'.$i] = $qty_i;
			$order_arr_email[$name_i] = $qty_i;

			$total += $price_i;
			$show_table = $show_table." <tr>
										<td>$name_i</td>
										<td>$qty_i</td>
										<td>S$$price_i</td>
										</tr>";
		}
	}
	//Store orders in session
	$_SESSION['food_ordered'] = $order_arr;
	$_SESSION['trans_dollars'] = $total;
	$_SESSION['food_ordered_email'] = $order_arr_email;

	$show_table = $show_table." <tr><td></td><td></td><td></td></tr>
								<tr>
								<th>Total</th>
								<th> </th>
								<th>S$$total</th>
								</tr>
								</table>";

}
else {
	echo '<script language="javascript">';
	echo 'alert("You are not allowed to access this page unless you place an order!");';
	echo "window.location.href = '../home.html';";
	echo '</script>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Xiong Mao - Payment</title>
<meta charset="utf-8">
<link rel="stylesheet" href="../css/xiongmao.css">
<style>
#header {
		text-align: center;
        vertical-align: middle;
}
#wrapper {
	padding-top: 30px;
	text-align: center;
	display: inline-block;
	height: auto;
}
#column-left { 
	width: 400px;
	min-height: 320px;
	text-align: center;
	display: inline-block;
	vertical-align: top;
}
#column-right {
	width: 400px;
	text-align: center;
	vertical-align: top;
	display: inline-block;
}
#column-center {
	display: inline-block; 
	width: 400px;
	text-align: center;
	vertical-align: top;
}
.button {
	float: left;
}
table {
	width: 80%; 
	margin: auto;
	text-align: center;
}
td, th {
	padding:10px;
}
label {
	float: left;
	display: block;
	text-align: right;
	width: 40%;
	padding-right: 10px;
}			
input {
	display: block;
	margin-bottom: 20px;
}
#pay {
	width: 10%; 
	margin: auto;
}
</style>
<script>
	function checkInput(){ //Form validation
        //Check name
		var name = document.getElementById("payName");
		var nameRegExp = /^[A-Za-z]+\s?[A-Za-z]*$/;
		var nameValid = nameRegExp.test(name.value);
		if (nameValid != true) {
			alert("The name is not valid.\n" + "It should contain only alphabet characters and space.");
			name.focus();
			name.select();
			return false;
		}

        //Check phone
		var phone = document.getElementById("payPhone");
		var phoneRegExp = /^\d+$/;
		var phoneValid = phoneRegExp.test(phone.value);
		if (phoneValid != true) {
			alert("The phone number is not valid.\n" + "It should contain only digits.");
			phone.focus();
			phone.select();
			return false;
		}

        //Check postcode
		var postcode = document.getElementById("payPostcode");
		var postRegExp = /^\d+$/;
		var postValid = postRegExp.test(postcode.value);
		if (postValid != true) {
			alert("The postcode is not valid.\n" + "It should contain only digits.");
			postcode.focus();
			postcode.select();
			return false;
		}
	}
	</script>
</head>
<body>
<div id="title-left">
	<a href="../home.html"><img src="../assets/logo.png" id="logo" width="204" height="103"></a></div>
<div id="title-right">
	<header>
		<h1>Xiong Mao</h1>
	</header>
	<nav>
		<a href="../home.html">Home</a>
		<a href="../menu.html">Menu</a>
		<a href="../reservation.html">Reservation</a>
		<a href="../delivery.php">Delivery</a>
		<a href="../event.php">Event</a>
		<a href="../contact.html">Contact</a>
		<a href="../registration/register.php">Account</a>
	</nav>
</div>
<div id="header">
  <img src="../assets/headerPayment.png" width="1400" height="300">
</div>
<div id="wrapper">
	<div id="column-left">
        <?php echo $show_table; ?>
	</div>
	<div id="column-center">
        <h2>Delivery Address</h2>
		<form method="post"  action="make_payment.php" onsubmit="return checkInput();">
			<label for="name">* Name:</label> 
			<input type="text" name="delivery_name" id="payName" required>
			<label for="phone">* Phone:</label>
			<input type="text" name="delivery_phone" id="payPhone" required>
			<label for="email">* Email:</label>
			<input type="email" name="delivery_email" id="payEmail" required>
			<label for="address">* Address:</label>
			<input type="text" name="delivery_address" id="payAddress" required>
			<label for="postcode">* Postcode:</label>
			<input type="text" name="delivery_postcode" id="payPostcode" required>
	</div>	
	<div id="column-right">
		<h2>Payment</h2>
		<p>Please choose your payment method: </p>
		<table>
			<tr>
				<td><input type="radio" class="button" name="button" checked> VISA</td>
				<td><input type="radio" class="button" name="button" > eNETS</td>
			</tr>
			<tr>
				<td><input type="radio" class="button" name="button" >MasterCard</td>
				<td><input type="radio" class="button" name="button" > PayPal</td>
			</tr>
			<tr>
				<td><input type="radio" class="button" name="button" >Union Pay</td>
				<td><input type="radio" class="button" name="button" > Alipay</td>
			</tr>	
		</table>
		<input type="submit" id="pay" value="Pay"> 
		</form>
	</div>		
</div>
<footer>
	<small>Nanyang Technological University, #01-01 Nanyang Center, 50 Nanyang Walk, Singapore 639929<br>
		Tel: 8888 6666 | Email: <a href="mailto:xiongmao@xiongmao.com">xiongmao@xiongmao.com</a><br>
		<i>Copyright &copy; 2018 Xiong Mao, Inc.<br></i></small>
</footer>
</body>
</html>
