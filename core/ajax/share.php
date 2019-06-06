<?php
include '../load.php';
include '../../connect/login.php';

$user_id =login::isLoggedIn();

if(isset($_POST['shareText'])){
 $shareText=$_POST['shareText'];
 $postid=$_POST['postid'];
 $userid=$_POST['userid'];
 $profileid=$_POST['profileid'];

 $commentid = $loadFromUser->create('post', array('userId' => $userid, 'shareId' => $postid,'sharedFrom' => $profileid, 'sharedBy' => $userid,  'shareText' => $shareText,'postBy' => $profileid, 'postedOn' => date('Y-m-d H:i:s')));
    if($profileid != $userid){
   $loadFromUser->create('notification', array('notificationFrom' => $userid,'notificationFor' => $profileid, 'postid'=>$postid,'status' => '0','type' => 'request', 'notificationOn' => date('Y-m-d H:i:s')));
       }

}else{
    echo 'Not found';
}
if(isset($_POST['deletePost'])){
 $postid=$_POST['deletePost'];
 $userid=$_POST['userid'];
 $commentid=$_POST['commentid'];
 $replyid=$_POST['replyid'];
 $profileid=$_POST['profileid'];

$loadFromUser->delete('comments', array('commentID' => $replyid,'commentOn' => $postid,'commentBy' => $userid));
$loadFromUser->delete('react', array('reactReplyOn' => $replyid,'reactBy' => $userid,'reactOn' => $postid));
        if($profileid != $userid){
    $loadFromUser->delete('notification', array('notificationFrom' => $userid,'notificationFor' => $postid,'type' => 'request'));
       }



}



?>
