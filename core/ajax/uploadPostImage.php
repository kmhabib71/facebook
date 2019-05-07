<?php
//upload.php
include '../load.php';
include '../../connect/login.php';

$userid =login::isLoggedIn();
//if(isset($_POST['get_ad_cat']) ){die('we got it');}else{
//    die('No fai');
//}
if(count($_FILES["file"]["name"]) > 0)
{

 sleep(3);
 for($count=0; $count<count($_FILES["file"]["name"]); $count++)
 {
  $file_name = $_FILES["file"]["name"][$count];
  $tmp_name = $_FILES["file"]['tmp_name'][$count];
  $file_array = explode(".", $file_name);
  $file_extension = end($file_array);

$path_directory = $_SERVER['DOCUMENT_ROOT']."/facebook/user/".$userid.'/postImage/';
       

if (!file_exists($path_directory) && !is_dir($path_directory)) {
    mkdir($path_directory, 0777, true);
}


            move_uploaded_file($_FILES['file']['tmp_name'][$count], $path_directory.$_FILES["file"]["name"][$count]);

    }
//echo 'user/'.$userid.'/profilePhoto/'.$_FILES['file']['name'];

 }
    echo 'Image uploaded';



?>
