<!DOCTYPE html>
<html>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700|Poppins:400,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="reset.css">
    <link rel="stylesheet" type="text/css" href="common.css">
    <link rel="stylesheet" type="text/css" href="home.css">
    <script type="text/javascript" src="slideshow.js"></script>
    <title>PICTURE HOUSE</title>
</head>

<body>
    <?php include "nav.php"; ?>

    <div id="banner">
        <div class="slideshow">
            <div style="background-image: url(people.jpg)"></div>
            <div style="background-image: url(banner1.jpg)"></div>
            <div style="background-image: url(banner2.jpg)"></div>
        </div>
        <!-- <div class="gradient"></div> -->
        <div class="overlay"></div>
        <div class="width-wrap">
            <h2>WELCOME TO</h2>
            <h1>PICTURE HOUSE</h1>
            <?php include "index_dropdown.php" ?>
        </div>
    </div>
    
    <?php include 'footer.php'; ?>
</body>

</html>

