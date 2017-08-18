<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Private messaging app</title>
    <style>
      .container {
        display: -webkit-flex;
        display: flex;
        width: 800px;
        height: 600px;
        background-color: lightgrey;
        margin: 0 auto;
      }
      .container .box {
        width: 400px;
        height: 100px;
        padding: 20px;
      }
      .form input {
        width: 100%;
        margin-bottom: 10px;
        border-radius: 5px;
        border: 1px solid gray;
      }
    </style>
  </head>
  <body>
    <?php
    require_once("connection.php");
    session_start();
    ?>
      <div class="container">
          <div class="box">
              <h1 style="text-align: center">Login</h1>
              <form method="post" action="login.php" class="form">
                <label for="login_name">Email</label>
                <input id='login_name' type="text" name='email'>
                <label for="login_pass">Password</label>
                <input id='login_pass' type="password" name='password'>
                <input type="submit" name="submit" value="Login">
              </form>

              <?php
                if(isset($_SESSION['error'])) {
                  echo $_SESSION['error'];
                  unset($_SESSION['error']);
                }
                ?>
           </div>

            <div class="box">
              <h1 style="text-align: center">Register</h1>
              <form method="post" action="register.php" class="form">
                <label for="reg_name">First name</label>
                <input id='reg_name' type="text" name='name'>

                <label for="reg_sname">Last name</label>
                <input id='reg_sname' type="text" name='sname'>

                <label for="reg_email">Email</label>
                <input id='reg_email' type="text" name='email'>

                <label for="reg_pass">Password</label>
                <input id='reg_pass' type="password" name='password'>
                <label for="reg_pass1">Repeat Password</label>
                <input id='reg_pass1' type="password" name='password1'>

                <input type="submit" name="submit" value="Register">
              </form>
          <?php
            if(isset($_SESSION['error1'])) {
              echo $_SESSION['error1'];
              unset($_SESSION['error1']);
            }
          ?>
          </div>
      </div>
  </body>
</html>
