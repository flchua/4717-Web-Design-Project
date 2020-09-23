<?php
    include_once("./db.php");
    if(isset($_REQUEST["delete"]) && isset($_REQUEST["item_id"])){
        $item_id = $_REQUEST["item_id"];
        echo "DELTEING...";
        dbRemoveItemByID($item_id);
    }else if(isset($_REQUEST["edit"]) && isset($_REQUEST["item_id"])){
        $item_id = $_REQUEST["item_id"];
        $results = dbGetItemByID($item_id);
        if($results->num_rows === 1){
            $item = $results->fetch_assoc(); 
            $color_results = dbGetColorsForProduct($item["product_id"]);
            $size_results = dbGetSizesForProduct($item["product_id"]);
            
            echo '
                <div class="col-xs-7">
                    <h6 class="text-warning">'.$item["product_name"].'</h6>
                    <div id="edit-row" class="row">
                        <label class="sr-only" for="color">Color:</label>
                        <select class="form-control" id="color" name="color" required>
                            
            ';
            if($color_results->num_rows > 0){
                while($color = $color_results->fetch_assoc()){
                    if($color["color"] === $item["color"]){
                        echo '
                            <option selected="selected">'.$color["color"].'</option>
                        ';
                    }else{
                        echo '
                            <option>'.$color["color"].'</option>
                        ';
                    }
                }
            }
            echo '
                        </select>
                    </div>
                    <div id="edit-row" class="row">
                        <label class="sr-only" for="size">Size:</label>
                        <select class="form-control" id="size" name="size" required>
            ';
            if($size_results->num_rows > 0){
                while($size = $size_results->fetch_assoc()){
                    if($size["size"] === $item["size"]){
                        echo '
                            <option selected="selected">'.$size["size"].'</option>
                        ';
                    }else{
                        echo '
                            <option>'.$size["size"].'</option>
                        ';
                    }
                }
            }            
            echo '
                        </select>
                    </div>
                    <div id="edit-row" class="row">
                        <label class="sr-only" for="quantity">Quantity:</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="'.$item["quantity"].'" min="1" max="99" required>
                    </div>
                    <div id="edit-row" class="row">
                        <input id="'.$item["item_id"].'" class="btn btn-secondary" style="padding:0 20px; margin-right:10px;" type="button" name="edit" value="&#x270E;" onclick="updateItem(\'e\', this)">
                        <input class="btn btn-secondary" style="padding:0 10px;" type="button" name="cancle" value="&#x2716;" onclick="cancelEdit(\'e\', this)">
                    </div>
                </div>
            ';
        }
    }
    if(isset($_REQUEST["update"]) && isset($_REQUEST["item_id"]) && isset($_REQUEST["color"]) && isset($_REQUEST["size"]) && isset($_REQUEST["quantity"])){
        $item_id = $_REQUEST["item_id"];
        $color = $_REQUEST["color"];
        $size = $_REQUEST["size"];
        $quantity = $_REQUEST["quantity"];
        if(dbCartItemUpdate($item_id, $color, $size, $quantity)){
            $results = dbGetItemByID($item_id);
            if($results->num_rows === 1){
                $item = $results->fetch_assoc(); 
                echo '
                    <div class="col-xs-7">
                        <h6 class="text-warning">'.$item["product_name"].'</h6>
                        <p class="hint-txt" id="color"><strong>Color:</strong>  '.$item["color"].'</p>
                        <p class="hint-txt" id="size"><strong>Size:</strong>  '.$item["size"].'</p>
                        <p class="hint-txt" id="qty"><strong>Quantity:</strong>  '.$item["quantity"].'</p>
                        <p class="hint-txt" id="qty"><strong>Subtotal:</strong>  $ '.$item["subtotal"].'</p>
                        <input type="hidden" name="item_id" value="'.$item["item_id"].'">
                        <input type="hidden" name="product_id" value="'.$item["product_id"].'">
                        <input id="'.$item["item_id"].'" class="btn btn-secondary" type="button" name="modify" value="edit" onclick="editItem(\'e\', this)">
                    </div>
                ';
            }
        }
    }
    
?>
