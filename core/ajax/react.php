<?php

include '../load.php';
include '../../connect/login.php';

$userid =login::isLoggedIn();

if(isset($_POST['reactType'])){
$reactType = $_POST['reactType'];  
$postId = $_POST['postId'];  
$userID = $_POST['userId'];  


    
 $reactExist=$loadFromUser->reactExistingCheck( $postId, $userID); 
 $rex = COUNT($reactExist);
 $loadFromUser->delete('react', array('reactBy' => $userID,'reactOn' => $postId));
      
if($sl < 1 ){ 
   $loadFromUser->create('react', array('reactBy' => $userID,'reactOn' => $postId,'reactType' => $reactType, 'reactTimeOn' => date('Y-m-d H:i:s'))); 
    
      } 
    
}

if(isset($_POST['deleteReactType'])){
    
$deleteReactType = $_POST['deleteReactType'];  
$postId = $_POST['postId'];  
$userID = $_POST['userId'];  

$loadFromUser->delete('react', array('reactBy' => $userID,'reactOn' => $postId));
    
//    echo 'item deleted';
}



?>
