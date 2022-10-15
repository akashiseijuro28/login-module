<?php
include 'config.php';
error_reporting(0);
$errors = array();
if (isset($_POST['submit'])) {
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $email = $_POST['email'];
  $gender = $_POST['gender'];
  $city = $_POST['city'];
  $country = $_POST['country'];
  $username = $_POST['username'];
  $password = md5($_POST['password']);
  $cpassword = md5($_POST['cpassword']);
  if ($password == $cpassword) {
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    if (!$result->num_rows > 0) {
      $sql = "INSERT INTO users (firstname, lastname, email, gender, city, country, username, password )
					VALUES ('$firstname', '$lastname', '$email', '$gender', '$city', '$country', '$username', '$password')";
      $result = mysqli_query($conn, $sql);
      if ($result) {
        $errors['username'] = "Wow! User Registration Completed. You can now Log In";
        $username = "";
        $firstname = "";
        $lastname = "";
        $email = "";
        $gender = "";
        $city = "";
        $country = "";
        $_POST['password'] = "";
        $_POST['cpassword'] = "";
      } else {
        $errors1['username'] = "Woops! Something Wrong Went.";
      }
    } else {
      $errors1['username'] = "Woops! Username Already Exists.";
    }
  } else {
    $errors1['username'] = "Password Not Matched.";
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
  <title>Sign-Up Page </title>
</head>

<body>
  <div class="container">
    <form id="regForm" action=" " method="POST">
      <h3>Sign-Up Page</h3>
      <?php
      if (count($errors) > 0) {
      ?>
        <div class="success">
          <?php
          foreach ($errors as $showerror) {
            echo $showerror;
          }
          ?>
        </div> <br>
      <?php
      } else {
      ?>
        <div class="error">
          <?php
          foreach ($errors1 as $showerror) {
            echo $showerror;
          }
          ?>
        </div> <br>
      <?php
      }
      ?>
      <div class="name">
        <label for="firstname"><b>Firstname: </b></label>
        <input type="text" name="firstname" value="<?php echo $firstname; ?>" required><br>
        <label for="lastname"><b>Lastname: </b></label>
        <input type="text" name="lastname" value="<?php echo $lastname; ?>" required><br>
      </div>
      <label for="email"><b>Email: </b></label>
      <input type="email" name="email" value="<?php echo $email; ?>" required><br><br>
      <label for="gender"><b>Gender: </b></label>
      <input type="radio" name="gender" value="Male" value="<?php echo $gender; ?>">Male
      <input type="radio" name="gender" value="Female" value="<?php echo $gender; ?>">Female
      <input type="radio" name="gender" value="Other" value="<?php echo $gender; ?>">Other<br><br>
      <div class="location">
        <label for="city"><b>City: </b></label>
        <input type="text" name="city" value="<?php echo $city; ?>" required><br>
        <label for="country"><b>Country: </b></label>
        <input type="text" name="country" value="<?php echo $country; ?>" required>
      </div><br>
      <label for="username"><b>Username: </b></label>
      <input type="text" name="username" value="<?php echo $username; ?>" pattern="(?=.*\d)(?=.*[a-z])(?=.*?[0-9])(?=.*?[~`!@#$%\^&*()\-_=+[\]{};:\x27.,\x22\\|/?><]).{8,}" title="Username name must have atleast 8 character input combination alpha numerical and special characters e.g. enri30@#" required><br>
      <div class="pass">
        <label for="password"><b>Password: </b></label>
        <input type="password" name="password" id="myInput" value="<?php echo $_POST['password']; ?>" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Password must atleast 8 character input combination of alpha numerical no special character" required><br>
        <label for="cpassword"><b>Confirm Password: </b></label>
        <input type="password" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
      </div>
      <div class="buttons">
        <button type="submit" name="submit">Submit</button>
        <button type="reset">Reset</button>
      </div><br>
      <div class="bottom">
        <span class="signup">Already have an Account? <a href="index.php">Login here</a></span>
      </div>

  </div>
  </form>
</body>


</html>