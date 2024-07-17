<?php

if(isset($_COOKIE["SomeName"])){
  $so = $_COOKIE["SomeName"];
}
else{
  $so = "nooooo";
}

$get_sent_message_query = "SELECT * FROM messages";
$connection = mysqli_connect('localhost', 'root', '', 'social_media');
$get_sent_message_result = mysqli_query($connection, $get_sent_message_query);
$string = "";
$array = array();
while($row = mysqli_fetch_assoc($get_sent_message_result))
{
  if($row['sender_receiver'] == $so)
  {
    
    $array = explode("blueout86400", $row['received']);
    for($i=0; $i<count($array); $i++)
    {
      if($i%2 == 0)
      {
        $array[$i] = $array[$i] . "blueout";
      } 
    }
  }
}
for($i=0; $i<count($array); $i++)
{
  if($i%2 == 0)
  {
    $string.=$array[$i];
  }
}

echo $string;


function what($string){
  echo ($string);
}



?>


