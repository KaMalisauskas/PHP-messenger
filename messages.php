<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Private messaging app</title>
    <style>
      .container {

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
      ul {
        list-style: none;
      }
    </style>
  </head>
  <body>
      <div class="container">
          <h1 style="text-align: center;">Messages from <span style="color: red">Test Test</span></h1>
          <div class="box">

            <?php
              session_start();
              require_once("connection.php");

                $email = $_SESSION["email"];
                $id_qry = "SELECT id, firstname FROM users WHERE email = '{$email}' ORDER BY id DESC";
                $user = fetch_record($id_qry);
                $userId = intval($user["id"]);

                  $toId = $_GET["id"];
                  $_SESSION["ID"] = $_GET["id"];
                  echo $toId;
                  echo $userId;
                  $from_query = "SELECT messages.message, users.firstname, messages.created_at, messages.user_from
                                      FROM messages
                                      JOIN users
                                      ON messages.user_from = users.id
                                      WHERE messages.user_from = '$toId' and messages.user_to = '$userId'
                                      ORDER BY messages.created_at desc";
                  $from = fetch_all($from_query);

                  $to_query = "SELECT messages.message, users.firstname, messages.created_at, messages.user_from
                                      FROM messages
                                      JOIN users
                                      ON messages.user_from = users.id
                                      WHERE messages.user_from = '$userId' and messages.user_to = '$toId'
                                      ORDER BY messages.created_at desc";
                  $to = fetch_all($to_query);

                  //merging two queries into one
                  $merged_query = array_merge($to, $from);
                //  sorting multi-layer array
                  function cmp($a, $b)
                    {
                        return strcmp($a["created_at"], $b["created_at"]);
                    }
                    usort($merged_query, "cmp");

             ?>
             <ul>
               <?php
                foreach ($merged_query as $tmessage ) {
                ?>
                  <li>
                    <b>
                      <?php
                      if ($user["firstname"] == $tmessage["firstname"]) {
                        echo "You:";
                      } else {
                        echo $tmessage["firstname"];}
                        ?>
                      </b> <?php echo $tmessage["message"] ?> <span style="float: right"> <?php echo $tmessage["created_at"] ?></span>
                  </li>
                  <?php }
                  ?>
              </ul>
          </div>

          <div class="box">
              <h3>Reply:</h3>
              <form method="post" action="post_message.php">
                <input type="hidden" name="user" value="<?php echo $toId?>">
                <label for="message">Message text:</label>
                <br>
                <textarea rows="9" cols="100" id="message" name="message"></textarea>
                <br>
                <input type="submit" name="replay" value="Submit">
              </form>
          </div>

       </div>
      <a href="main.php">Main</a>
  </body>
</html>
