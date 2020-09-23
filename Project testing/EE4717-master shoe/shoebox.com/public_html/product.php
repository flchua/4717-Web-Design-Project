<?php
    session_start();
    include_once("./include/db.php");
    include_once("./include/session.php");
    $mysqli = db_connect();
    if (!isset($_GET["id"])) {
        header('location:/shop.php');
    }
    $product_id = $_GET["id"];
    if(isset($_POST["submit"]) && isset($_POST["color"]) && isset($_POST["size"]) && isset($_POST["qty"]) && $_POST["qty"] > 0){
        if(isLoggedIn()){
            dbAddToCart($_SESSION["userid"], $product_id,$_POST["color"], $_POST["size"], $_POST["qty"]);
            unset($_POST["submit"]);
        }else{
            promptLogin();
        }
    };
    $product_query = "SELECT * FROM products WHERE product_id = $product_id;";
    $color_query = "SELECT DISTINCT color FROM product_variants WHERE product_id = $product_id;";
    $size_query = "SELECT DISTINCT size FROM product_variants WHERE product_id = $product_id ORDER BY size;";
    
    $color_result = $mysqli->query($color_query);
    $size_result = $mysqli->query($size_query);
    
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/js/script.js"></script>
    <?php
        $product_result = $mysqli->query($product_query);
        $item = $product_result->fetch_assoc();
        echo '<title>SHOEBOX | '.$item["product_name"].'</title>';
    ?>
</head>
<body>
    <main id="main">
        <header>
            <?php include 'partials/nav.php'?>
        </header>
        
        <div id="product-container" class="container">
            <div class="col-sm-12">
                <div class="row">
                    <div id="product-img-col" class="col-sm-6">
                        <?php
                            if($item["pic_url"]===''){
                                echo '<img class="img-fluid" style="width:100%;height:auto;" src="" alt="'.$item["product_name"].'"></img>';
                            }else{
                                echo '
                                    <a href="/assets/products/'.$item["pic_url"].'">
                                        <img class="img-fluid" src="/assets/products/'.$item["pic_url"].'" alt="'.$item["product_name"].'"></img>
                                    </a>
                                ';
                            }     
                        ?>
                    </div>
                    <div id="product-detail-col" class="col-sm-6">
                            <?php echo  '<form action="product.php?id='.$product_id.'" method="post">'; ?>
                            <?php
                                $product_result = $mysqli->query($product_query);
                                if($product_result->num_rows == 1){
                                    $item = $product_result->fetch_assoc();
                                    echo '
                                        <div id="title-row" class="row">
                                            <h4>'.$item['product_name'].'</h4>
                                            <p class="hint-txt">'.$item['description'].'</p>
                                            <p class="hint-txt"><strong>Unit Price: S$ '.$item['price'].'</strong></p>
                                        <div>
                                    ';
                                }
                                echo '<div id="color-row" class="row col-sm-12">';
                                echo '<h5>Color</h5>';
                                if($color_result->num_rows > 0){
                                    while($color = $color_result->fetch_assoc()){
                                        echo '
                                            <div class="selection-cube bg-'.$color['color'].'">
                                                <label>
                                                    <input type="radio" value="'.$color['color'].'" name="color"
                                        ';
                                        if(isset($_POST["colors"])){
                                            if(in_array($color["color"], $_POST["colors"])){
                                                echo ' checked ';
                                            }
                                        }           
                                        echo '
                                        required><span></span>
                                                </label>
                                            </div>
                                        ';
                                    }
                                }
                                echo '</div>';
                                echo '<div id="size-row" class="row col-sm-12">';
                                echo '<h5>Size</h5>';
                                if($size_result->num_rows > 0){
                                    while($item = $size_result->fetch_assoc()){
                                        echo '
                                            <div class="size-cube bg-white">
                                                <label>
                                                    <input type="radio" value="'.$item['size'].'" name="size" required><span>'.$item['size'].'</span>
                                                </label>
                                            </div>
                                        ';
                                    }
                                }
                                echo '</div>'
                            ?>
                                <div id="quantity-row" class="row col-sm-12">
                                    <label>Quantity</label>
                                    <input class="form-control" style="width: 100px;" type="number" value="" min="1" max="99" name="qty" required>
                                </div>
                                <div id="submit-row" class="row col-sm-12">
                                    <input class="btn" type="submit" value="add to cart" name="submit">
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
        include "partials/cart.php";
        include "partials/footer.php";
    ?>
</body>