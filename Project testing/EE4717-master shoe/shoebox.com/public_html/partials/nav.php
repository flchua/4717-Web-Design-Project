<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
<link rel="stylesheet" href="/css/styles.css">
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<?php
    include_once("./include/session.php");
    $hasUser = false;
    if(isLoggedIn()){
        $hasUser = true;
    }
?>
<nav id="top-nav" class="navbar navbar-light bg-faded">
  <a class="navbar-brand" href="/index.php">SHOEBOX</a>
    <ul class="float-right navbar-nav mr-auto">
        <?php
            if($hasUser){
                echo '
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" d="navbarDropdownMenuLink" data-toggle="dropdown">User</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="/order.php">Orders</a>
                            <a class="dropdown-item" href="/include/session.php?logout">Logout</a>
                        </div>
                    </li>
                ';
            }else{
                echo '<li class="nav-item"><a class="nav-link" href="/login.php">Login</a></li>';
            }
        ?>
        <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)" onclick="openNav()">Cart</a>
        </li>
    </ul>
</nav>
<nav id="section-nav" class="navbar navbar-inverse bg-inverse">
    <ul class="navbar-nav">
        <li><a class="nav-item section-link" href="/shop.php?for=men">Men</a></li>
        <li><a class="nav-item section-link" href="/shop.php?for=women">Women</a></li>
        <li><a class="nav-item section-link" href="/shop.php?for=kids">Kids</a></li>
    </ul>
</nav>