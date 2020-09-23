<?php
  session_start();
  // store to test if they *were* logged in
  $old_user = $_SESSION['user_email'];  
  unset($_SESSION['user_email']);
  session_destroy();
?>