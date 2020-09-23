//Prototype for event
function Event(item, price, qty){
    this.item = item;
    this.price = price;
    this.qty = qty;
}

// hardcoded due to time consideration
var eventList = [
    new Event("Mid-autumn Mooncake Festival", 20, 0),
    new Event("Stories in A Tea Cup", 30, 0)
];

function addEvent(){
    checkQty(); //Validate quantity
    for (var i = 0; i < 2; i++){
        added = document.getElementById("event" + i).value;
        var item = document.getElementById("item" + i);
        var price = document.getElementById("price" + i);
        var qty = document.getElementById("qty" + i);
        var sect = document.getElementById("sect" + i);
        if (added > 0){
            sect.style.display = "table-row";
            item.innerHTML = eventList[i].item; 
            price.innerHTML = eventList[i].price;
            qty.innerHTML = added;
            eventList[i].qty = added;
        }
        else {
            sect.style.display = "none";
            eventList[i].qty = 0;
        }
        compute(eventList); //Compute total amount
    }
}

function checkQty(){
    var check = document.getElementsByClassName("qty");
    for (var i = 0; i < 2; i++){
        if ((check[i].value < 0)||(check[i].value % 1 != 0)){
            alert("The quantity is not valid.\n" + "It must be a positive integer.");
            check[i].focus();
            check[i].select();
            return false;
        }
    }
}

function compute(eventList){
    var total = document.getElementById("amount");
    var temp = 0;
    for (var i = 0; i < 2; i++){
        temp += eventList[i].price * eventList[i].qty;
    }
    total.value = temp; 
}


function checkInput(){ //Form validation
	//Prevent form submission if quantity is invalid or no events are selected
	var qty0 = document.getElementById("event0").value;
	var qty1 = document.getElementById("event1").value;

	if ((qty0==0) && (qty1==0)) {
		alert("You did not book any event!");
		return false;
	}
}