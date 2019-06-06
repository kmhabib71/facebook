<?php
include '../load.php';
include '../../connect/login.php';

$user_id =login::isLoggedIn();

if(isset($_POST['request'])){
 $profileid=$_POST['request'];
 $userid=$_POST['userid'];
    $loadFromUser->create('request', array('reqtReceiver' => $profileid, 'reqtSender' => $userid, 'reqStatus' => '0', 'requestOn' => date('Y-m-d H:i:s')));

     if($profileid != $userid){
   $loadFromUser->create('notification', array('notificationFrom' => $userid,'notificationFor' => $postId,'status' => '0','type' => 'request', 'notificationOn' => date('Y-m-d H:i:s')));
       }
}
if(isset($_POST['confirmRequest'])){
 $profileid=$_POST['confirmRequest'];
 $userid=$_POST['userid'];
    $loadFromPost->updateConfirmReq($profileid, $userid);
echo 'confirmRequest';
}
if(isset($_POST['cancelSentRequest'])){
 $cancelSentRequest=$_POST['cancelSentRequest'];
 $userid=$_POST['userid'];

$loadFromUser->delete('request', array('reqtReceiver' => $cancelSentRequest,'reqtSender' => $userid));
//     if($cancelSentRequest != $userID){
//    $loadFromUser->delete('notification', array('notificationFrom' => $userID,'notificationFor' => $postId,'type' => 'request'));
//       }

}
if(isset($_POST['unfriendRequest'])){
 $unfriendRequest=$_POST['unfriendRequest'];
 $userid=$_POST['userid'];

$loadFromUser->delete('request', array('reqtReceiver' => $unfriendRequest,'reqtSender' => $userid));
$loadFromUser->delete('request', array('reqtReceiver' => $userid,'reqtSender' => $unfriendRequest));

}


if(isset($_POST['follow'])){
 $follow=$_POST['follow'];
 $userid=$_POST['userid'];
    $loadFromUser->create('follow', array('sender' => $userid, 'receiver' => $follow, 'followOn' => date('Y-m-d H:i:s')));

}
if(isset($_POST['unfollow'])){
 $unfollow=$_POST['unfollow'];
 $userid=$_POST['userid'];

$loadFromUser->delete('follow', array('sender' => $unfollow,'receiver' => $userid));
$loadFromUser->delete('follow', array('sender' => $userid,'receiver' => $unfollow));

}
?>
