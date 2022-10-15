<?php
include 'config.php';
session_start();
error_reporting(0);
$errors = array();

if (isset($_SESSION['username'])) {
  header("Location: myaccount.php");
}

if (isset($_POST['username'])) {
  $username = $_POST['username'];
  $password = md5($_POST['password']);
  $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  $result = mysqli_query($conn, $sql);

  if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['username'] = $row['username'];
    header("Location: myaccount.php");
  } else {
    $errors['username'] = "Incorrect Username or Password";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap');
  </style>
  <title>Login Page</title>
</head>

<body>
  <div class="container">
    <form method="POST">
      <h3>Login Page</h3>
      <?php
      if (count($errors) > 0) {
      ?>
        <div class="error">
          <?php
          foreach ($errors as $showerror) {
            echo $showerror;
          }
          ?>
        </div><br>
      <?php
      }
      ?>
      <label for="username"><b>Username</b></label>
      <input type="text" name="username" required><br>
      <label for="password"><b>Password</b></label>
      <input type="password" name="password" required><br>
      <div class="buttons">
        <button name="submit">Login</button>
        <button type="reset">Reset</button>
      </div>
      <div class="bottom"><br>
        <span id="signup">Need an Account? <a href="signup.php">Sign Up here</a></span>
        <span><a href="#" id="fpsw">Forgot Password</a></span>
      </div>
  </div>
  </form>
</body>

</html>