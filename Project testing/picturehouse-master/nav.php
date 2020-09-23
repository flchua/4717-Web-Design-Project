<?php session_start(); include "login.php"; ?>

<nav>
    <a href="index.php">Home</a>
    <a href="browse.php">Movies</a>
    <a href="cinemas.php">Cinemas</a>
    <a href="about.php">About</a>
    <?php
        if (isset($_SESSION['user_email'])) {
            echo "<a href='account.php'>Account</a>";
        } else {
            echo "<a href='#' class='show-modal'>Log In</a>";
        }
    ?>

</nav>

<div class="modal">
    <div class="box">
        <div class="x"></div>
        <span id="show-login" class="current">Log In</span> | <span id="show-signup">Sign Up</span>
        <form class="login" method="post" action="index.php">
            <label>Email</label>
            <input type="text" name="email" required>
            <label>Password</label>
            <input type="password" name="password" required>
            <input type="submit" value="Log in">
        </form>

        <form class="signup" method="post" action="index.php">
            <label>Email</label>
            <input type="text" name="email" required>
            <label>Name</label>
            <input type="text" name="name" required>
            <label>Password</label>
            <input type="password" name="password" required>
            <label>Enter password again</label>
            <input type="password" name="password2" required>
            <input type="submit" value="Sign Up">
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#show-signup').click(function() {
            $('#show-login').removeClass('current');
            $(this).addClass('current');
            $('.login').hide();
            $('.signup').show();
        });
        $('#show-login').click(function() {
            $('#show-signup').removeClass('current');
            $(this).addClass('current');
            $('.signup').hide();
            $('.login').show();
        });
        $('.x').click(function() {
            $('.modal').fadeOut(200);
        });
        $('.show-modal').click(function() {
            $('.modal').fadeIn(200);
        })
    })
</script>