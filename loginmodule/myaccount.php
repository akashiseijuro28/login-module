<?php
include 'config.php';
session_start();
$sql = "SELECT * FROM users where username = '" . $_SESSION['username'] . "'";
$result = $conn->query($sql);
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
  <title>My Account</title>
</head>

<body>
  <?php if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
  ?>
      <h3>Hello <?php echo "<span>" . ucfirst($row["username"]) . "</span>"; ?></h3>
  <?php
    }
  }
  ?>
  <a class="dropdown-item" href="logout.php">Sign out</a>
</body>

</html>