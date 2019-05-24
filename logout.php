<?php

include 'connect/login.php';
include 'core/load.php';


$showTimeline=False;
if(login::isLoggedIn()){
     $userid =login::isLoggedIn();

     $showTimeline=True;

}else{
    header('Location: sign.php');
}
$loadFromUser->delete('token', array('user_id'=>$userid));
if (isset($_COOKIE['FBID'])) {
    unset($_COOKIE['FBID']);
    unset($_COOKIE['FBID_']);
header("Refresh:0");
}



?>
