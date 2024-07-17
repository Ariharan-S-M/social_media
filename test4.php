<?php

function add($text1,$b){
    $connection = mysqli_connect('localhost', 'root', '', 'social_media');
    $sender_receiver = $_COOKIE["gfg3"];
    $none = "";
    $query1 = "UPDATE messages SET sent1 = '$none' WHERE sender_receiver = '$sender_receiver'";
    $result = mysqli_query($connection, $query1);
    $query2 = "UPDATE messages SET received = '$none' WHERE sender_receiver = '$sender_receiver'";
    $result2 = mysqli_query($connection, $query2);

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