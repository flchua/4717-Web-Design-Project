<?php
    $hasItem = false;
    include_once("./include/db.php");
    include_once("./include/session.php");
    $mysqli = db_connect();
    $isLoggedIn = isLoggedIn();
    if($isLoggedIn){
        $items = dbGetCartItems($_SESSION["userid"]);
        if($items->num_rows>0){
            $hasItem = true;
        }
    }
?>
<div id="cartSidenav" class="cart-side-nav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div id="content" class="sidenav-container">
        <div class="title-container">
            <?php
                if ($isLoggedIn){
                    if (!$hasItem){
                        echo '
                            <h4>Shopping Cart</h4>
                            <p><span class="hint-txt">Your shopping cart is empty </span>😢</p>
                        ';
                    }else{
                        echo '
                            <h4>
                                Shopping Cart <small>('.$items->num_rows.')</small>
                            </h4>
                        ';
                    }
                }else{
                    echo '
                        <h4>Shopping Cart</h4>
                        <p><span class="hint-txt">Please <a href="/login.php">Login</a> to view shopping cart</span></p>  
                    ';
                }
            ?>
        </div>
        <form action="/order.php" method="post">
            <div class="order-container">
                <ul>
                    <?php
                        if ($isLoggedIn){
                            if ($hasItem){
                                $items = dbGetCartItems($_SESSION["userid"]);
                                if($items->num_rows>0){
                                    while($item = $items->fetch_assoc()){
                                        echo '
                                            <li>
                                                <div id="cart-item-container" class="container">
                                                    <div class="col-xs-12">
                                                        <div class="row">
                                                            <div class="col-xs-5">';
                                        if($item["pic_url"]===''){
                                            echo '<img class="img-fluid" style="width:100%;height:auto;" src="" alt="'.$item["product_name"].'"></img>';
                                        }else{
                                            echo '<img class="img-fluid" style="max-width:100%;height:auto;" src="/assets/products/'.$item["pic_url"].'" alt="'.$item["product_name"].'"></img>';
                                        }
                                        echo '
                                                            </div>
                                                            <div class="col-xs-7">
                                                                <h6 class="text-warning">'.$item["product_name"].'</h6>
                                                                <p class="hint-txt" id="color"><strong>Color:</strong>  '.$item["color"].'</p>
                                                                <p class="hint-txt" id="size"><strong>Size:</strong>  '.$item["size"].'</p>
                                                                <p class="hint-txt" id="qty"><strong>Quantity:</strong>  '.$item["quantity"].'</p>
                                                                <p class="hint-txt" id="qty"><strong>Subtotal:</strong>  $ '.$item["subtotal"].'</p>
                                                                <input type="hidden" name="item_id" value="'.$item["item_id"].'" >
                                                                <input type="hidden" name="product_id" value="'.$item["product_id"].'">
                                                                <input id="'.$item["item_id"].'" class="btn btn-secondary" type="button" name="modify" value="edit" onclick="editItem(\'e\', this)">
                                                                <input id="'.$item["item_id"].'" class="btn btn-secondary" type="button" name="delete" value="&#x2716;" onclick="deleteItem(\'e\', this)">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        ';
                                    }
                                }
                            }
                        }
                    ?>
                </ul>
            </div>
            <?php
                if ($isLoggedIn){
                    if ($hasItem){
                        echo '
                            <div class="btn-container" style="height:20%">
                                <input type="submit" value="Order" class="btn float-right" style="margin: 20px; margin-right: 50px;">
                            </div>
                        ';
                    }
                }
            ?>
        </form>
    </div>
</div>
<script>
    var originalContainer = null;
    //in javascript
    function editItem(dummy, src, itemId){
        originalContainer = src.parentNode;
        originalContainer.style.display = "none";
        var parentContainer = originalContainer.parentNode;
        var xmlReq = new XMLHttpRequest();
        xmlReq.onreadystatechange = function(){
            if(this.readyState === 4 && this.status === 200){
                var dummyHTML = document.createElement("html");
                dummyHTML.innerHTML = xmlReq.responseText;
                var responseEl = dummyHTML.getElementsByTagName("div")[0];
                parentContainer.appendChild(responseEl);
            }
        };        
        xmlReq.open("POST", '/include/item-edit.php?edit&item_id=' + src.id);
        xmlReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlReq.send();
    }

    function deleteItem(dummy, src, itemId){
        var listNode = src.parentNode.parentNode.parentNode.parentNode.parentNode;
        var xmlReq = new XMLHttpRequest();
        xmlReq.onreadystatechange = function(){
            if(this.readyState === 4 && this.status === 200){
                console.log(xmlReq.responseText);
                listNode.remove();
            }
        };        
        xmlReq.open("POST", '/include/item-edit.php?delete&item_id=' + src.id);
        xmlReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlReq.send();
    }  

    function cancelEdit(dummy, src){
        src.parentNode.parentNode.remove();
        originalContainer.style.display = "block";
    }
    
    function updateItem(dummy, src){
        var currentContainer = src.parentNode.parentNode;
        var parentContainer = originalContainer.parentNode;
        var selectInputs = currentContainer.getElementsByTagName("select");
        var colorInput = selectInputs[0];
        var sizeInput = selectInputs[1];
        var quantityInput = currentContainer.getElementsByTagName("input")[0];
        var color = colorInput.options[colorInput.selectedIndex].text;
        var size = sizeInput.options[sizeInput.selectedIndex].text;
        var quantity = quantityInput.value;
        if(color.trim().length === 0 || size.trim().length === 0 || quantity.trim().length === 0){
            alert("Must not leave options blank.");
            return;
        }
        var xmlReq = new XMLHttpRequest();
        xmlReq.onreadystatechange = function(){
            if(this.readyState === 4 && this.status === 200){
                var dummyHTML = document.createElement("html");
                dummyHTML.innerHTML = xmlReq.responseText;
                var responseEl = dummyHTML.getElementsByTagName("div")[0];
                parentContainer.appendChild(responseEl);
                src.parentNode.parentNode.remove();
                originalContainer.remove();
            }
        };
        xmlReq.open("POST", '/include/item-edit.php?update&item_id=' + src.id + '&color=' + color + '&size=' + size + '&quantity=' + quantity);
        xmlReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlReq.send();
        
    }
</script>