<?php 
include '../load.php';
include '../../connect/login.php';

$userid =login::isLoggedIn();

if(isset($_POST['imgName'])){
$imgName = $loadFromUser->checkInput($_POST['imgName']);  
$user_id = $loadFromUser->checkInput($_POST['userid']);  
//$form_data = $loadFromUser->checkInput($_POST['form_data']);  


$loadFromUser->update('profile', $user_id, array('profilePic' => $imgName));  
    
//$loadFromUser->uploadImage($form_data);  
    
//  echo $imgName;  
};
 if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
$path_directory = $_SERVER['DOCUMENT_ROOT']."/facebook/user/".$userid.'/profilePhoto/';
       
//if (!file_exists($path_to_directory) && !is_dir($path_to_directory)) {
//    mkdir($path_to_directory, 0777, true);
        
//if (!is_dir('path_directory')) {
//    @mkdir('path_directory');
//}
//        $path_to_directory = 'path/to/directory';
if (!file_exists($path_directory) && !is_dir($path_directory)) {
    mkdir($path_directory, 0777, true);
}
//         echo $path_directory;
//}
            move_uploaded_file($_FILES['file']['tmp_name'], $path_directory.$_FILES['file']['name']);

    }
echo 'user/'.$userid.'/profilePhoto/'.$_FILES['file']['name'];
//
//if(isset($_POST["userid"])){
//    echo $_POST["userid"];
//    echo $_POST["form_data"];
//    echo 'hello found';
//} 
//
// echo 'hello found';
//if(isset($_POST) && !empty($_POST)){ echo $_POST['form_data']; }
?>
