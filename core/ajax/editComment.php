<?php
include '../load.php';
include '../../connect/login.php';

$user_id =login::isLoggedIn();

if(isset($_POST['userid'])){
 $userid=$_POST['userid'];
 $postid=$_POST['postid'];
 $editedTextVal=$_POST['editedTextVal'];
 $commentid=$_POST['commentid'];
$loadFromPost->commentUpd($userid, $postid, $editedTextVal,$commentid);

    echo $editedTextVal;


}else{
    echo 'Not found';
}
if(isset($_POST['deletePost'])){
 $postid=$_POST['deletePost'];
 $userid=$_POST['userid'];
 $commentid=$_POST['commentid'];

$loadFromUser->delete('comments', array('commentID' => $commentid,'commentOn' => $postid,'commentBy' => $userid));
$loadFromUser->delete('comments', array('commentOn' => $postid,'commentReplyID' => $commentid, 'commentBy' => $userid));
$loadFromUser->delete('react', array('reactCommentOn' => $commentid,'reactBy' => $userid,'reactOn' => $postid));
$loadFromUser->delete('react', array('reactReplyOn' => $commentid,'reactBy' => $userid,'reactOn' => $postid));



}



?>
