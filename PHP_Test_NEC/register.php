<html>
<head>
  <title>My first PHP Website</title>
  <link rel="stylesheet" href="CSS/style.css" type="text/css">
  <style>
  .error {
      color: red;
      margin-left: 7%;
      font-weight: 900;
  }
  </style>
</head>
<body>
  <div class="reg-heading">
    <h1>Registration Page</h1>

  <div class="back-index">  <a href="index.php">Click here to go back</a><br/><br/>
  </div>

  <div class="reg-form">

     <form action="register.php" id="registrationForm" method="post" enctype="multipart/form-data">
    <input type="text" name="username" id="username" placeholder="Username"><br>
    <span class="error" id="usernameError"></span><br>
    <input type="email" name="email" id="email" placeholder="Email"><br>
    <span class="error" id="emailError"></span><br>
    <input type="password" name="password" id="password" placeholder="Password"><br>
    <span class="error" id="passwordError"></span><br>
    <input type="file" name="profile_picture"><br>
    <span class="error" id="imageError"></span>
    <input type="submit" name="submit" value="Submit">

</form>
<script>
document.getElementById('registrationForm').addEventListener('submit', function(event) {


             // Sanitize input before submitting
             var usernameInput = document.getElementById('username');
             var emailInput = document.getElementById('email');
             var passwordInput = document.getElementById('password');

             usernameInput.value = sanitizeInput(usernameInput.value);
             emailInput.value = sanitizeInput(emailInput.value);
             emailInput.value = sanitizeInput(passwordInput.value);



        // Client-side validation using JavaScript

        var username = document.getElementById('username').value.trim();
        var email = document.getElementById('email').value.trim();
        var password = document.getElementById('password').value.trim();
        var usernameError = document.getElementById('usernameError');
        var emailError = document.getElementById('emailError');
        var passwordError = document.getElementById('passwordError');
        var isValid = true;

        usernameError.textContent = "";
        emailError.textContent = "";
        passwordError.textContent = "";

        if (username === "") {
            usernameError.textContent = "Username is required";
            isValid = false;
        }

        if (email === "") {
            emailError.textContent = "Email is required";
            isValid = false;
        } else if (!isValidEmail(email)) {
            emailError.textContent = "Invalid email format";
            isValid = false;
        }

        if (password === "") {
            passwordError.textContent = "Password is required";
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault();
        }
    });

    function sanitizeInput(input) {
        // Use regular expression to remove unwanted characters
        return input.replace(/[^a-zA-Z0-9@._-]/g, '');
}

    // Function to validate email format
    function isValidEmail(email) {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }


</script>

  <div>
  </div>
  </body>
  </html>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {



  require_once "db_connection.php";


    // Include database connection


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
