// hardcoded to be 10 items for demo purpose with time consideration
var price0 = "<?php echo $price[0]; ?>";
var price1 = "<?php echo $price[1]; ?>";
var price2 = "<?php echo $price[2]; ?>";
var price3 = "<?php echo $price[3]; ?>";
var price4 = "<?php echo $price[4]; ?>";
var price5 = "<?php echo $price[5]; ?>";
var price6 = "<?php echo $price[6]; ?>";
var price7 = "<?php echo $price[7]; ?>";
var price8 = "<?php echo $price[8]; ?>";
var price9 = "<?php echo $price[9]; ?>";

function Product(item, price, qty){
    this.item = item;
    this.price = price;
    this.qty = qty;
}

var productList = [
    new Product("Sliced Beef with Black Pepper Sauce", price0, 0),
    new Product("Double Cooked Pork with Chinese Leek", price1, 0),
    new Product("Spicy Chicken", price2, 0),
    new Product("Fish Filets in Hot Chili Oil", price3, 0),
    new Product("Egg Plant with Minced Chicken and Sichuan Chilli Sauce", price4, 0),
    new Product("Lettuce in Oyster Sauce", price5, 0),
    new Product("Bai Mu Dan White Peony Tea", price6, 0),
    new Product("Oolong Tea", price7, 0),
    new Product("Sweet-sour Plum Juice", price8, 0),
    new Product("Traditional Chinese Liquor", price9, 0)
];

function addProduct(){
    checkQty(); //Validate quantity
    for (var i = 0; i < 10; i++){
        added = document.getElementById("delivery" + i).value;
        var item = document.getElementById("item" + i);
        var price = document.getElementById("price" + i);
        var qty = document.getElementById("qty" + i);
        var sect = document.getElementById("sect" + i);
        if (added > 0){
            sect.style.display = "table-row";
            item.innerHTML = productList[i].item; 
            price.innerHTML = productList[i].price;
            qty.innerHTML = added;
            productList[i].qty = added;
        }
        else {
            sect.style.display = "none";
            productList[i].qty = 0;
        }
        compute(productList); //Compute total amount
    }
}

function checkQty(){
    var qty = document.getElementsByClassName("qty");
    for (var i = 0; i < 10; i++){
        if ((qty[i].value < 0)||(qty[i].value % 1 != 0)){
            alert("The qty is not valid.\n" + "It must be a positive integer.");
            qty[i].focus();
            qty[i].select();
            return false;
        }
    }
}

function compute(productList){
    var total = document.getElementById("amount");
    var temp = 0;
    for (var i = 0; i < 10; i++){
        temp += productList[i].price * productList[i].qty;
    }
    total.value = temp; 
}

//Control section fold/unfold
function foldMeat() {
	var x = document.getElementById("meat");
	var y = document.getElementById("btnMeat");
	if (x.style.display === "none") {
		x.style.display = "block";
		y.value = "-";
	} 
	else {
		x.style.display = "none";
		y.value = "+";
	}
}
function foldVege() {
	var x = document.getElementById("vege");
	var y = document.getElementById("btnVege");
	if (x.style.display === "none") {
		x.style.display = "block";
		y.value = "-";
	} 
	else {
		x.style.display = "none";
		y.value = "+";
	}
}
function foldDrink() {
	var x = document.getElementById("drink");
	var y = document.getElementById("btnDrink");
	if (x.style.display === "none") {
		x.style.display = "block";
		y.value = "-";
	} 
	else {
		x.style.display = "none";
		y.value = "+";
	}
}

function checkInput(){
	var qty0 = document.getElementById("delivery0").value;
	var qty1 = document.getElementById("delivery1").value;
	var qty2 = document.getElementById("delivery2").value;
	var qty3 = document.getElementById("delivery3").value;
	var qty4 = document.getElementById("delivery4").value;
	var qty5 = document.getElementById("delivery5").value;
	var qty6 = document.getElementById("delivery6").value;
	var qty7 = document.getElementById("delivery7").value;
	var qty8 = document.getElementById("delivery8").value;
	var qty9 = document.getElementById("delivery9").value;
	
	//Prevent form submission if nothing is ordered
	if ((qty0+qty1+qty2+qty3+qty4+qty5+qty6+qty7+qty8+qty9)==0) {
		alert("You did not order anything!");
		return false;
	}
}
