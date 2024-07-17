<!DOCTYPE html><!-- 354, 57, 58, 154, 169, 170, 514, 553 -->

<head>
  <title>TrendxForU</title>
  <link rel="stylesheet" href="index.css">
  <link rel="stylesheet" href="frontpage_class.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>


<?php
include('functions.php');
if(isset($_POST['con_submit']))
{
  $username = $_POST['use'];
  $password = $_POST['pas'];
  ?><h1 style="display: none;" id="username"><?php echo $username;?></h1><h1 style="display: none;" id="password"><?php echo $password;?></h1><?php
  $connection = mysqli_connect('localhost', 'root', '', 'social_media');
  $query1 = "SELECT * FROM users";
  $result1 = mysqli_query($connection, $query1);
  $friend_exist = 0;
  $duplicate = 0;
  while ($row = mysqli_fetch_assoc($result1)) {
    if ($row['username'] == $username) {
      $all_friends = $row['friends'];
    }
    if($row['username'] == $_POST['fri'])
    {
      $friend_exist++;
    }
  }
  $array_friends = explode(" ", $all_friends);
  $friend_count = 0;
  for($i=0; $i<count($array_friends); $i++)
  {
    if($_POST['fri'] == $array_friends[$i])
    {
      $friend_count++;
    }
  }

  if($friend_count == 0 && $friend_exist == 1){
    $friend = $all_friends . $_POST['fri'] . " ";
    $friend2 = $_POST['fri'];
    $query4 = "SELECT * FROM users";
    $result4 = mysqli_query($connection, $query4);
    while($row = mysqli_fetch_assoc($result4))
    {
      if($row['username'] == $friend2)
      {
        $friend2list = $row['friends'];
      }
    }
    $oppfriend = $friend2list . $username . " ";
    $query3 = "UPDATE users SET friends = '$oppfriend' WHERE username = '$friend2'";
    $result3 = mysqli_query($connection, $query3);
    $sender_receiver = $username . "**" .$friend2;
    $receiver_sender = $friend2 . "**" .$username;
    $queryM1 = "INSERT INTO messages(sender_receiver) VALUES('$sender_receiver')";
    $queryM2 = "INSERT INTO messages(sender_receiver) VALUES('$receiver_sender')";
    $resultM1 = mysqli_query($connection, $queryM1);
    if($sender_receiver != $receiver_sender)
    $resultM2 = mysqli_query($connection, $queryM2);

    ?><div class="warning" id="warning">
        <h1>Friend Added</h1>
        <form action="login.php" method="post" style="background-image: url('<?php dp($_POST['fri'])?>');
     background-size: cover; height: 300px; width: 400px">
  
              <input type="text" style="display: none;" name="name2" value="<?php echo $username; ?>">
              <input type="text" style="display: none;" name="password2" value="<?php echo $password; ?>">
              <input type="text" style="display: none;" name="display" value="0">
              <input type="submit" name="submit" value="Go Back"
              style="height: 40px; width: 100px; font-size: 15px; position: absolute; margin-left: -10%; margin-top: 45px;">
        </form>
      </div><?php
  }
  else if($friend_count != 0){
    ?><div class="warning" id="warning" style="background-image: url('<?php dp($_POST['fri'])?>');
     background-size: cover; height: 300px; width: 400px">
        <h1>Friend Already Added</h1>
        <form action="login.php" method="post">
  
              <input type="text" style="display: none;" name="name2" value="<?php echo $username; ?>">
              <input type="text" style="display: none;" name="password2" value="<?php echo $password; ?>">
              <input type="text" style="display: none;" name="display" value="0">
              <input type="submit" name="submit" value="Go Back"
              style="height: 40px; width: 100px; font-size: 15px; position: absolute; margin: 145px -40px;">
        </form>
      </div><?php
    $friend = $all_friends;
  }
  else if($friend_exist == 0)
  {
    ?><div class="warning" id="warning">
        <h1>Username Does Not Exist</h1>
        <form action="login.php" method="post">

              <input type="text" style="display: none;" name="name2" value="<?php echo $username; ?>">
              <input type="text" style="display: none;" name="password2" value="<?php echo $password; ?>">
              <input type="text" style="display: none;" name="display" value="0">
              <input type="submit" name="submit" value="Go Back"
              style="height: 40px; width: 100px; font-size: 15px; position: absolute; margin: 145px -40px;">
        </form>
      </div><?php
    $friend = $all_friends;
  }

  ?><h1 style="display: none;" id="username"><?php echo $username;?></h1><h1 style="display: none;" id="password"><?php echo $password;?></h1><?php
  if($username != $_POST['fri']){
  $query2 = "UPDATE users SET friends = '$friend' WHERE username = '$username'";
  $result2 = mysqli_query($connection, $query2);
  }
  $querylast = "SELECT * FROM users";
  $resultlast = mysqli_query($connection, $querylast);
  while($row = mysqli_fetch_assoc($resultlast))
  {
    if($row['username'] == $username)
    {
      $all_friends = $row['friends'];
    }
  }
  $array_friends = explode(" ", $all_friends);
  
  ?>
    <div class="confirm_friend" style="display: none;" id="confirm_friend">
      <form action="login.php" method="post">
        <div style="display: none;">
        <input type="text" name="use" id="use">
        <input type="text" name="pas" id="pas">
        <input type="text" name="fri" id="fri">
        </div>
        <input type="submit" class="confirm_button" name="con_submit" id="con_submit">
      </form>
    </div>
    
     
      
  <?php //ends here-------------------------------------------------------------------------------------------------------------------------
}

