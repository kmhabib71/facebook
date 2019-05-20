<?php
include '../load.php';
include '../../connect/login.php';

$user_id =login::isLoggedIn();

if(isset($_POST['userid'])){
 $userid=$_POST['userid'];
 $postid=$_POST['postid'];
 $editedTextVal=$_POST['editedTextVal'];
 $commentid=$_POST['commentid'];
 $replyid=$_POST['replyid'];
$loadFromPost->replyUpd($userid, $postid, $editedTextVal,$commentid,$replyid);

    echo $editedTextVal;


}else{
    echo 'Not found';
}
if(isset($_POST['deletePost'])){
 $postid=$_POST['deletePost'];
 $userid=$_POST['userid'];
 $commentid=$_POST['commentid'];
 $replyid=$_POST['replyid'];

$loadFromUser->delete('comments', array('commentID' => $replyid,'commentOn' => $postid,'commentBy' => $userid));
$loadFromUser->delete('react', array('reactReplyOn' => $replyid,'reactBy' => $userid,'reactOn' => $postid));



}



?>
