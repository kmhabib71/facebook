<?php

include '../load.php';
include '../../connect/login.php';

$userid =login::isLoggedIn();

if(isset($_POST['reactType'])){
$reactType = $_POST['reactType'];
$postId = $_POST['postId'];
$userID = $_POST['userId'];
$profileid = $_POST['profileid'];



// $reactExist=$loadFromUser->reactExistingCheck($postId, $userID);
// $rex = COUNT($reactExist);
 $loadFromUser->delete('react', array('reactBy' => $userID,'reactOn' => $postId,'reactCommentOn' => '0','reactReplyOn' => '0'));


//if($rex < 1 ){
   $loadFromUser->create('react', array('reactBy' => $userID,'reactOn' => $postId,'reactType' => $reactType, 'reactTimeOn' => date('Y-m-d H:i:s')));
    if($profileid != $userID){
    $loadFromUser->delete('notification', array('notificationFrom' => $userID,'notificationFor' => $profileid, 'postid'=>$postId,'type' => 'postReact'));
   $loadFromUser->create('notification', array('notificationFrom' => $userID,'notificationFor' => $profileid, 'postid'=>$postId,'status' => '0','type' => 'postReact', 'notificationOn' => date('Y-m-d H:i:s')));
        }

    $react_max_show = $loadFromPost->react_max_show($postId);
	$main_react_count = $loadFromPost->main_react_count($postId)

    ?>
    <div class="nf-3-react-icon">
        <div class="react-inst-img align-middle" style="">
            <?php
            foreach($react_max_show as $react_max){
                echo '<img class="'.$react_max->reactType.'-max-show" src="assets/images/react/'.$react_max->reactType.'.png" alt="" style="height:15px;width:15px;margin-right:2px;cursor:pointer;">';
                 } ?>
        </div>
    </div>
    <div class="nf-3-react-username">
        <?php if($main_react_count->maxreact == '0'){}else{echo $main_react_count->maxreact;} ?>
    </div>
    <?php
//      }
}

if(isset($_POST['deleteReactType'])){

$deleteReactType = $_POST['deleteReactType'];
$postId = $_POST['postId'];
$userID = $_POST['userId'];
$profileid = $_POST['profileid'];
$loadFromUser->delete('react', array('reactBy' => $userID,'reactOn' => $postId,'reactCommentOn' => '0','reactReplyOn' => '0'));
  if($profileid != $userID){
    $loadFromUser->delete('notification', array('notificationFrom' => $userID,'notificationFor' => $profileid, 'postid'=>$postId,'type' => 'postReact'));

        }
 $react_max_show = $loadFromPost->react_max_show($postId);
	$main_react_count = $loadFromPost->main_react_count($postId)

    ?>
        <div class="nf-3-react-icon">
            <div class="react-inst-img align-middle" style="">
                <?php
            foreach($react_max_show as $react_max){
                echo '<img class="'.$react_max->reactType.'-max-show" src="assets/images/react/'.$react_max->reactType.'.png" alt="" style="height:15px;width:15px;margin-right:2px;cursor:pointer;">';
                 } ?>
            </div>
        </div>
        <div class="nf-3-react-username">
            <?php if($main_react_count->maxreact == '0'){}else{echo $main_react_count->maxreact;} ?>
        </div>
        <?php


}






?>