if (isset($_POST['submit'])) {
  $username = $_POST['name2'];
  $password = $_POST['password2'];
  $connection = mysqli_connect('localhost', 'root', '', 'social_media');
  ?><h1 style="display: none;" id="username"><?php echo $username;?></h1><h1 style="display: none;" id="password"><?php echo $password;?></h1><?php
  //decrypt
  $hashFormat = "$2y$10$";
  $salt = "iusesomecrazystrings22";
  $hash_and_salt = $hashFormat . $salt;
  $display = "0";
  if(isset($_POST['redirect']))
  {
    $sender_receiver = $_POST['name2'] . "**" . $_POST['friendname'];
    if($_POST['redirect'] == "redirect")
    {
      $queryDelete = "UPDATE messages SET sent1='' WHERE sender_receiver = '$sender_receiver'";
      $resultDelete = mysqli_query($connection, $queryDelete);
      $queryDelete = "UPDATE messages SET received ='' WHERE sender_receiver = '$sender_receiver'";
      $resultDelete = mysqli_query($connection, $queryDelete);
    }
  }
  if(isset($_POST['friendname']))
  {

    $friendname = $_POST['friendname'];
    $queryM = "SELECT * FROM messages";
    $resultM = mysqli_query($connection, $queryM);
    $sender_receiver = $username . "**" . $friendname;
    $receiver_sender = $friendname . "**" . $username;


    $name = "SomeName";
    $value = $sender_receiver;
    $expiration = time() + (60*60*24*7);
    setcookie($name, $value, $expiration);


    while($row = mysqli_fetch_assoc($resultM))
    {
      if($row['sender_receiver'] == $sender_receiver)
      {
        $sent = $row['sent1'];
        $received = $row['received'];
      }
    }
    $display = $_POST['display'];
    if(isset($_POST['sent_message']) && $_POST['sent_message'] != "")
    {
      $sent_message = $sent . $_POST['sent_message'] . "blueout86400" . $_POST['time'] . "blueout86400";
      $sent_message = mysqli_real_escape_string($connection, $sent_message);
      $querySM = "UPDATE messages SET sent1 = '$sent_message' WHERE sender_receiver = '$sender_receiver'";//work here ----------------------
      $resultSM = mysqli_query($connection, $querySM);
      $queryRM = "UPDATE messages SET received = '$sent_message' WHERE sender_receiver = '$receiver_sender'";
      $resultSM = mysqli_query($connection, $queryRM);
      
    }
  }
  else if(isset($_POST['anotherpage']))
  {
    $p = 1;
  }
  else{
    $password = crypt($password, $hash_and_salt);
  }
  
  $query = "SELECT * FROM users";
  $result = mysqli_query($connection, $query);

  $count = 0;
  while ($row = mysqli_fetch_assoc($result)) {
    if ($row['username'] == $username && $row['password'] == $password) {
      $count = 1;
    }
  }

  if ($count == 1) {
    $result2 = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($result2)) {
      if ($row['username'] == $username) {
        $all_friends = $row['friends'];
      }
    }
    $array_friends = explode(" ", $all_friends);
    $result3 = mysqli_query($connection, $query);
    $all_users = array();
    while($row = mysqli_fetch_assoc($result3))
    {
      $all_users[] = $row['username'];
    }

    ?>
    <body>
    <p id="all_users" style="display: none;"><?php
       
       echo $all_users_string;
  ?></p>
  <!-- background friend image --------------------------------------------------------------------------------------------------------------->
    <div class="confirm_friend" style="display: none; background-size: cover;" id="confirm_friend">
      <form action="login.php" method="post">
        <div style="display: none;">
        <input type="text" name="use" id="use">
        <input type="text" name="pas" id="pas">
        <input type="text" name="fri" id="fri">
        </div>
        <input type="submit" class="confirm_button" name="con_submit" id="con_submit">
      </form>
    </div>
<!-- TOP ---------------------------------------------------------------------------------------------------------------------------------->
 <div class="top">
  <ul style="text-align: center; margin-top: 1%">
    <div style="display: inline;" id="youtube"><li style="display: inline; padding: 65px;" >Watch Youtube</li></div>
    <div style="display: inline;" id="songs"><li style="display: inline; padding: 65px;" >Listen Songs</li></div>
    <div style="display: inline;" id="games"><li style="display: inline; padding: 65px;" >Play Games</li></div>
    <div style="display: inline;" id="about"><li style="display: inline; padding: 65px;">About Us</li></div>
    <div style="display: inline;" id="customize"><li style="display: inline; padding: 65px;" >Customize</li></div>
    <div style="display: inline;" id="signout"><li style="display: inline; padding: 65px;">Sign out</li></div>
  </ul>
 </div>
<!-- LEFT --------------------------------------------------------------------------------------------------------------------------------->
 <div class="left" id="left">
  
 </div>

 <!-- All Others -------------------------------------------------------------------------------------------------------------------------->

 <!-- About us----------------------------------------------------------------------------------------------------------------------------->
 <div class="others" id="aboutUs" style="display: none;">
    <input type="text" style="position: absolute; margin: 20px 280px;" id="input">
    <button style="position: absolute; margin: 15px 500px; width: 70px; height: 30px;" onclick="about()">Submit</button>
    
     
    <button onclick = "aboutback()" style="margin: 600px 360px; height: 40px; width: 100px; position: absolute;">Go Back</button>
  </div>
 <!-- Youtube -------------------------------------------------------------------------------------------------------------------------->
  <div class="others" id="youtube2" style="display: none;">
    <input type="text" style="position: absolute; margin: 20px 280px;" id="input">
    <button style="position: absolute; margin: 15px 500px; width: 70px; height: 30px;" onclick="playvideo()">Submit</button>
    <iframe width="720" height="495" id="video" src="" style="margin: 70px 50px; position: absolute;"> </iframe>
     
    <button onclick = "youtubeback()" style="margin: 600px 360px; height: 40px; width: 100px; position: absolute;">Go Back</button>
  </div>
<!-- PROFILE ------------------------------------------------------------------------------------------------------------------------------>
    
    <div style="height: 400px; width: 400px; float: left; background-color: rgb(220, 105, 71); margin: 200px 200px;" id="profile">
    <h1 style="margin: 10px 150px; position: absolute">Profile</h1>
      <img src="<?php //function from functions.php -----------------------------------------------------------
                  dp($username);
      ?>" style="height: 200px; width: 200px; position: absolute; margin: 50px 100px;">
      <div style="text-align: center; margin-top: 280px; font-size: 30px;">
        <p><?php echo $username;?></p>
      </div>
      <br>
      <form action="userprofile.php" method="post">
      <input type="text" style="display: none;" name="name2" value="<?php echo $username ?>">
      <input type="text" style="display: none;" name="password2" value="<?php echo $password; ?>">
      <input type="submit" style="margin: 20px 150px; width: 100px; position: absolute;" value="Update Profile">
      </form>
    </div>









    <div class="view_group" style="background-image: url('soc_img/bg-1.jpg'); 
    background-size: cover; border-image: url('soc_img/border-1.png') 27 / 12px 12px 12px 12px / 12px 12px 12px 12px
    round;">
      Your Friends
      <br><br>
       <!-- work here -------------------------- -->

  <input list="browsers" name="add_friend" id="add_friend">
  <datalist id="browsers">
    <?php 
      for($i=0; $i<count($all_users); $i++)
      {
        ?><option value="<?php echo $all_users[$i]; ?>"><?php
      }
    ?>
  </datalist>
      <input type="submit" class="button2" name="submit2" value="Add Friends" onclick="add_friend()">

      <br>
      <div class="all_friends" id="all_friends" style="display: <?php if($display == "0"){echo "block";}else{echo "none";}?>">
        <?php 
          for($i=0; $i<count($array_friends)-1; $i++)
          {
            ?>
            <form action="login.php" method="post">
              <input type="text" style="display: none;" name="friendname" value="<?php echo $array_friends[$i]?>">
              <input type="text" style="display: none;" name="name2" value="<?php echo $username; ?>">
              <input type="text" style="display: none;" name="password2" value="<?php echo $password; ?>">
              <input type="text" style="display: none;" name="display" value="1">
              <input type="submit" class="all_friends_button" name="submit" value="<?php echo $array_friends[$i]?>">
              <div style="background-image: url('<?php dp($array_friends[$i])?>'); 
              background-size: cover; position: absolute; margin: -37px 0px; height: 37px; width: 50px;"></div>
              <br><br><br></form><?php
          }
        ?>
      </div>

      <div class="input_person" id="input_person" style="display: <?php if($display == "0"){echo "none";}else{echo "block";}?>">
        <h1 id="testing">You</h1><br>
        <div style="height: 70%; width: 100%; background-color: aliceblue; overflow-y: scroll;" id="sended1">
        <?php 
          $get_sent_message_query = "SELECT * FROM messages";
          $get_sent_message_result = mysqli_query($connection, $get_sent_message_query);
          while($row = mysqli_fetch_assoc($get_sent_message_result))
          {
            if($row['sender_receiver'] == $username . "**" . $friendname)
            {
              $array = array();
              $array = explode("blueout86400", $row['sent1']);
              ?><p><?php for($i=0; $i<count($array); $i++)
              {
                if($i%2 == 0)
                {
                  echo $array[$i] . "<br><br>";
                } 
              }?></p><?php
            }
          }
         
        ?>
        </div>

              <input type="text" style="display: none;" name="friendname" id="friend3" value="<?php echo $friendname?>">
              <input type="text" style="display: none;" name="name2" id="username3" value="<?php echo $username; ?>">
              <input type="text" style="display: none;" name="password2" value="<?php echo $password; ?>">
              <input type="text" style="display: none;" name="display" value="1">
              <input type="text" style="display: none;" name="time" id="time">
              <input type="text" style="display: none;" name="redirect" id="redirect">
              <input type="text" style="margin-top: 4px; width: 300px; position: absolute;" id="sent_message"><br><br>
              <button style="height: 30px; width: 80px; font-size: 10px; float: right; position: absolute;" onclick="sendMessage()">Send</button>
       
      
      
              <input type="text" style="display: none;" name="friendname" value="<?php echo $array_friends[$i]?>">
              <input type="text" style="display: none;" name="name2" value="<?php echo $username; ?>">
              <input type="text" style="display: none;" name="password2" value="<?php echo $password; ?>">
              <input type="text" style="display: none;" name="display" value="0">
              >
              <button style="height: 40px; width: 100px; font-size: 15px; position: absolute;
               margin-right: 400px; margin-top: 65px;" onclick="GoBack()">Go Back</button>
    
   <!-- DELETE CHAT ------------------------------------------------------------------------------------------------------------------------>
    
              <input type="text" style="display: none;" name="friendname" value="<?php echo $friendname?>">
              <input type="text" style="display: none;" name="name2" value="<?php echo $username ?>">
              <input type="text" style="display: none;" name="password2" value="<?php echo $password; ?>">
              <input type="text" style="display: none;" name="display" value="1">
              <input type="text" style="display: none;" name="redirect" id="redirect" value="redirect"><br><br>
              <button  style="position: absolute; float: right;
               margin-left:410px; height: 40px; width:100px; margin-top: -40px;" onclick="Deletechat()">Delete Chat</button>
   
      </div>

<!-- output person ------------------------------------------------------------------------------------->
      <div class="output_person" id="output_person" style="display: <?php if($display == "0"){echo "none";}else{echo "block";}?>">
        <h1 id="ooo"><?php echo $friendname;?></h1>
        
      <br>
        <div style="height: 70%; width: 100%; background-color: aliceblue; overflow-y: scroll;">
         <div class="received" id="received"></div>
        </div>
        
    </div>
    
  </div>

    
  </body>
  <?php
  } 
  else {
  ?>
    <div class="failed">
      <h2>Your username or password is incorrect, please try again</h2>
      <a href="index.html">
        <button class="button2">Go to login page</button>
      </a>
    </div>
<?php
  }
}

