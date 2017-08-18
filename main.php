<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Private messaging app</title>
    <style>
      .container {
        position: relative;
        width: 800px;
        height: 600px;
        background-color: lightgrey;
        margin: 0 auto;
      }
      .container .box {
        width: 95%;
        height: 100px;
        padding: 20px;
      }
    </style>
  </head>
  <body>
    <?php
  session_start();
  require_once("connection.php");
  //cheking if user is loged in
    if (isset($_SESSION["email"])) {
      $email = $_SESSION["email"];
      //accesing user db
        $user_query = "SELECT firstname, lastname, id FROM users WHERE users.email = '{$email}'";
        $user = fetch_record($user_query);
        $userId = $user["id"];
        echo "<p>You are loged in as: ".$user["firstname"]."!</p>";
      ?>

      <a href="logout.php">Logout</a>

      <div class="container">
          <h1 style="text-align: center;">Messages</h1>
          <div class="box">
              You got messages from:
          <?php
            // gettin firstname of persone who sended you a message
            $post_query = "SELECT messages.message, users.firstname, messages.created_at, messages.user_from
                                FROM messages
                                JOIN users
                                ON messages.user_from = users.id
                                WHERE messages.user_to = '$userId'
                                ORDER BY messages.id DESC";
               $_SESSION["messages"] = fetch_all($post_query);

               foreach($_SESSION["messages"] as $row) {

                ?>

              <ul>
                <li><a href="/messages.php?id=<?php echo $row['user_from']?>"><?php echo $row["firstname"]?></a></li> <!-- Where value is userID -->
              </ul>
                <?php } ?>
          </div>

          <div class="box">
              <h3>Write a message:</h3>
              <form method="post" action="post_message.php">
                <label for="user">Select user:</label>
                <select name='user' id="user">

                  <?php
                    // getting all registred users name
                   $firstname_query = "SELECT firstname, id
                                        FROM users";
                    $allUsers = fetch_all($firstname_query);
                    foreach($allUsers as $userto) {
                      $_SESSION["userto"] = $userto["id"];
                  ?>
                  <!-- making user option -->
                  <option value="<?php echo $userto["id"]?>"><?php  echo $userto["firstname"]?></option> <!-- Where value is userID -->

                <?php } ?>

                </select>
                <input type="hidden" name="id" value="<?php $_SESSION['userto']?>">


                <br>
                <label for="message">Message text:</label>
                <br>
                <textarea rows="9" cols="100" id="message" name="message"></textarea>
                <br>
                <input type="submit" name="submit" value="Submit">
              </form>
          </div>
      </div>
      <?php
    }  else {
      header("Location:index.php");
    }
?>
  </body>
</html>
