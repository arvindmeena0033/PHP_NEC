<html>
<head>
  <title>Login Page</title>
    <link rel="stylesheet" href="CSS/style.css" type="text/css"> 
</head>
<body>
  <div class="login-heading">
    <h1>Login Page</h1>

    <div class="back-index">  <a href="index.php">Click here to go back</a><br/><br/>
    </div>
    <div class="login-form">  <form action="login.php" method="post">
      <input type="text" name="username" placeholder="Username" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <input type="submit" value="Login">
    </form>
  </div>
</div>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Include database connection
  require_once "db_connection.php";

  // Gather user input
  $username = $_POST["username"];
  $password = $_POST["password"];
  $bool = true;
  // Check if user exists
  $sql = "SELECT * FROM users WHERE username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();

  if ($user && password_verify($password, $user["password"])) {
    // Start session and store user data
    session_start();
    $_SESSION['user'] = $username;

    // Redirect to dashboard or profile page
    header("Location: home.php");
    exit();
  } else {
    // Redirect back to login page with error message
    header("Location: login.php?error=invalid_credentials");
    exit();
  }
}
?>
