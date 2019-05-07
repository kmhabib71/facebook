<?php
//upload.php
include '../load.php';
include '../../connect/login.php';

$userid =login::isLoggedIn();

if(isset($_POST['onlyStatusText'])){
$statusText = $_POST['onlyStatusText'];  

//$form_data = $loadFromUser->checkInput($_POST['form_data']);  


$loadFromUser->create('post', array('userId' => $userid,'post' => $statusText,'postBy' => $userid,'postedOn' => date('Y-m-d H:i:s')));
    
    
}

if(isset($_POST['stIm'])){
$stIm = $_POST['stIm'];  
$statusText =$_POST['statusText'];   

//$form_data = $loadFromUser->checkInput($_POST['form_data']);  


$loadFromUser->create('post', array('userId' => $userid,'post' => $statusText,'postBy' => $userid,'postImage' => $stIm,'postedOn' => date('Y-m-d H:i:s')));
    
   echo  $stIm;
}
?>
