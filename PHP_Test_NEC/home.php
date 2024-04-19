<html>
<head>
  <title>Website Home Page</title>
  <link rel="stylesheet" href="CSS/style.css" type="text/css"> //adding stylesheet
</head>
<?php
session_start(); //starts the session
if($_SESSION['user']){ // checks if the user is logged in
}
else{
  header("location: index.php"); // redirects if user is not logged in
}
$user = $_SESSION['user']; //assigns user value
?>
<body>
  <div class="home-page">
    <h1>Home Page</h1>

    <h1>Welcome to home page after login</h1>
      <button class="logout">  <a href="logout.php">Click here to logout</a></button><br/><br/>
  </div>
</body>
</html>
