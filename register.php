<?php
require_once("connection.php");
session_start();

if(isset($_POST["submit"])) {
  global $connection;
  $email_query = "SELECT email FROM users";
  $dbEmail = fetch_record($email_query);
  var_dump($dbEmail);
  if(strpos($_POST ["email"], '@') && $dbEmail["email"] != $_POST ["email"]) {

    if ($_POST["password"]==$_POST["password1"]) {

      $firstname = htmlspecialchars($_POST["name"]);
      $lastname = htmlspecialchars($_POST["sname"]);
      $email = htmlspecialchars($_POST ["email"]);
      $password = htmlspecialchars($_POST["password"]);

      // encrypting password
      $encrypted_password = md5($password);

      //inserting into query
      $query = "INSERT INTO users (firstname, lastname, email, password, last_login, created_at, updated_at)
                Values ('{$firstname}', '{$lastname}', '{$email}', '{$encrypted_password}', NOW(), NOW(), NOW())";
        if (run_mysql_query($query)) {
            echo $message = "Works";
          } else {
            echo $message = "Doesn't work";
          }
    } else {
      $_SESSION["error1"] = "password mismatch";
        header("Location:index.php");
          echo "wrong password";
    }


  } else {
    $_SESSION["error1"] = "invalid email";
      header("Location:index.php");
  }
  header("Location:index.php");
}
