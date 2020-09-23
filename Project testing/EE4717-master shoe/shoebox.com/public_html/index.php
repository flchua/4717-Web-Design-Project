<?php
    session_start();
    include_once("./include/db.php");    
    $mysqli = db_connect();
    $results = dbGetPopularItems();
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/js/script.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>THE SHOEBOX</title>
</head>

<body>
    <main id="main">
        <header>
            <?php include 'partials/nav.php'?>
        </header>
        <div id="hero" class="hero">
            <div class="hero-video-wrapper">
                <video class="hero-video" loop muted autoplay src="/assets/hero.video.mp4"></video>
            </div>
            <div class="hero-title-wrapper">
                <h1 class="display-4 text-white">Featured</h1>
                <p class="lead text-white">Nike Ice Flash Collection</p>
                <p class="text-white">From strength to style, cool colors to ignite your workout or weekend.</p>
            </div>
        </div>
        <div class="container" id="feature-product">
            <div class="col-xs-12">
                <div class="row">
                    <h3>Popular Products</h3>    
                    <span class="keyline-horizontal keyline-grey"></span>
                </div>
                <div class="row">
                    <ul class="horizontal-slide">
                    <?php
                        if($results != null && $results->num_rows > 0){
                            while($item = $results->fetch_assoc()){
                                echo '
                                <li class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
                                    <a href="/product.php?id='.$item["product_id"].'">
                                    <div class="product-grid-wrapper">
                                        <div class="product-image-wrapper">
                                ';
                                if($item["pic_url"]===''){
                                    echo '<img class="img-fluid" style="width:100%;height:auto;" src="" alt="'.$item["product_name"].'"></img>';
                                }else{
                                    echo '<img class="img-fluid" src="/assets/products/'.$item["pic_url"].'" alt="'.$item["product_name"].'"></img>';
                                }            
                                echo '
                                        </div>
                                        <div class="row col-xs-12">
                                            <h6 style="white-space: normal;">'.$item["product_name"].'</h6>
                                        </div>
                                        <div class="row col-xs-12">
                                            <h6 style="font-size: 12px;">$ '.$item["price"].'</h6>
                                        </div>
                                        <div class="row col-xs-12">
                                            <h6 class="text-warning">'.$item["count"].' items sold 🔥</h6>
                                        </div>
                                    </div>
                                    </a>
                                </li>
                                ';
                            }
                        }
                    ?>
                    </ul>
                </div>
            </div>
            
            
        </section>
    </main>
    <?php
        include "partials/cart.php";
        include "partials/footer.php";
    ?>
</body>

</html>