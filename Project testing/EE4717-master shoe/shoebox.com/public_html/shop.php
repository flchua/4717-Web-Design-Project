<?php
    session_start();
    include_once("./include/db.php");
    $mysqli = db_connect();
    // gender filter
    $for = null;
    if(isset($_GET["for"])){
        $for = $_GET["for"];
    }
    if ($for == null) {
        $for = "men";
    }
    // products
    $products = null;
    $stmt = "SELECT * FROM products WHERE gender = '$for';";
    $brands_stmt = "SELECT DISTINCT brand FROM products";
    $color_stmt = "SELECT DISTINCT color FROM product_variants";
    // filter
    if (isset($_POST["reset"])){
        unset($_POST["brands"]);
        unset($_POST["colors"]);
    } if (isset($_POST["filter"])){
        $filterStmt = "SELECT * from products WHERE gender = '$for'";
        if(isset($_POST["colors"])){
            if(count($_POST["colors"])){
                $colors = join("','", $_POST["colors"]);
                $filterStmt = $filterStmt." AND product_id IN (SELECT product_id FROM product_variants WHERE color in ('$colors'))";
            }
        }
        if(isset($_POST["brands"])){
            if(count($_POST["brands"])){
                $brands = join("','", $_POST["brands"]);
                $filterStmt = $filterStmt." AND brand IN ('$brands')";
            }
        }
        $filterStmt = $filterStmt.";";
        $products = $mysqli->query($filterStmt);
    }else{
        $products = $mysqli->query($stmt);
    }
    
    
    $brands = $mysqli->query($brands_stmt);
    $colors = $mysqli->query($color_stmt);
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/js/script.js"></script>
    <title>SHOEBOX | Shop</title>
</head>
<body>
    <main id="main">
        <header>
            <?php include 'partials/nav.php'?>
        </header>
        <div class="container" style="max-width: 100%;">
            <div class="col-xl-12">
                <div class="col-xs-12 col-sm-5 col-md-4 col-lg-3 col-xl-2 float-left">
                    <form action="/shop.php?for=<?php echo $for;?>" method="post">
                        <div id="filter-title-row" class="row">    
                            <div class="col-xs-5 col-md-5" style="padding:20px 0;">
                                <h5 class="headline">Filters</h5>   
                            </div>
                            <div id="filter-submit-btn" class="col-xs-2 col-md-2">
                                <input class="btn btn-secondary" style="margin-right:15px;" type="submit" value="&#8635;" name="reset">
                            </div>
                            <div id="filter-reset-btn" class="col-xs-5 col-md-5">
                                <input class="btn btn-secondary" type="submit" value="apply" name="filter">
                            </div>
                            <span class="keyline-horizontal keyline-grey"></span>
                        </div>

                        <div class="row">
                            <span class="keyline-horizontal keyline-grey"></span>
                            <div class="filter-section" id="filter-brand">
                                <h5>BRAND</h5>
                                <span class="keyline-horizontal keyline-grey"></span>
                                <?php
                                    if($brands->num_rows > 0){
                                        
                                        while($brand = $brands->fetch_assoc()){
                                            echo '
                                                <div class="checkbox">
                                                    <label style="text-transform:capitalize;">
                                                        <input style="margin-right: 10px;" type="checkbox" name="brands[]" value="'.$brand["brand"].'"
                                            ';
                                            if(isset($_POST["brands"])){
                                                if(in_array($brand["brand"], $_POST["brands"])){
                                                    echo ' checked ';
                                                }
                                            }
                                            echo '
                                                >'.$brand["brand"].'</label></div>
                                            ';
                                        }
                                    }
                                ?>
                            </div>
                            <div class="filter-section" id="filter-color">
                                <h5>COLOR</h5>
                                <span class="keyline-horizontal keyline-grey"></span>
                                <?php
                                    if($colors->num_rows > 0){
                                        while($color = $colors->fetch_assoc()){
                                            echo '
                                                <div class="selection-cube bg-'.$color['color'].'">
                                                    <label>
                                                        <input type="checkbox" value="'.$color['color'].'" name="colors[]"
                                            ';
                                            if(isset($_POST["colors"])){
                                                if(in_array($color["color"], $_POST["colors"])){
                                                    echo ' checked ';
                                                }
                                            }           
                                            echo '
                                                ><span></span>
                                                    </label>
                                                </div>
                                            ';
                                        }
                                    }
                                ?>
                            </div>    
                        </div>        
                    </form>
                </div>
                <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9 col-xl-10">
                    <div class="product-list-container" id="product-list">
                        <?php 
                            if($products != null && $products->num_rows > 0){
                                while($item = $products->fetch_assoc()){
                                    echo '   
                                        <div id="product-card" class="product-grid-wrapper" onclick="navToDetailPage(\''.$item["product_id"].'\')">
                                            <div class="">
                                    ';
                                    if($item["pic_url"]===''){
                                        echo '<img class="img-fluid" style="width:100%;height:auto;" src="" alt="'.$item["product_name"].'"></img>';
                                    }else{
                                        echo '<img class="img-fluid" src="/assets/products/'.$item["pic_url"].'" alt="'.$item["product_name"].'"></img>';
                                    }          
                                    echo '
                                            </div>
                                            <div class="">
                                                <h6>'.$item["product_name"].'</h6>
                                            </div>
                                            <div class="">
                                                <h6>$' .$item["price"].'</h6>
                                            </div>
                                        </div>
                                    ';
                                }
                            }else{
                                echo '
                                    <h3 style="width:100%;text-align:center;padding:50px 0;">No matching content</h3>
                                ';
                            }
                        ?>
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
<script type="text/javascript">
    function navToDetailPage(productId){
        window.location.href = '/product.php?id=' + productId;
    }
</script>