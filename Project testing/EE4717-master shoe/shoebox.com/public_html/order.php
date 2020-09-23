<?php
    session_start();
    include_once("./include/session.php");
    include_once("./include/db.php");
    if(!isLoggedIn()){
        header("location: /index.php");
    }
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/js/script.js"></script>
    <title>Shoebox | Orders</title>
</head>
<body>
    <main id="main">
        <header>
            <?php include 'partials/nav.php'?>
        </header>
        <div class="container" max-width="100%">
            <div class="row">
                <div id="current-order" class="col-xs-12">
                    <?php
                        $user_id = $_SESSION["userid"];
                        if(isset($_POST["order"])){
                            unset($_POST["order"]);
                            // unset($_POST);
                            dbPlaceOrder($user_id);
                            echo "<h4>Your Order Has Been Placed!</h4>";
                        }
                        $currItems = dbGetCartItems($user_id);
                        if($currItems->num_rows>0){
                            $subtotal = getCartSubtotal($user_id);
                            $handling = $subtotal < 200 ? 10.00 : 0.00;
                            $total = $subtotal + $handling;
                            echo '
                                <h4>Current order ('.$currItems->num_rows.'):</h4>
                                <span class="keyline-horizontal keyline-grey"></span> 
                                    <div class="row">
                                        <div id="order-gallery" class="col-xs-8">
                            ';
                            echo '<ul class="horizontal-slide">';
                            while($item = $currItems->fetch_assoc()){
                                echo '
                                    <li style="width: 200px;">
                                        <div id="order-item-container" class="container">';
                            if($item["pic_url"]===''){
                                echo '<img class="img-fluid" style="width:100%;height:auto;" src="" alt="'.$item["product_name"].'"></img>';
                            }else{
                                echo '<img class="img-fluid" style="max-width:100%;height:auto;" src="/assets/products/'.$item["pic_url"].'" alt="'.$item["product_name"].'"></img>';
                            }
                            echo '
                                            <div class="row">
                                                <div class="col-xs-7">
                                                    <div style="width:200px;word-wrap: break-word;">
                                                        <p class="hint-txt" style="white-space: normal;"><strong>'.$item["product_name"].'</strong></p>
                                                    </div>
                                                    <p class="hint-txt" id="color"><strong>Color:</strong>  '.$item["color"].'</p>
                                                    <p class="hint-txt" id="size"><strong>Size:</strong>  '.$item["size"].'</p>
                                                    <p class="hint-txt" id="qty"><strong>Quantity:</strong>  '.$item["quantity"].'</p>
                                                    <p class="hint-txt" id="qty"><strong>Subtotal:</strong>  $ '.$item["subtotal"].'</p>
                                                    <input type="hidden" name="item_id" value="'.$item["item_id"].'">
                                                    <input type="hidden" name="product_id" value="'.$item["product_id"].'">
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                ';
                            }
                            echo '</ul>';
                            echo '
                                </div>
                                    <div id="order-info" class="col-xs-3 bg-inverse">
                                        <h6>SUMMARY</h6>
                                        <span class="keyline-horizontal keyline-grey"></span>
                                        <p style="padding-top: 20px"><small>Subtotal: <span class="float-right">$ '.number_format($subtotal,2).'</span></small></p>
                                        <p><small>Delivery & Handling: <span class="float-right">$ '.number_format($handling,2).'</span></small></p>
                                        <span class="keyline-horizontal keyline-grey"></span>
                                        <p style="padding-top: 20px">Total: <span class="float-right">$ '.number_format($total,2).'</span></p>
                                        <form action="/order.php" method="post" style="padding-top: 40px">
                                            <input class="btn" type="submit" value="place order" name="order">
                                        </form>
                                    </div>
                                </div>
                            ';
                        }else{
                            echo '<h4>No items in Cart.</h4>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </main>
    <?php
        include "partials/cart.php";
        include "partials/footer.php";
    ?>
</body>