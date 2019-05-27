<?php
include '../load.php';
include '../../connect/login.php';

$user_id =login::isLoggedIn();
if(isset($_POST['userid'])){
$user_id = $_POST['userid'];
$profileid = $_POST['profileid'];
    $userdata = $loadFromUser->userdata($profileid);
    $friendsdata = $loadFromPost->friendsdata($profileid);
    $followersdata = $loadFromPost->followersdata($profileid);
    $requestData = $loadFromPost->requestData($user_id);
    $friendWithUser = $loadFromPost->friendsdata($user_id);

?>

    <div class="about-wrap">
        <div class="about-header">
            <div class="about-icon"><img src="assets/images/profile/about.JPG" alt=""></div>
            <div class="about-text">About</div>
        </div>
        <div class="about-main">
            <div class="about-menu">
                <ul>
                    <li class="overview" data-userid="<?php echo $user_id; ?>" data-profileid="<?php echo $profileid; ?>"><span class="activeAbout" data-userid="<?php echo $user_id; ?>" data-profileid="<?php echo $profileid; ?>">Overview</span></li>
                    <li class="work-education" data-userid="<?php echo $user_id; ?>" data-profileid="<?php echo $profileid; ?>"><span class="">Work and Education</span></li>
                    <li class="places-lived" data-userid="<?php echo $user_id; ?>" data-profileid="<?php echo $profileid; ?>"><span class="">Places You've Lived</span></li>
                    <li class="contact-basic" data-userid="<?php echo $user_id; ?>" data-profileid="<?php echo $profileid; ?>"><span class="">Contact and Basic Info</span></li>
                    <li class="family-relation" data-userid="<?php echo $user_id; ?>" data-profileid="<?php echo $profileid; ?>"><span class="">Family and Relationships</span></li>
                    <li class="details-you" data-userid="<?php echo $user_id; ?>" data-profileid="<?php echo $profileid; ?>"><span class="">Details About You</span></li>
                    <li class="life-events" data-userid="<?php echo $user_id; ?>" data-profileid="<?php echo $profileid; ?>"><span class="">Life Events</span></li>
                </ul>
            </div>
            <div class="about-menu-details">

                <div class="overview-wrap" style="flex-basis:70%;">
                    <div class="overview-left">
                        <div class="about-work-heading">WORK</div>
                        <div class="about-border"></div>
                        <?php echo ($user_id !== $profileid) ? '<span class="about-success" style="">'.$userdata->workplace.'</span><br><br>' : (($userdata->workplace == '') ? '<div class="add-workplace align-middle" data-userid="'.$user_id.'" data-profileid="'.$profileid.'" style="margin: 0 0 20px 0;"><div class="plus-square">+</div><div class="add-workplace-text" style="font-size:15px;">Add a workplace</div></div>' : '<div class="add-workplace align-middle" data-userid="'.$user_id.'" data-profileid="'.$profileid.'" style="margin: 0 0 20px 0;"><span class="about-success" style="">'.$userdata->workplace.'</span></div><br>') ?>
                        <div class="about-work-heading">SCHOOL</div>
                        <div class="about-border"></div>
                        <?php echo ($user_id !== $profileid) ? '<span class="about-success" style="">'.$userdata->highSchool.'</span><br><br>' : (($userdata->highSchool == '') ? '<div class="add-highSchool align-middle" data-userid="'.$user_id.'" data-profileid="'.$profileid.'" style="margin: 0 0 20px 0;"><div class="plus-square">+</div><div class="add-highSchool-text" style="font-size:15px;">Add a highSchool</div></div>' : '<div class="add-highSchool align-middle" data-userid="'.$user_id.'" data-profileid="'.$profileid.'" style="margin: 0 0 20px 0;"><span class="about-success" style="">'.$userdata->highSchool.'</span></div><br>') ?>
                        <div class="about-work-heading">PLACE</div>
                        <div class="about-border"></div>
                        <?php echo ($user_id !== $profileid) ? '<span class="about-success" style="">'.$userdata->address.'</span><br>' : (($userdata->address == '') ? '<div class="add-address align-middle" data-userid="'.$user_id.'" data-profileid="'.$profileid.'" style="margin: 0 0 20px 0;"><div class="contact-plus" style="margin-right:10px;">+</div><div class="contact-add-address-text" style="font-size:13px;">Add your address</div></div><br>' : '<div class="add-address align-middle" data-userid="'.$user_id.'" data-profileid="'.$profileid.'" style="margin: 0 0 20px 0;"><span class="about-success" style="">'.$userdata->address.'</span></div><br>') ?>
                        <div class="about-work-heading">RELATIONSHIP</div>
                        <div class="about-border"></div>
                        <?php echo ($user_id !== $profileid) ? '<span class="about-success" style="">'.$userdata->relationship.'</span><br><br>' : (($userdata->relationship == '') ? '<div class="add-relationship align-middle" data-userid="'.$user_id.'" data-profileid="'.$profileid.'" style="margin: 0 0 20px 0;"><div class="plus-square">+</div><div class="add-relationship-text" style="font-size:15px;">Add a relationship</div></div>' : '<div class="add-relationship align-middle" data-userid="'.$user_id.'" data-profileid="'.$profileid.'" style="margin: 0 0 20px 0;"><span class="about-success" style="">'.$userdata->relationship.'</span></div><br>') ?>
                    </div>
                    <div class="overview-right" style="flex-basis:30%;">
                        <a href="setting.php" class="overview-right">
                            <div class="overview-mobile align-middle" style="margin-bottom:10px;">
                                <div class="overview-mobile-icon align-middle"><img src="assets/images/profile/overview%20mobile.JPG" alt="" style="margin-right:5px;"></div>
                                <div class="overview-mobile-number">01815-667719</div>
                            </div>
                            <div class="overview-birthday align-middle">
                                <div class="overview-mobile-icon align-middle"> <img src="assets/images/profile/overview%20birthday.JPG" alt="" style="margin-right:5px;"></div>
                                <div class="overview-mobile-number">29th January 1990</div>
                            </div>
                        </a>
                    </div>
                </div>


            </div>



        </div>
        <div class="friend-follower-wrap" style="margin-top:10px;">
            <div class="friend-request-wrapp " style="background-color: #f5f6f7;box-shadow: 0 0 1px grey;">
                <div class="about-top-wrap" style="display:flex; justify-content: space-between;align-items:center;">
                    <div class="about-header">
                        <div class="about-icon"><img src="assets/images/profile/friends.JPG" alt=""></div>
                        <div class="about-text">Friends</div>
                    </div>
                    <?php if($user_id != $profileid){}else{ ?>
                    <div class="request-count align-middle" style="font-size:12px;padding: 3px;border:1px solid gray;margin-right:10px;">

                        <div class="request-count-text">Friend Request </div>
                        <div class="request-count-number" style="padding:2px;color:white;background-color:red;margin-left:3px;">
                            <?php echo $requestData->reqCount; ?>
                        </div>

                    </div>
                    <?php } ?>
                </div>
                <div class="friend-follow-tab" style="display:flex; margin-left:15px; font-size:12px;padding-bottom: 5px;">
                    <div class="friend-tab" style="color: #32518e;font-weight:600;margin-right:10px; cursor:pointer;">All Friends (
                        <?php echo count($friendsdata) ?>)
                    </div>
                    <div class="follow-tab" style="color: #32518e;font-weight:600;cursor:pointer;">Followers(
                        <?php echo count($followersdata) ?>)</div>
                </div>
            </div>

            <div class="friend-follower-wrap">
                <div class="about-main" style="flex-wrap: wrap;">
                    <div class="friend-tab-open about-main" style="flex-wrap: wrap;margin-top:15px;">
                        <?php

    if(empty($friendsdata)){}else{
        foreach($friendsdata as $friend){
    $requestCheck = $loadFromPost->requestCheck($user_id, $friend->userId);
$requestConf = $loadFromPost->requestConf($friend->userId, $user_id);?>
                            <div class="friends-box" style="width:350px;margin-bottom:15px;display: flex;justify-content: space-between;align-items: center;box-shadow:0 0 2px gray;border-radius:2px; margin-left:15px;">
                                <a href="<?php echo BASE_URL.$friend->userLink ?>">
                                    <div class="friend-img-name align-middle">

                                        <div class="friend-img">
                                            <img src="<?php echo $friend->profilePic; ?>" alt="" style="height:100px;width:100px;border:0.5px solid gray;">
                                        </div>

                                        <div class="friend-name" style="margin-left:5px;color: #32518e;font-size:14px;">
                                            <?php echo ''.$friend->firstName.' '.$friend->lastName.''?>
                                        </div>


                                    </div>
                                </a>
                                <div class="profile-action " style="margin-top:0;">
                                    <?php

                                if($user_id === $friend->userId){
                                }else{
                                    if(empty($requestCheck)){

                                            if(empty($requestConf)){
                                                ?>
                                        <div class="profile-add-friend" data-userid="<?php echo $user_id; ?>" data-profileid="<?php  echo $friend->user_id; ?>">
                                            <img src="assets/images/friendRequestGray.JPG" alt="">
                                            <div class="edit-profile-button-text">Add Friend</div>
                                        </div>
                                        <?php
                                            }elseif($requestConf->reqStatus == '0'){
                                    ?>
                                            <div class="profile-friend-confirm" data-userid="<?php echo $user_id; ?>" data-profileid="<?php  echo $friend->userId; ?>">

                                                <div class="edit-profile-confirm-button" style="position:relative;">
                                                    <div class="con-req accept-req align-middle" data-userid="<?php echo $user_id; ?>" data-profileid="<?php  echo $friend->userId; ?>"><img src="assets/images/friendRequestGray.JPG" alt="">Confirm Request</div>
                                                    <div class="request-cancel" style="" data-userid="<?php echo $user_id; ?>" data-profileid="<?php  echo $friend->userId; ?>">Cancel Request</div>

                                                </div>

                                            </div>

                                            <?php

                                            }elseif($requestConf->reqStatus == '1'){
                                                ?>
                                                <div class="profile-friend-confirm" data-userid="<?php echo $user_id; ?>" data-profileid="<?php  echo $friend->userId; ?>">

                                                    <div class="edit-profile-confirm-button" style="position:relative;">
                                                        <div class="con-req align-middle"><img src="assets/images/rightsignGray.JPG" alt="">Friend</div>
                                                        <div class="request-unfriend" style="" data-userid="<?php echo $user_id; ?>" data-profileid="<?php  echo $friend->userId; ?>">Unfriend</div>

                                                    </div>

                                                </div>

                                                <?php
                                            }else{}
                                        ?>

                                                    <?php
                                    }elseif ($requestCheck->reqStatus == '0'){
                                        ?>
                                                        <div class="profile-friend-sent" data-userid="<?php echo $user_id; ?>" data-profileid="<?php  echo $friend->userId; ?>">
                                                            <img src="assets/images/friendRequestGray.JPG" alt="">
                                                            <div class="edit-profile-button-text">Friend Request Sent</div>
                                                        </div>


                                                        <?php
                                    }elseif($requestCheck->reqStatus == '1'){
                                                        ?>
                                                            <div class="profile-friend-confirm" data-userid="<?php echo $user_id; ?>" data-profileid="<?php  echo $friend->userId; ?>">

                                                                <div class="edit-profile-confirm-button" style="position:relative;">
                                                                    <div class="con-req align-middle"><img src="assets/images/rightsignGray.JPG" alt="">Friend</div>
                                                                    <div class="request-unfriend" style="" data-userid="<?php echo $user_id; ?>" data-profileid="<?php  echo $friend->userId; ?>">Unfriend</div>

                                                                </div>

                                                            </div>
                                                            <?php
                                    }else{echo 'Not found';}

                                    ?>








                                                                <?php

                                } ?>
                                </div>
                            </div>


                            <?php


        }
    }

    ?>
                    </div>
                    <div class="follower-tab-open about-main" style="display:none;flex-wrap: wrap;margin-top:15px;">
                        <?php
                   if(empty($followersdata)){}else{
        foreach($followersdata as $follower){
    $requestCheck = $loadFromPost->requestCheck($user_id, $follower->userId);
$requestConf = $loadFromPost->requestConf($follower->userId, $user_id);?>
                            <div class="friends-box" style="width:350px;margin-bottom:15px;display: flex;justify-content: space-between;align-items: center;box-shadow:0 0 2px gray;border-radius:2px; margin-left:15px;">
                                <a href="<?php echo BASE_URL.$follower->userLink ?>">
                                    <div class="friend-img-name align-middle">

                                        <div class="friend-img">
                                            <img src="<?php echo $follower->profilePic; ?>" alt="" style="height:100px;width:100px;border:0.5px solid gray;">
                                        </div>

                                        <div class="friend-name" style="margin-left:5px;color: #32518e;font-size:14px;">
                                            <?php echo ''.$follower->firstName.' '.$follower->lastName.''?>
                                        </div>


                                    </div>
                                </a>
                                <div class="profile-action " style="margin-top:0;">
                                    <?php

                                if($user_id === $follower->userId){
                                }else{
                                    if(empty($requestCheck)){

                                            if(empty($requestConf)){
                                                ?>
                                        <div class="profile-add-friend" data-userid="<?php echo $user_id; ?>" data-profileid="<?php  echo $follower->user_id; ?>">
                                            <img src="assets/images/friendRequestGray.JPG" alt="">
                                            <div class="edit-profile-button-text">Add Friend</div>
                                        </div>
                                        <?php
                                            }elseif($requestConf->reqStatus == '0'){
                                    ?>
                                            <div class="profile-friend-confirm" data-userid="<?php echo $user_id; ?>" data-profileid="<?php  echo $follower->userId; ?>">

                                                <div class="edit-profile-confirm-button" style="position:relative;">
                                                    <div class="con-req accept-req align-middle" data-userid="<?php echo $user_id; ?>" data-profileid="<?php  echo $follower->userId; ?>"><img src="assets/images/friendRequestGray.JPG" alt="">Confirm Request</div>
                                                    <div class="request-cancel" style="" data-userid="<?php echo $user_id; ?>" data-profileid="<?php  echo $follower->userId; ?>">Cancel Request</div>

                                                </div>

                                            </div>

                                            <?php

                                            }elseif($requestConf->reqStatus == '1'){
                                                ?>
                                                <div class="profile-friend-confirm" data-userid="<?php echo $user_id; ?>" data-profileid="<?php  echo $follower->userId; ?>">

                                                    <div class="edit-profile-confirm-button" style="position:relative;">
                                                        <div class="con-req align-middle"><img src="assets/images/rightsignGray.JPG" alt="">Friend</div>
                                                        <div class="request-unfriend" style="" data-userid="<?php echo $user_id; ?>" data-profileid="<?php  echo $follower->userId; ?>">Unfriend</div>

                                                    </div>

                                                </div>

                                                <?php
                                            }else{}
                                        ?>

                                                    <?php
                                    }elseif ($requestCheck->reqStatus == '0'){
                                        ?>
                                                        <div class="profile-friend-sent" data-userid="<?php echo $user_id; ?>" data-profileid="<?php  echo $follower->userId; ?>">
                                                            <img src="assets/images/friendRequestGray.JPG" alt="">
                                                            <div class="edit-profile-button-text">Friend Request Sent</div>
                                                        </div>


                                                        <?php
                                    }elseif($requestCheck->reqStatus == '1'){
                                                        ?>
                                                            <div class="profile-friend-confirm" data-userid="<?php echo $user_id; ?>" data-profileid="<?php  echo $follower->userId; ?>">

                                                                <div class="edit-profile-confirm-button" style="position:relative;">
                                                                    <div class="con-req align-middle"><img src="assets/images/rightsignGray.JPG" alt="">Friend</div>
                                                                    <div class="request-unfriend" style="" data-userid="<?php echo $user_id; ?>" data-profileid="<?php  echo $follower->userId; ?>">Unfriend</div>

                                                                </div>

                                                            </div>
                                                            <?php
                                    }else{echo 'Not found';}

                                    ?>
                                                                <?php

                                } ?>
                                </div>
                            </div>


                            <?php


        }
    }
    ?>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php

                           }              ?>
