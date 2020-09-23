<?php
session_start();

//Check account status: logged-in or not
if (!isset($_SESSION['user_id'])){
    echo '<script language="javascript">';
    echo "alert('Members only! Please log in to access the page.');";
    echo "window.location.href = 'registration/register.php';";
    echo '</script>';
} 

include "dbconnect.php";
$query = array("", "", "", "", "", "", "", "", "", "");
$price = array("", "", "", "", "", "", "", "", "", "");
for ($i = 0; $i < 10; $i++){
	$query[$i] = "select product_price from menu where product_id = ".$i;
	//Dynamically retrieve price from database
	$result = $con -> query($query[$i]) -> fetch_assoc();
	$price[$i] = $result['product_price'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Xiong Mao - Delivery</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/xiongmao.css">
<link rel="stylesheet" href="css/delivery.css">
<script src="js/delivery.js"></script>
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
<div id="header">
	<img src="assets/headerDelivery.png" width="1400" height="300">
</div>
<form method="post" action="payment/payment.php" onsubmit="return checkInput();">
<div id="delivery">
	<div id="menu">
		<h3>Meat<input type="button" class="btn" id="btnMeat" value="-" onclick="foldMeat();"></h3>
		<table id="meat" class="product">
			<col width="20%">
			<col width="30%">
			<col width="20%">
			<col width="30%">
			<tr>
				<td><img src="assets/delivery1.jpg" width="180" height="120"></td>
				<td>
					<h4>Sliced Beef with Black Pepper Sauce</h4>
					<label>Quantity: </label><input type="number" id="delivery0" name="delivery0" class="qty" value="0" min="0" step="1" onchange="addProduct();">
					<p>Price: S$<?php echo number_format((float)$price[0], 2); ?></p><br>
				</td>
				<td><img src="assets/delivery2.jpg" width="180" height="120"></td>
				<td>
					<h4>Double Cooked Pork with Chinese Leek</h4>
					<label>Quantity: </label><input type="number" id="delivery1" name="delivery1" class="qty" value="0" min="0" step="1" onchange="addProduct();">
					<p>Price: S$<?php echo number_format((float)$price[1], 2); ?></p><br>
				</td>
			</tr>
			<tr>
				<td><img src="assets/delivery3.jpeg" width="180" height="120"></td>
				<td>
					<h4>Spicy Chicken</h4>
					<label>Quantity: </label><input type="number" id="delivery2" name="delivery2" class="qty" value="0" min="0" step="1" onchange="addProduct();">
					<p>Price: S$<?php echo number_format((float)$price[2], 2); ?></p><br>
				</td>
				<td><img src="assets/delivery4.jpg" width="180" height="120"></td>
				<td>
					<h4>Fish Filets in Hot Chili Oil</h4>
					<label>Quantity: </label><input type="number" id="delivery3" name="delivery3" class="qty" value="0" min="0" step="1" onchange="addProduct();">
					<p>Price: S$<?php echo number_format((float)$price[3], 2); ?></p><br>
				</td>
			</tr>
		</table>
		<h3>Vegetables<input type="button" class="btn" id="btnVege" value="-" onclick="foldVege();"></h3>
		<table id="vege" class="product">
			<col width="20%">
			<col width="30%">
			<col width="20%">
			<col width="30%">
			<tr>
				<td><img src="assets/delivery5.jpg" width="180" height="120"></td>
				<td>
					<h4>Egg Plant with Minced Chicken and Sichuan Chilli Sauce</h4>
					<label>Quantity: </label><input type="number" id="delivery4" name="delivery4" class="qty" value="0" min="0" step="1" onchange="addProduct();">
					<p>Price: S$<?php echo number_format((float)$price[4], 2); ?></p><br>
				</td>
				<td><img src="assets/delivery6.jpeg" width="180" height="120"></td>
				<td>
					<h4>Lettuce in Oyster Sauce</h4>
					<label>Quantity: </label><input type="number" id="delivery5" name="delivery5" class="qty" value="0" min="0" step="1" onchange="addProduct();">
					<p>Price: S$<?php echo number_format((float)$price[5], 2); ?></p><br>
				</td>
			</tr>
		</table>
		<h3>Drinks<input type="button" class="btn" id="btnDrink" value="-" onclick="foldDrink();"></h3>
		<table id="drink" class="product">
			<col width="20%">
			<col width="30%">
			<col width="20%">
			<col width="30%">
			<tr>
				<td><img src="assets/delivery7.png" width="180" height="120"></td>
				<td>
					<h4>Bai Mu Dan White Peony Tea</h4>
					<label>Quantity: </label><input type="number" id="delivery6" name="delivery6" class="qty" value="0" min="0" step="1" onchange="addProduct();">
					<p>Price: S$<?php echo number_format((float)$price[6], 2); ?></p><br>
				</td>
				<td><img src="assets/delivery8.png" width="180" height="120"></td>
				<td>
					<h4>Oolong Tea</h4>
					<label>Quantity: </label><input type="number" id="delivery7" name="delivery7" class="qty" value="0" min="0" step="1" onchange="addProduct();">
					<p>Price: S$<?php echo number_format((float)$price[7], 2); ?></p><br>
				</td>
			</tr>
			<tr>
				<td><img src="assets/delivery9.png" width="180" height="120"></td>
				<td>
					<h4>Sweet-sour Plum Juice</h4>
					<label>Quantity: </label><input type="number" id="delivery8" name="delivery8" class="qty" value="0" min="0" step="1" onchange="addProduct();">
					<p>Price: S$<?php echo number_format((float)$price[8], 2); ?></p><br>
				</td>
				<td><img src="assets/delivery10.png" width="180" height="120"></td>
				<td>
					<h4>Traditional Chinese Liquor</h4>
					<label>Quantity: </label><input type="number" id="delivery9" name="delivery9" class="qty" value="0" min="0" step="1" onchange="addProduct();">
					<p>Price: S$<?php echo number_format((float)$price[9], 2); ?></p><br>
				</td>
			</tr>
		</table>
	</div>
	<div id="cart">
		<div id="summary">
			<h3>Shopping Cart</h3>
			<table>
				<col width="40%">
				<col width="20%">
				<col width="20%">
				<tr>
					<th>Food</th>
					<th>Price</th>
					<th>Quantity</th>
				</tr>
				<tr id="sect0">
					<td><span id="item0"></span></td>
					<td><span id="price0"></span></td>
					<td><span id="qty0"></span></td>
				</tr>
				<tr id="sect1">
					<td><span id="item1"></span></td>
					<td><span id="price1"></span></td>
					<td><span id="qty1"></span></td>
				</tr>
				<tr id="sect2">
					<td><span id="item2"></span></td>
					<td><span id="price2"></span></td>
					<td><span id="qty2"></span></td>
				</tr>
				<tr id="sect3">
					<td><span id="item3"></span></td>
					<td><span id="price3"></span></td>
					<td><span id="qty3"></span></td>
				</tr>
				<tr id="sect4">
					<td><span id="item4"></span></td>
					<td><span id="price4"></span></td>
					<td><span id="qty4"></span></td>
				</tr>
				<tr id="sect5">
					<td><span id="item5"></span></td>
					<td><span id="price5"></span></td>
					<td><span id="qty5"></span></td>
				</tr>
				<tr id="sect6">
					<td><span id="item6"></span></td>
					<td><span id="price6"></span></td>
					<td><span id="qty6"></span></td>
				</tr>
				<tr id="sect7">
					<td><span id="item7"></span></td>
					<td><span id="price7"></span></td>
					<td><span id="qty7"></span></td>
				</tr>
				<tr id="sect8">
					<td><span id="item8"></span></td>
					<td><span id="price8"></span></td>
					<td><span id="qty8"></span></td>
				</tr>
				<tr id="sect9">
					<td><span id="item9"></span></td>
					<td><span id="price9"></span></td>
					<td><span id="qty9"></span></td>
				</tr>
			</table>
		</div>
		<div id="total">
		
			<p><strong>Total: S$ <input type="text" id="amount" value="0" onfocus="this.blur(); "></strong></p>
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