?>
<script>
  
  var profile = document.getElementById('profile');
  var youtube = document.getElementById('youtube');
  var youtube2 = document.getElementById('youtube2');
  youtube.addEventListener('click', function(){
    console.log("clicked");
    youtube2.style.display = "block";
    profile.style.display = "none";
    
  });

  function youtubeback(){
    youtube2.style.display = "none";
    profile.style.display = "block";
    document.getElementById('video').src = "";
  }

  function playvideo(){
    var input = document.getElementById('input').value;
    var string = input.split("watch?v=");
    var final = string[string.length-1].split("&ab_channel");
    var gin = "https://www.youtube.com/embed/" + final[0];
    document.getElementById('video').src = gin;
  }

  function add_friend(){

    var add_friend = document.getElementById('add_friend').value;
    var username = document.getElementById('username').innerHTML;
    var password = document.getElementById('password').innerHTML;
    var friend = document.getElementById('add_friend').value;
    document.getElementById('use').value = username;
    document.getElementById('pas').value = password;
    document.getElementById('fri').value = friend;
    document.getElementById('confirm_friend').style.display = "block";
  }
 

  const d = new Date();
   let text = d.toString();
   var array = text.split(" ");
   final = "";
   for(var i=0; i<5; i++)
   {
      final = final + array[i] + " ";
   }
   document.getElementById("time").value = final;


   function loadUsersOnline(){
      $.get("test1.php?", function(data){
      var newstring = data.replace(/blueout/g, '<br><br>');
      document.getElementById('received').innerHTML = newstring;
      console.log("received success:  " + newstring);
      });
    }
      setInterval(function(){
        loadUsersOnline();
      }, 500);


    function sendMessage(){
      var message = document.getElementById('sent_message').value;
      //creating cookie -----------------------------------------------------------------------------
      function createCookie(name, value, days) {
        let expires;

        if (days) {
          let date = new Date();
          date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
          expires = "; expires=" + date.toGMTString();
        }
        else {
          expires = "";
        }

        document.cookie = escape(name) + "=" +
        escape(value) + expires + "; path=/";
      }
      var username = document.getElementById('username3').value;
      var friend = document.getElementById('friend3').value;
      var sender_receiver = username + "**" + friend;
      createCookie("gfg1", message, "10");
      createCookie("gfg2", sender_receiver, "10");
      jQuery.ajax({
        type: "POST",
        url: 'test3.php',
        dataType: 'json',
        data: {functionname: 'add', arguments: [1, 2]},

        success: function (obj, textstatus) {
          yourVariable = obj.result;
          console.log(yourVariable);
          console.log('yes');
          }
     });
    document.getElementById('sent_message').value = "";
    var sended = document.getElementById('sended1');
    sended.innerHTML = sended.innerHTML + message + "<br><br>";
    }

    function Deletechat(){
      document.getElementById('sended1').innerHTML = "";
      function createCookie(name, value, days) {
        let expires;

        if (days) {
          let date = new Date();
          date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
          expires = "; expires=" + date.toGMTString();
        }
        else {
          expires = "";
        }

        document.cookie = escape(name) + "=" +
        escape(value) + expires + "; path=/";
      }
      var username = document.getElementById('username3').value;
      var friend = document.getElementById('friend3').value;
      var sender_receiver = username + "**" + friend;

      createCookie("gfg3", sender_receiver, "10");
      jQuery.ajax({
        type: "POST",
        url: 'test4.php',
        dataType: 'json',
        data: {functionname: 'add', arguments: [1, 2]},

        success: function (obj, textstatus) {
          yourVariable = obj.result;
          console.log(yourVariable);
          console.log('yes');
          }
     });
    }


    function GoBack(){
      document.getElementById('input_person').style.display = "none";
      document.getElementById('output_person').style.display = "none";
      document.getElementById('all_friends').style.display = "block";
    }
</script>
  
</body>