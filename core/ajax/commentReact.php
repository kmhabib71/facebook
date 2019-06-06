<?php


include '../load.php';
include '../../connect/login.php';

$userid =login::isLoggedIn();


if(isset($_POST['commentid'])){
$commentid = $_POST['commentid'];
$reactType = $_POST['reactType'];
$postId = $_POST['postId'];
$userID = $_POST['userId'];
$profileid = $_POST['profileid'];



// $reactExist=$loadFromUser->reactExistingCheck($postId, $userID);
// $rex = COUNT($reactExist);
 $loadFromUser->delete('react', array('reactBy' => $userID,'reactOn' => $postId,'reactCommentOn' => $commentid ));

//if($rex < 1 ){
   $loadFromUser->create('react', array('reactBy' => $userID,'reactOn' => $postId,'reactCommentOn' => $commentid,'reactType' => $reactType, 'reactTimeOn' => date('Y-m-d H:i:s')));

        if($profileid != $userID){
    $loadFromUser->delete('notification', array('notificationFrom' => $userID,'notificationFor' => $profileid, 'postid'=>$postId,'type' => 'commentReact'));
   $loadFromUser->create('notification', array('notificationFrom' => $userID,'notificationFor' => $profileid, 'postid'=>$postId,'status' => '0','type' => 'commentReact', 'notificationOn' => date('Y-m-d H:i:s')));
        }

    $com_react_max_show = $loadFromPost->com_react_max_show($postId,$commentid);
	$main_react_count = $loadFromPost->com_main_react_count($postId,$commentid);

 ?>
    <div class="com-nf-3 align-middle">
        <div class="nf-3-react-icon">
            <div class="react-inst-img align-middle" style="">

                <?php
            foreach($com_react_max_show as $react_max){
                echo '<img class="'.$react_max->reactType.'-max-show" id="'.$react_max->reactType.'" src="assets/images/react/'.$react_max->reactType.'.png" alt="" style="height:12px;width:12px;margin-right:2px;cursor:pointer;">';
                 } ?>
            </div>
        </div>
        <div class="nf-3-react-username" style="font-size:10px;">
            <?php if($main_react_count->maxreact == '0'){}else{echo $main_react_count->maxreact;} ?>
        </div>
    </div>




    <?php

}
if(isset($_POST['delcommentid'])){

$delcommentid = $_POST['delcommentid'];
$deleteReactType = $_POST['deleteReactType'];
$postId = $_POST['postId'];
$userID = $_POST['userId'];
$profileid = $_POST['profileid'];

$loadFromUser->delete('react', array('reactBy' => $userID,'reactOn' => $postId,'reactCommentOn' => $delcommentid));
if($profileid != $userID){
    $loadFromUser->delete('notification', array('notificationFrom' => $userID,'notificationFor' => $profileid, 'postid'=>$postId,'type' => 'commentReact'));
 }
 $react_max_show = $loadFromPost->com_react_max_show($postId,$delcommentid);
	$main_react_count = $loadFromPost->com_main_react_count($postId,$delcommentid);
    if($main_react_count->maxreact == '0'){}else{

    ?>
        <div class="com-nf-3 align-middle">
            <div class="nf-3-react-icon">
                <div class="react-inst-img align-middle" style="">
                    <?php
            foreach($react_max_show as $react_max){
                echo '<img class="'.$react_max->reactType.'-max-show" src="assets/images/react/'.$react_max->reactType.'.png" alt="" style="height:12px;width:12px;margin-right:2px;cursor:pointer;">';
                 } ?>
                </div>
            </div>
            <div class="nf-3-react-username">
                <?php if($main_react_count->maxreact == '0'){}else{echo $main_react_count->maxreact;} ?>
            </div>
        </div>
        <?php
    }

}



?>
