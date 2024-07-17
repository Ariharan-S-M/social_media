<?php

function dp($username){
    $query = "SELECT * FROM users";
    $connection = mysqli_connect('localhost', 'root', '', 'social_media');
    $result = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($result))
    {
      if($username == $row['username'])
      {
        if($row['dp'] == "")
        {
          echo "soc_img/profile-1.jpg";
        }
        else{
          echo $row['dp'];
        }
      }
    }
}


?>