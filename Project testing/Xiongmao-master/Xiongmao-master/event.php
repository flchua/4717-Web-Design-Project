<?php
session_start();
//check account status: logged-in or not
if (!isset($_SESSION['user_id'])){
    echo '<script language="javascript">';
    echo "alert('Members only! Please log in to access the page.');";
    echo "window.location.href = 'registration/register.php';";
    echo '</script>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Xiong Mao - Event</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/xiongmao.css">
<link rel="stylesheet" href="css/event.css">
<script src="js/event.js"></script>
</head>
<body>
<div id="title-left">
	<a href="home.html"><img src="assets/logo.png" id="logo" width="204" height="103"></a>
</div>
<div id="title-right">
	<header>
		<h1>Xiong Mao</h1>
	</header>
	<nav>
		<a href="home.html">Home</a>
		<a href="menu.html">Menu</a>
		<a href="reservation.html">Reservation</a>
		<a href="delivery.php">Delivery</a>
		<a href="event.php">Event</a>
		<a href="contact.html">Contact</a>
		<a href="registration/register.php">Account</a>
	</nav>
</div>
<div id="booking">
	<div id="header">
		<img src="assets/headerEvent.png" width="1400" height="300">
	</div>
	<form method="post" action="payment/payment.php" onsubmit="return checkInput();">
	<div id="event">
		<table id="info">
			<col width="30%">
			<col width="70%">
			<tr>
				<td><img src="assets/event1.jpg" width="320" height="210"></td>
				<td>
					<h4>Mid-autumn Mooncake Festival</h4>
					<label>Quantity: </label><input type="number" id="event0" name="event_qty0" class="qty" value="0" min="0" step="1" onchange="addEvent();">
					<p>Time: 24 Sep 19:00-21:00<br>
						Venue: Level 3, Eastern Secret Garden<br>
						Price: S$20 per person<br><br>
						The round shape of mooncake means union in Chinese culture.
						We offer you a night of story-telling, celebration and jubilation with eponymous mooncakes.
						Enjoy a cup of tea, sit back and relax as we exchange our ancient stories and legends under the soft moonlight.
					</p><br>
				</td>
			</tr>
			<tr>
				<td><img src="assets/event2.jpeg" width="320" height="210"></td>
				<td>
					<h4>Stories in A Tea Cup</h4>
					<label>Quantity: </label><input type="number" id="event1" name="event_qty1" class="qty" value="0" min="0" step="1" onchange="addEvent();">
					<p>Time: 1 Oct 19:00-21:00<br>
						Venue: Level 2, Aroma Balcony<br>
						Price: S$30 per person<br><br>
						China is well-known and respected for its long-standing history of tea production. 
						This heritage gives rise to some of the finest taste in the world, and includes the secrets of traditional culture. 
						Explore the Chinese tea culture here as you learn about fascinating types of tea such as Mao Feng, Pu Erh and Long Jing.
					</p><br>
				</td>
			</tr>
		</table>
	</div>
	<div id="cart">	
		<div id="summary">
			<h3>Booking Summary</h3>
			<table>
				<col width="40%">
				<col width="20%">
				<col width="20%">
				<tr>
					<th>Event</th>
					<th>Price</th>
					<th>Quantity</th>
				</tr>
				<tr id="sect0">
					<td><span id="item0"></span></td>
					<td><span id="price0"></span></td>
					<td><span id="qty0" ></span></td>
				</tr>
				<tr id="sect1">
					<td><span id="item1"></span></td>
					<td><span id="price1"></span></td>
					<td><span id="qty1" ></span></td>
				</tr>
			</table>
		</div>
		<div id="total">
			<p><strong>Total: S$ <input type="text" id="amount" value=0 onfocus="this.blur();"></strong></p>
			<input type="submit" id="eventCheckout" value="Check Out" style="width: 80px;">
		</div>
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