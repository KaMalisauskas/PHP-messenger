<?php
session_start();
require_once("connection.php");
if (isset($_POST["submit"])) {
  $message = $_POST["message"];
  $email = $_SESSION["email"];

  $id_qry = "SELECT id FROM users WHERE email = '{$email}' ORDER BY id DESC";

  $queryId = fetch_record($id_qry);
  $queryId = intval($queryId["id"]);

  $userto = $_POST["user"];

  $message_query = "INSERT INTO messages (user_from, user_to, message, created_at, updated_at)
                    VALUES ('{$queryId}', '{$userto}' ,'{$message}', NOW(), NOW())";
                    echo $message;

                    if (run_mysql_query($message_query)) {
                         echo "ok";
                         header("Location:main.php");
                       } else {
                         echo "fail";
                       }
                     }

                    //  $message_query = "INSERT INTO messages (user_from, user_to, messages, created_at, updated_at)
                    //                    VALUES ('{$queryId}', '{$userto}' ,'{$message}', NOW(), NOW())";

   if (isset($_POST["replay"])) {
     $message = $_POST["message"];
     $email = $_SESSION["email"];
     $link = $_SESSION["ID"];

     $id_qry = "SELECT id FROM users WHERE email = '{$email}' ORDER BY id DESC";

     $queryId = fetch_record($id_qry);
     $queryId = intval($queryId["id"]);
     $userto = $_POST["user"];
     $message_query = "INSERT INTO messages (user_from, user_to, message, created_at, updated_at)
                       VALUES ('{$queryId}', '{$userto}' ,'{$message}', NOW(), NOW())";
                       echo $message;

                       if (run_mysql_query($message_query)) {
                         header("Location: messages.php?id=$link");
                          } else {
                            echo "fail";
                }
}



 ?>
