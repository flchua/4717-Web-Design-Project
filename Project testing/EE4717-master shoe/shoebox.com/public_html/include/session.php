<?php
    include_once("db.php");
    
    if (isset($_REQUEST['logout'])){
        logout();
    }else if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])){
        login($_POST['username'], $_POST['password']);
    }else if (isset($_POST['signup']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password'])){
        signup($_POST['email'], $_POST['username'], $_POST['password']);
    }

    function login($username, $password){
        if(checkCredential($username, $password)){
            createSession($username, getUserID($username));
            header("location: /index.php");
        }else{
            header("location: /login.php?login_error=1");
        }
    }

    function signup($email, $username, $password){
        $error = 0;
        if(hasEmail($email)){
            $error += 1;
        }
        if(hasUser($username)){
            $error += 2;
        }
        if($error === 1){
            header("location: /signup.php?email_error");
        }else if($error === 2){
            header("location: /signup.php?user_error");
        }else if($error === 3){
            header("location: /signup.php?user_error&email_error");
        }else{
            if(registerUser($email, $username, $password)){
                createSession($username, getUserID($username));
                header("location: /index.php");
            }else{
                header("location: /signup.php?error=1");
            }
        }
    }

    function logout(){
        session_start();
        session_destroy();
        echo "<h2>You have been logged out. Redirecting to home page.</h2>";
        header( "refresh: 3; url=/index.php" );                
    }

    function promptLogin(){
        echo '
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <form action="./login.php" method="GET"> 
                        <span class="close">&times;</span>
                        <h3>You need to login first.</h3><br>
                        <input class="btn" type="submit" name="redirect" value="Login">
                    </form>
                </div>
            </div>
            <script>
                var modal = document.getElementById("myModal");
                var btn = document.getElementById("myBtn");
                var span = document.getElementsByClassName("close")[0];
                modal.style.display = "block";
                span.onclick = function() {
                    modal.remove();
                }
                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.remove();
                    }
                }
            </script>
        ';
    }

    function getUserID($username){
        $mysqli = db_connect();
        $stmt = "SELECT user_id from users where username = '$username'";
        $result = $mysqli->query($stmt);
        if($result->num_rows === 1){
            $user = $result->fetch_assoc();
            return $user["user_id"];
        }
        return null;
    }

    function hasEmail($email){
        $mysqli = db_connect();
        $stmt = "SELECT * from users where email = '".$email."';";
        $result = $mysqli->query($stmt);
        echo '<h1>has email:'.$result->num_rows.'</h1>';
        return $result->num_rows === 1;
    }

    function hasUser($username){
        $mysqli = db_connect();
        $stmt = "SELECT * from users where username = '".$username."';";
        $result = $mysqli->query($stmt);
        echo '<h1>has users:'.$result->num_rows.'</h1>';
        return $result->num_rows === 1;
    }

    function checkCredential($username, $password){
        $mysqli = db_connect();
        $hash = hash_SHA256($password);
        $user_query = "SELECT * from users where username = '".$username."' and password = '".$hash."';";
        $result = $mysqli->query($user_query);
        return $result->num_rows === 1;
    }

    function registerUser($email, $username, $password){
        $mysqli = db_connect();
        $hash = hash_SHA256($password);
        $insert_stmt = "INSERT INTO users (user_id, email, username, password) VALUES ( UUID(), '".$email."','".$username."','".$hash."');";
        if ($mysqli->query($insert_stmt)){
            return true;
        }else{
            echo ''.$mysqli->error;
            return false;
        }
    }

    function createSession($username, $userid){
        session_start();
        $_SESSION['login'] = true;
        $_SESSION['timeout'] = time();
        $_SESSION['username'] = $username;
        $_SESSION['userid'] = $userid;
    }

    function hash_SHA256($plaintext){
        return hash("sha256", $plaintext);
    }

    function isLoggedIn() { 
        return isset($_SESSION['username']) AND isset($_SESSION['login']);
    }
?>