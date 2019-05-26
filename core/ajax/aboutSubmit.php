<?php
include '../load.php';
include '../../connect/login.php';

$user_id =login::isLoggedIn();
if(isset($_POST['submitType'])){
    $submitType = $_POST['submitType'];
    $inputVal = $_POST['inputVal'];
    $userid = $_POST['userid'];
    $profileid = $_POST['profileid'];

    $loadFromUser->update('profile', $userid, array($submitType => $inputVal));
    echo $inputVal;



}
if(isset($_POST['dataFetch'])){
    $userid = $_POST['dataFetch'];

  $loadFromUser->userdata($userid);

?>





    <?php




}

?>
