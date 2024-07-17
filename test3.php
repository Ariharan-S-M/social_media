<?php

function add($text1,$b){
    $connection = mysqli_connect('localhost', 'root', '', 'social_media');
    $message = $_COOKIE["gfg1"];
    $sender_receiver = $_COOKIE["gfg2"];
    $array = explode("**", $sender_receiver);
    $receiver_sender = $array[1] . "**" . $array[0];
    $text = date("Y/m/d&h:i:sa");
    $prequery = "SELECT * FROM messages";
    $preresult = mysqli_query($connection, $prequery);
    while($row = mysqli_fetch_assoc($preresult))
    {
      if($row['sender_receiver'] == $sender_receiver)
      {
        $pretext = $row['sent1'];
      }
    }
    $final = $pretext . $message . "blueout86400" . $text . "blueout86400";
    $query1 = "UPDATE messages SET sent1 = '$final' WHERE sender_receiver = '$sender_receiver'";
    $result = mysqli_query($connection, $query1);
    $query2 = "UPDATE messages SET received = '$final' WHERE sender_receiver = '$receiver_sender'";

    $result = mysqli_query($connection, $query2);

  }

  add(1, 2);
 

  
  function divide($a,$b){
    $c=$a/$b;
    return $c;
  }
    header('Content-Type: application/json');

    $aResult = array();

    if( !isset($_POST['functionname']) ) { $aResult['error'] = 'No function name!'; }

    if( !isset($_POST['arguments']) ) { $aResult['error'] = 'No function arguments!'; }

    if( !isset($aResult['error']) ) {

        switch($_POST['functionname']) {
            case 'delete':
               if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 2) ) {
                   $aResult['error'] = 'Error in arguments!';
               }
               else {
                   $aResult['result'] = add(floatval($_POST['arguments'][0]), floatval($_POST['arguments'][1]));
               }
               break;

            default:
               $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
               break;
        }

    }

    echo json_encode($aResult);



?>