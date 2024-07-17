<!DOCTYPE html>
<html>

<head>
  <title>WEBAPP</title>
  <link rel="stylesheet" href="frontpage_class.css">
</head>

<body>

  <?php
  if (isset($_POST['submit'])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $gender = $_POST["gender"];
    $dob = $_POST["age"];
    $phone = $_POST["phone"];

    $connection = mysqli_connect("localhost", "root", "", "social_media");
    //for sql injection attacks

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);
    $gender = mysqli_real_escape_string($connection, $gender);
    $email = mysqli_real_escape_string($connection, $email);

    //against sql injection attack
    $hashFormat = "$2y$10$";
    $salt = "iusesomecrazystrings22";
    $hash_and_salt = $hashFormat . $salt;
    $password = crypt($password, $hash_and_salt);

    $query = "INSERT INTO users(username, password, gmail, gender, dob, phone) VALUES('$username', '$password', '$email', '$gender', '$dob', $phone)";
    $result = mysqli_query($connection, $query);

    if ($username != "" || $password != "" || $email != "" || $gender != "" || $dob != "" || $phone != "") {
  ?>
      <div class="success">
        <h2>Congratulations You have been successfully created an account</h2>
        <a href="index.html">
          <button class="button2">Go to login page</button>
        </a>
      </div>
    <?php
    } else {
    ?>
      <div class="failed">
        <h2>No details should be empty, please try again</h2>
        <a href="signup.html">
          <button class="button2">Go to signup page</button>
        </a>
      </div>
  <?php
    }
  }

  ?>
</body>

</html>