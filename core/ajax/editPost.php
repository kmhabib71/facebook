<?php
include '../load.php';
include '../../connect/login.php';

$user_id =login::isLoggedIn();

if(isset($_POST['userid'])){
 $userid=$_POST['userid'];
 $postid=$_POST['postid'];
 $editedTextVal=$_POST['editedTextVal'];
$loadFromPost->postUpd($userid, $postid, $editedTextVal);

    echo $editedTextVal;


}
if(isset($_POST['deletePost'])){
 $postid=$_POST['deletePost'];
 $userid=$_POST['userid'];

$loadFromUser->delete('post', array('post_id' => $postid,'userId' => $userid));
$loadFromUser->delete('comments', array('commentOn' => $postid,'commentBy' => $userid));
$loadFromUser->delete('react', array('reactBy' => $userid,'reactOn' => $postid));



}



?>
