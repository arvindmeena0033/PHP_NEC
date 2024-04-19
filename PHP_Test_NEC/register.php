<html>
<head>
  <title>My first PHP Website</title>
  <link rel="stylesheet" href="CSS/style.css" type="text/css"> //adding stylesheet
</head>
<body>
  <div class="reg-heading">
    <h1>Registration Page</h1>

  <div class="back-index">  <a href="index.php">Click here to go back</a><br/><br/>
  </div>
  <div class="reg-form">  <form action="register.php" method="post" enctype="multipart/form-data">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <input type="file" name="profile_picture"><br>
    <input type="submit" value="Register">
  </form>
  <div>
  </div>
  </body>
  </html>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection
    require_once "db_connection.php";

    // Gather user input
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // File upload
    $profile_picture = "";
    if ($_FILES["profile_picture"]["name"]) {
      $profile_picture = "uploads/" . basename($_FILES["profile_picture"]["name"]);
      move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $profile_picture);
    }

    // Insert user into database
    $sql = "INSERT INTO users (username, email, password, profile_picture) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $username, $email, $password, $profile_picture);
    $stmt->execute();
    $stmt->close();

    // Redirect to login page
    header("Location: login.php");
    exit();
  }
  ?>
