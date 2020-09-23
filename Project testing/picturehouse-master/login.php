<?php
  include "db_connect.php";
  include "console_log.php";

  // Sign Up
  if (
    empty($_SESSION['user_email']) &&
    isset($_POST['email']) &&
    isset($_POST['name']) &&
    isset($_POST['password']) &&
    isset($_POST['password2'])
  ) {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if ($password != $password2) {
      alert("Sorry the passwords do not match");
    } else {  
      $password = sha1($password);
      $sql = "INSERT INTO users (email, name, password)
        VALUES ('$email', '$name', '$password')";
      $result = mysqli_query($conn, $sql);
    
      if ($result) {
        $_SESSION['user_email'] = $email;
      } else {
        alert("Registeration failed. Please try again.");
      }
    }
  } else if ( // Log in
    empty($_SESSION['user_email']) &&
    isset($_POST['email']) &&
    isset($_POST['password'])
  ) {
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      consoleLog($email);
      $_SESSION['user_email'] = $email;
    } else {
      alert("Log in failed. Please try again.");
    }
  }

  mysqli_close($conn);
?>