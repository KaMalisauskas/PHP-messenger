<?php
require_once("connection.php");
session_start();
if(isset($_POST["submit"])) {
  $firstname = htmlspecialchars($_POST["name"]);
  $lastname = htmlspecialchars($_POST["sname"]);
  $email = htmlspecialchars($_POST ["email"]);
  $password = htmlspecialchars($_POST["password"]);

  //Making session var
  $_SESSION["firstname"] = $firstname;
  $_SESSION["lastname"] = $lastname;
  $_SESSION["username"] = $username;
  $_SESSION["email"] = $email;
  //Geting usser by its email
  $encrypted_password = md5($password);
  $user_query = "SELECT email, password FROM users WHERE users.email = '{$email}' AND password = '$encrypted_password'";
  $user = fetch_record($user_query);
  //checking if the user exists
  if (!empty($user)) {
    if($user) {
      header("Location:main.php");
    } else {
      $_SESSION['error'] = "Incorrect password";
      header("Location: index.php");
    }

  } else {
    $_SESSION['error'] = "Incorrect email or password";
    header("Location: index.php");
  }
}
