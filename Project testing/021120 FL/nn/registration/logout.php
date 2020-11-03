<?php 
session_start();

//Check if the user has logged in
if (isset($_SESSION['user_id'])){
    echo '<script language="javascript">';
    echo "alert('You have sucessfully logged out.');";
    echo "window.location.href = 'register.php';";
    echo '</script>';
    unset($_SESSION['user_id']);
}
else{
    echo '<script language="javascript">';
    echo "alert('You are not logged in.');";
    echo "window.location.href = 'register.php';";
    echo '</script>';
}
?>