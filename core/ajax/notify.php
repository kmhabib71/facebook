<?php
include '../load.php';
include '../../connect/login.php';

$user_id =login::isLoggedIn();

if(isset($_POST['notify'])){
$userid = $_POST['notify'];

$loadFromPost->notificationReset($userid);
}

if(isset($_POST['notificationUpdate'])){
$userid = $_POST['notificationUpdate'];

$notification= $loadFromPost->notification($userid);
    echo count($notification);



}
