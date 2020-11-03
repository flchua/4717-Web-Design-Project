<?php
/* get data from database show in table and filter*/


include "dbconnect.php";




if(!empty($_GET['product_cat'])){
	
$product_cat = $_GET['product_cat'];

if($product_cat=='null'){
	
}else{
$sql1 = "SELECT * FROM `menu` where product_cat = '$product_cat' ";
//echo "SELECT * FROM `menu` where product_cat = '$product_cat'";
$result = $conn->query($sql1);	
}

}else{

$sql = "SELECT * FROM `menu`";
$result = $conn->query($sql);
}

?>




<!DOCTYPE html>
<html lang="en">
<head>


</head>
<body>

<div id="wrapper">




<script>
function filter(){
var filter = document.getElementById("pdt");
var product_cat = filter.value;
window.location.assign("menu.php?product_cat="+product_cat);
}
</script>
<div class="dropdown">
<form action="#">
  <label for="product_cat">Choose ur favourtie...</label>
  <select name="product_cat" id="product_cat">
    <option value="meat">meat</option>
    <option value="veg">veg</option>
    <option value="drink">drink</option>
  </select>
  <input type="submit" value="Submit">
</form>
</div>
	
	
	

	<div id="menu">
		<h3 id="food">Food Menu</h3>
		<h4>Meat<input type="button" class="btn" id="btnMeat" value="-" onclick="foldMeat();"></h4>
		<table id="meat" class="product">
		
<?php
if ($result-> num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()){ 
  echo "<tr><td>", $row['product_name'], "</td></tr>";
  } 
}
?>
		
		</table>
		
	</div>
</div>


</body>
</html>