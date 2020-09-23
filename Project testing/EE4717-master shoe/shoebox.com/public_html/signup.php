<?php
    session_start();
    include_once("./include/session.php");
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/js/script.js"></script>
    <title>Shoebox | Signup</title>
</head>
<body>
    <main id="main">
        <header>
            <?php include 'partials/nav.php'?>
        </header>
        <div class="form-container">
            
        
        <?php
            if(isLoggedIn()){
                echo '<h3>You have already logged in. Redirecting back to home page in <p id="counter">3</p> seconds...<br></h3>If not redirecting, <a style="color:blue;" href="/index.php">click here</a>';
                header( "refresh: 3;url=index.php" );                
            }else{
                echo '
                    <form action="/include/session.php" method="post" onsubmit="return validateForm()">
                        <h2>REGISTER WITH US</h2>
                        <div>
                            <input id="email" class="input-txt" type="email" name="email" placeholder="Email" required>';
                if (isset($_GET['email_error'])){
                    echo '  <p class="warning-txt">Email is already used. <a class="nav-link" href="/login.php">Login instead</a></p>';
                }
                echo '
                            <p id="email_warning" class="warning-txt"></p>
                        </div>
                    ';
                    
                echo '
                        <div>
                            <input id="username" class="input-txt" type="text" name="username" placeholder="Username" required>
                            <p id="username_warning" class="warning-txt"></p>';
                if (isset($_GET['user_error'])){
                    echo '<p class="warning-txt">Username is already used.</p>';   
                }
                echo '
                        </div>
                    ';
                    
                echo '
                        <div>
                            <input id="password" class="input-txt" type="password" name="password" placeholder="Password" required>
                            <p id="password_warning" class="warning-txt"></p>
                            <input id="confirm_password" class="input-txt" type="password" name="confirm_password" placeholder="Confirm password" required>
                            <p id="confirm_password_warning" class="warning-txt"></p>
                        </div>
                    ';
                echo '<input class="btn" type="submit" value="signup" name="signup">';
                if (isset($_GET['error'])){
                    echo '<div><p class="warning">Unknown error. Please retry later.</p></div>';   
                }
                echo '<p>Already have an account? <a href="/login.php" class="nav-link">Login here.</a></p>';
                echo '</form>';
            }
        ?>
        
        </div>
        
    </main>
    <?php
        include "partials/cart.php";
        include "partials/footer.php";
    ?>
</body>
<script type="text/javascript">
    function countdown() {
        var i = document.getElementById('counter');
        if (parseInt(i.innerHTML)<=0) {
            location.href = 'login.php';
        }
            i.innerHTML = parseInt(i.innerHTML)-1;
        }
    if(document.getElementById('counter') !== null){
        setInterval(function(){ countdown(); },1000);
    }
    
    var emailInput = document.getElementById("email");
    var usernameInput = document.getElementById("username");
    var passwordInput = document.getElementById("password");
    var confirmPasswordInput = document.getElementById("confirm_password");
    var emailWarningText = document.getElementById("email_warning");
    var usernameWarningText = document.getElementById("username_warning");
    var passwordWarningText = document.getElementById("password_warning");
    var confirmPasswordWarningText = document.getElementById("confirm_password_warning");
    emailInput.addEventListener('keyup', function(){
        validateEmail();
    });
    usernameInput.addEventListener('keyup', function(){
        validateUsername();
    });
    passwordInput.addEventListener('keyup', function(){
        validatePassword();
    });
    confirmPasswordInput.addEventListener('keyup', function(){
        validateConfirmPassword();
    });
    emailInput.addEventListener('change', function(){
        validateEmail();
    });
    usernameInput.addEventListener('change', function(){
        validateUsername();
    });
    passwordInput.addEventListener('change', function(){
        validatePassword();
    });
    confirmPasswordInput.addEventListener('change', function(){
        validateConfirmPassword();
    });

    function validateEmail(){
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        var isValid = true;
        var warnings = [];
        if(!re.test(emailInput.value.trim())){
            warnings.push("invalid email address");
            isValid = false;
        }
        showWarning(emailWarningText, warnings);
        return isValid;
    }
    function validateUsername(){
        // username 
        // can have a-z, A-Z, 0-9 plus '-'(hyphen) and '_'(underscore)
        // length between 4 to 12.
        var re = /^[a-zA-Z0-9-_]+$/;
        var isValid = true;
        var warnings = [];
        var strVal = usernameInput.value.trim();
        if(strVal.length < 4 || strVal.length > 12){
            isValid = false;
            warnings.push("Username must be 4 to 12 characters.");
        }
        if(!re.test(strVal)){
            isValid = false;
            warnings.push("Username can only contain alphanumeric characters, hyphen and underscore");
        }
        showWarning(usernameWarningText, warnings);
        return isValid;
    }
    function validatePassword(){
        // password 
        // must contain at least one letter and one digit
        // special characters "!", "@", "#", "$", "%", "^", "&", "*"" allowed
        // at least 8 characters and at most 16 characters
        var re = /^(?=.*[a-zA-Z])(?=.*[0-9])/;
        var antiRe = /[^a-zA-Z0-9!@#$%^&*]+/;
        var isValid = true;
        var warnings = [];
        var strVal = passwordInput.value.trim();
        if(strVal.length < 8 || strVal.length > 16){
            isValid = false;
            warnings.push("Password must be 8 to 16 characters.");
        }
        if(antiRe.test(strVal)){
            isValid = false;
            warnings.push("Only alphanumeric and !@#$%^&* characters.");
        }
        if(!re.test(strVal)){
            isValid = false;
            warnings.push("Password must contain both alphabets and numbers");
        }
        showWarning(passwordWarningText, warnings);
        return isValid;
    }
    function validateConfirmPassword(){
        // re-enter password must match
        var isValid = true;
        var warnings = [];
        if (passwordInput.value != confirmPasswordInput.value){
            warnings.push("Password does not match.");
            isValid = false;
        }
        showWarning(confirmPasswordWarningText, warnings);
        return isValid;
    }
    function validateForm(){
        return validateEmail() && validateUsername() && validatePassword() && validateConfirmPassword();
    }

    function showWarning(el, warnings){
        el.innerHTML = "";
        warnings.forEach(function(item){
            el.innerHTML += "\u2022 " + item + "<br>";
        });
    }

</script>