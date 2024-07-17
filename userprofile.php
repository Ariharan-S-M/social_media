<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Document</title>
</head>
<body>
<?php 
  if(isset($_POST['name2'])){

    $queryDP = "SELECT * FROM users";
    $connection = mysqli_connect('localhost', 'root', '', 'social_media');

    if(isset($_POST['dp']))
    {
     $resultDP = mysqli_query($connection, $queryDP);
     $dp = $_POST['dp'];
     $username = $_POST['name2'];
     while($row = mysqli_fetch_assoc($resultDP))
     {
       if($_POST['name2'] == $row['username'])
       {
         $updateDP = "UPDATE users SET dp = '$dp' WHERE username = '$username'";
         $updateDP = mysqli_query($connection, $updateDP);
       }
     }
    }


   
   $resultDP = mysqli_query($connection, $queryDP);
   while($row = mysqli_fetch_assoc($resultDP))
   {
     if($_POST['name2'] == $row['username'])
     {
       if($row['dp'] == "")
       {
         $result = "soc_img/profile-1.jpg";
       }
       else{
         $result = $row['dp'];
       }
     }
   }
    ?>
    <div class="setprofile">
        <img src="<?php echo $result;?>" style="height: 200px; width: 200px; margin:50px 100px;">
        
        <form action="userprofile.php" method="post">
          <input type="text" style="display: none;" name="name2" value="<?php echo $_POST['name2']; ?>">
          <input type="text" style="display: none;" name="password2" value="<?php echo $_POST['password2']; ?>">
          Enter URL: <input type="text" name="dp">
          <input type="submit" name="submit" value="Update"
          style="height: 30px; width: 80px; font-size: 13px; position: absolute; margin: 40px -100px;">
    </form>
    </div>

    <form action="login.php" method="post" style="margin: -100px 15px; position: absolute;">
              <input type="text" style="display: none;" name="name2" value="<?php echo $_POST['name2']; ?>">
              <input type="text" style="display: none;" name="password2" value="<?php echo $_POST['password2']; ?>">
              <input type="text" style="display: none;" name="display" value="0">
              <input type="text" style="display: none;" name="anotherpage" value="0">
              <input type="submit" name="submit" value="Go Back"
              style="height: 40px; width: 100px; font-size: 15px; margin: -1px 350px; position: absolute;">
    </form>
    <?php
  }
    ?>
</body>
</html>