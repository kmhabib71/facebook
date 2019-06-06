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

if(isset($_GET['postid']) == true && empty($_GET['postid']) === false){
    $postid = $_GET['postid'];
    $profileid = $_GET['profileid'];
    $profileId = $profileid;
$user_id = $userid;

    $username = $loadFromUser->checkInput($_GET['username']);

$profileId = $loadFromUser->userIdByUsername($username);

$profileData = $loadFromUser->userData($profileId);
$userData = $loadFromUser->userData($userid);

$requestCheck = $loadFromPost->requestCheck($userid,$profileId);
$requestConf = $loadFromPost->requestConf($profileId,$userid);
$followCheck = $loadFromPost->followCheck($profileId,$userid);
$notification= $loadFromPost->notification($userid);
//$username = $loadFromUser->checkInput($_GET['username']);
//
//$profileId = $loadFromUser->userIdByUsername($username);
//
//$profileData = $loadFromUser->userData($profileId);
//$userData = $loadFromUser->userData($userid);
//
//$requestCheck = $loadFromPost->requestCheck($userid,$profileId);
//$requestConf = $loadFromPost->requestConf($profileId,$userid);
//$followCheck = $loadFromPost->followCheck($profileId,$userid);
//$notification= $loadFromPost->notification($userid);
//
    $post = $loadFromPost->postDetails($postid);

			$main_react = $loadFromPost->main_react($user_id, $post->post_id);
			$react_max_show = $loadFromPost->react_max_show($post->post_id);
			$main_react_count = $loadFromPost->main_react_count($post->post_id);
            $commentDetails=$loadFromPost->CommentFetch($post->post_id);
            $totalCommentCount=$loadFromPost->totalCommentCount($post->post_id);
            $totalShareCount=$loadFromPost->totalShareCount($post->post_id);
            if(empty($post->shareId)){

            }else{
                $shareDetails=$loadFromPost->shareFetch($post->shareId,$post->postBy);

            }

			?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!--        <meta charset="UTF-8">-->
        <meta http-equiv="Content-type" content="text/html; charset=utf8mb4">
        <title>facebook</title>
        <link rel="stylesheet" href="assets/dist/emojionearea.min.css">

        <link rel="stylesheet" href="assets/css/style.css">
        <style>
            .request-count {
                position: absolute;
                margin-top: -10px;
                margin-left: 9px;
                background-color: red;
                color: white;
                height: 20px;
                width: 20px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .message-count {
                position: absolute;
                margin-top: -10px;
                margin-left: 9px;
                background-color: red;
                color: white;
                height: 20px;
                width: 20px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .notification-count {
                position: absolute;
                margin-top: -10px;
                margin-left: 9px;
                background-color: red;
                color: white;
                height: 20px;
                width: 20px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .notification-list-wrap {
                position: absolute;
                background-color: white;
                color: black;
                top: 31px;
                z-index: 9;
                box-shadow: 2px 2px 5px grey;
            }

            .item-notification {
                display: flex;
                justify-content: space-evenly;
                align-items: center;
                width: 320px;
                background-color: #9E9E9E;
                color: white;
                padding: 5px;
                margin-bottom: 5px;
            }

            .item-notification:hover {
                display: flex;
                justify-content: space-evenly;
                align-items: center;
                width: 320px;
                background-color: #6f6f6f;
                color: white;
                padding: 5px;
                margin-bottom: 5px;
            }

        </style>
    </head>

    <body>
        <!--   ////////.........start header tob bar................//////-->
        <header>
            <div class="top_bar">
                <div class="top_left_part">
                    <div class="logo"><img src="assets/images/logo.jpg" alt=""></div>
                    <div class="search-wrap">
                        <div class="search-input" style="display:flex;justify-content:center;align-item:center;">
                            <input type="text" name="main-search" id="main-search" style="border-right:white;border-top-right-radius:0; border-bottom-right-radius:0;">
                            <div class=" top-css top-icon s-icon">
                                <img src="assets/images/icons8-search-36.png" alt="">
                            </div>
                        </div>
                        <div class="search-icon">

                        </div>
                        <div id="search-show" style="position:relative;">
                            <div class="search-result" style="position:absolute;z-index:9;">

                            </div>

                        </div>
                    </div>
                </div>
                <div class="top_right_part">
                    <div class="top-pic-name-wrap">
                        <a href="profile.php?username=<?php echo $userData->userLink; ?>" class="top-pic-name">
                            <div class="top-pic"><img src="<?php echo $userData->profilePic; ?>" alt=""></div>
                            <div class="top-name top-css">
                                <?php echo $userData->first_name; ?> </div>
                        </a>
                    </div>
                    <a href="index.php">
                        <div class="top-home top-css border-left">
                            Home
                        </div>
                    </a>
                    <a href="create.php">
                        <div class="top-create top-css border-left"> Create</div>
                    </a>
                    <div class="top-request top-css top-icon border-left" style="position:relative;">
                        <div class="request-count">49</div>
                        <img src="assets/images/request.png" alt="">
                    </div>
                    <a href="messenger.php">

                        <div class="top-messanger top-css top-icon " style="position:relative;">
                            <div class="message-count">2</div>
                            <img src="assets/images/messanger.png" alt="">

                        </div>
                    </a>
                    <div class="top-notification top-css top-icon" style="position:relative;">
                        <?php  if(empty($notification)){}else{echo '<div class="notification-count">'.count($notification).'</div>'; }  ?>

                        <img src="assets/images/Notification.png" alt="">
                        <div class="notification-list-wrap" style="position:absolute;display:none;">
                            <ul>
                                <?php  if(empty($notification)){}else{

                                foreach($notification as $notify){

                                ?>
                                <li class="item-notification" data-postid="<?php echo $notify->post_id; ?>" data-profileid="<?php echo $notify->userId; ?>">
                                    <a href="post.php?username=<?php echo $notify->userLink; ?>&postid=<?php echo $notify->postid; ?>&profileid=<?php echo $notify->userId; ?>" class="item-notification">
                                    <img src="<?php echo $notify->profilePic; ?>" style="width:40px; height:40px; border-radius:50%;" alt="">
                                    <div class="notification-type-details">
                                        <span style="font-weight: 600;font-size: 14px;color: #CDDC39;"><?php echo  ''.$notify->firstName.' '.$notify->lastName.' '; ?></span> <span><?php
                                       echo ($notify->type ==  'comment') ? 'commented on your <span>post</span>' : (($notify->type == 'postReact') ? 'reacted on your <span>post</span>' : 'reacted on your <span>comment</span>') ;?></span>
                                    </div>
                                    </a>
                                </li>
                                <?php }  } ?>


                            </ul>
                        </div>
                    </div>
                    <div class="top-help top-css top-icon border-left">
                        <img src="assets/images/help.png" alt="">
                    </div>
                    <div class="top-more top-css top-icon">
                        <div class="watchmore-wrap" style="position: absolute;">
                            <img src="assets/images/watchmore.png" alt="" style="">
                        </div>
                        <div class="setting-logout-wrap" style="position:relative;margin-left:-45px;margin-top: 20px;display:none;">
                            <div class="s-l-wrap" style="position:absolute;background-color:white; color:gray;padding:10px 10px;box-shadow:0 0 5px gray; border-radius:2px;">
                                <div class="setting-option" style="padding:10px;">Setting</div>
                                <div class="logout-option" style="padding:10px;">Logout</div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!--   ////////.........end header tob bar................//////-->


        <!--   ////////.........start main area................//////-->
        <main>
            <div class="main-area">
                <!--      ///////////..........start profile cover and photo section...........//////////-->

                <div class="profile-left-wrap">

                    <div class="profile-cover-wrap" style="display:none;background-image: url(<?php echo $profileData->coverPic; ?>);">
                        <div class="upload-cov-opt-wrap">

                            <?php if($profileId == $userid){ ?>
                            <div class="add-cover-photo">
                                <img src="assets/images/profile/uploadCoverPhoto.JPG" alt="">
                                <div class="add-cover-text">Add a cover photo</div>

                            </div>

                            <?php  }else{ ?>
                            <div class="dont-add-cover-photo">
                            </div>


                            <?php } ?>
                            <div class="add-cov-opt">
                                <div class="select-cover-photo">Select Photo</div>
                                <div class="file-upload">
                                    <label for="cover-upload" class="file-upload__label">Upload Photo</label>
                                    <input id="cover-upload" class="file-upload__input" type="file" name="file-upload">
                                </div>

                            </div>


                        </div>
                        <div class="cover-photo-rest-wrap">
                            <div class="profile-pic-name">
                                <div class="profile-pic">
                                    <?php if($profileId == $userid){ ?>
                                    <div class="profile-pic-upload">
                                        <div class="add-pro">
                                            <img src="assets/images/profile/uploadCoverPhoto.JPG" alt="">
                                            <div>Update</div>
                                        </div>
                                    </div>
                                    <?php   } ?>
                                    <img src="<?php echo $profileData->profilePic; ?>" alt="" class="profile-pic-me">

                                </div>

                                <div class="profile-name">
                                    <?php echo ''.$profileData->first_name.' '.$profileData->last_name.'';  ?>
                                </div>
                            </div>
                            <!-- ///////// ...........Request, Follow, Messenger Start...........///////////-->
                            <div class="profile-action">
                                <?php
                                if($userid == $profileId){
                                ?>
                                    <div class="profile-edit-button" data-userid="<?php echo $userid; ?>" data-profileid="<?php  echo $profileId; ?>">
                                        <img src="assets/images/profile/editProfile.JPG" alt="">
                                        <div class="edit-profile-button-text" data-userid="<?php echo $userid; ?>" data-profileid="<?php  echo $profileId; ?>">Edit Profile</div>
                                    </div>
                                    <!--
                                    <div class="profile-activity-button">
                                        <img src="assets/images/profile/activityLog.JPG" alt="">
                                        <div class="profile-activity-button-text">Edit Profile</div>
                                    </div>
                                    <div class="dot-wrap">
                                        <div class="profile-activity-button-dot"> ... </div>
                                    </div>
-->
                                    <?php }else{
                                    if(empty($requestCheck)){

                                            if(empty($requestConf)){
                                                ?>
                                    <div class="profile-add-friend" data-userid="<?php echo $userid; ?>" data-profileid="<?php  echo $profileId; ?>">
                                        <img src="assets/images/friendRequestGray.JPG" alt="">
                                        <div class="edit-profile-button-text">Add Friend</div>
                                    </div>
                                    <?php
                                            }elseif($requestConf->reqStatus == '0'){
                                    ?>
                                        <div class="profile-friend-confirm" data-userid="<?php echo $userid; ?>" data-profileid="<?php  echo $profileId; ?>">

                                            <div class="edit-profile-confirm-button" style="position:relative;">
                                                <div class="con-req accept-req align-middle" data-userid="<?php echo $userid; ?>" data-profileid="<?php  echo $profileId; ?>"><img src="assets/images/friendRequestGray.JPG" alt="">Confirm Request</div>
                                                <div class="request-cancel" style="" data-userid="<?php echo $userid; ?>" data-profileid="<?php  echo $profileId; ?>">Cancel Request</div>

                                            </div>

                                        </div>

                                        <?php

                                            }elseif($requestConf->reqStatus == '1'){
                                                ?>
                                            <div class="profile-friend-confirm" data-userid="<?php echo $userid; ?>" data-profileid="<?php  echo $profileId; ?>">

                                                <div class="edit-profile-confirm-button" style="position:relative;">
                                                    <div class="con-req align-middle"><img src="assets/images/rightsignGray.JPG" alt="">Friend</div>
                                                    <div class="request-unfriend" style="" data-userid="<?php echo $userid; ?>" data-profileid="<?php  echo $profileId; ?>">Unfriend</div>

                                                </div>

                                            </div>

                                            <?php
                                            }else{}
                                        ?>

                                                <?php
                                    }elseif ($requestCheck->reqStatus == '0'){
                                        ?>
                                                    <div class="profile-friend-sent" data-userid="<?php echo $userid; ?>" data-profileid="<?php  echo $profileId; ?>">
                                                        <img src="assets/images/friendRequestGray.JPG" alt="">
                                                        <div class="edit-profile-button-text">Friend Request Sent</div>
                                                    </div>


                                                    <?php
                                    }elseif($requestCheck->reqStatus == '1'){
                                                        ?>
                                                        <div class="profile-friend-confirm" data-userid="<?php echo $userid; ?>" data-profileid="<?php  echo $profileId; ?>">

                                                            <div class="edit-profile-confirm-button" style="position:relative;">
                                                                <div class="con-req align-middle"><img src="assets/images/rightsignGray.JPG" alt="">Friend</div>
                                                                <div class="request-unfriend" style="" data-userid="<?php echo $userid; ?>" data-profileid="<?php  echo $profileId; ?>">Unfriend</div>

                                                            </div>

                                                        </div>
                                                        <?php
                                    }else{echo 'Not found';}

                                    ?>
                                                            <?php
                                    if(empty($followCheck)){
                                       ?>
                                                                <div class="profile-follow-button" data-userid="<?php echo $userid; ?>" data-profileid="<?php  echo $profileId; ?>" style="border-right: 1px solid gray;">
                                                                    <img src="assets/images/followGray.JPG" alt="">
                                                                    <div class="profile-activity-button-text">Follow</div>
                                                                </div>
                                                                <?php


                                    }else{
                                    ?>
                                                                    <div class="profile-unfollow-button" data-userid="<?php echo $userid; ?>" data-profileid="<?php  echo $profileId; ?>" style="border-right: 1px solid gray;">
                                                                        <img src="assets/images/rightsignGray.JPG" alt="">
                                                                        <div class="profile-activity-button-text">Following</div>
                                                                    </div>

                                                                    <?php
                                    }

                                    ?>





                                                                        <div class="profile-message-button" data-userid="<?php echo $userid; ?>" data-profileid="<?php  echo $profileId; ?>">
                                                                            <img src="assets/images/messangerGray.png" alt="">
                                                                            <div class="profile-activity-button-text">Message</div>
                                                                        </div>

                                                                        <?php

                                } ?>
                            </div>
                            <!-- ///////// ...........Request, Follow, Messenger End...........///////////-->

                        </div>

                    </div>
                    <div class="cover-bottom-part" style="display:none;">
                        <div class="timeline-button align-middle cover-but-css" data-userid="<?php echo $userid; ?>" data-profileid="<?php  echo $profileId; ?>">
                            <div>Timeline</div>
                        </div>
                        <div class="about-button cover-but-css" data-userid="<?php echo $userid; ?>" data-profileid="<?php  echo $profileId; ?>">About</div>
                        <div class="friends-button cover-but-css" data-userid="<?php echo $userid; ?>" data-profileid="<?php  echo $profileId; ?>">Friends</div>
                        <div class="photos-button cover-but-css" data-userid="<?php echo $userid; ?>" data-profileid="<?php  echo $profileId; ?>">Photos</div>
                        <!--
                        <div class="archive-button align-middle cover-but-css">
                            <img src="assets/images/profile/archive.JPG" alt="">
                            <div>Archive</div>
                        </div>
                        <div class="more-button align-middle cover-but-css">
                            <div>More</div> <img src="assets/images/profile/more.JPG" alt="">
                            </div>
-->
                    </div>
                    <div class="bio-timeline">
                        <div class="bio-wrap" style="visibility:hidden;">
                            <div class="bio-question"></div>
                            <div class="bio-intro">
                                <div class="intro-wrap">
                                    <img src="assets/images/profile/intro.JPG" alt="">
                                    <div>Intro</div>
                                </div>
                                <div class="intro-icon-text ">
                                    <img src="assets/images/profile/addBio.JPG" alt="">
                                    <div class="add-bio-text">Add a short bio to tell people more yourself.</div>

                                    <div class="add-bio-click"><a href="">Add Bio</a></div>
                                </div>
                                <div class="bio-details">
                                    <div class="bio-1 ">
                                        <img src="assets/images/profile/livesIn.JPG" alt="">
                                        <div class="live-text">Lives in <span class="live-text-css blue ">Chittagong</span></div>
                                    </div>
                                    <div class="bio-2 ">
                                        <img src="assets/images/profile/followedBy.JPG" alt="">
                                        <div class="live-text">Lives in <span class="followed-text-css blue ">65 people</span></div>
                                    </div>

                                </div>
                                <div class="bio-feature">
                                    <img src="assets/images/profile/feature.JPG" alt="">
                                    <div class="feat-text">Showcase what's important to you by adding photos, pages, groups and more to your featured section on you public profile. </div>
                                    <div class="add-feature blue">Add to Featured</div>
                                    <div class="add-feature-link blue">
                                        <div class="link-plus">+</div>
                                        <div>Add Instagram, Websites, Other Links</div>
                                    </div>
                                </div>
                            </div>
                            <div class="bio-add-photo"></div>
                            <div class="bio-find-friend"></div>
                        </div>
                        <div class="status-timeline-wrap" style="margin-top: -10px;">
                            <?php if($profileId == $userid){ ?>
                            <div class="profile-status-write">
                                <div class="status-wrap">
                                    <div class="status-top-wrap">
                                        <div class="status-top">
                                            Create Post
                                        </div>
                                    </div>
                                    <div class="status-med">
                                        <div class="status-prof">
                                            <div class="top-pic"><img src="assets/images/me.jpg" alt=""></div>
                                        </div>
                                        <div class="status-prof-textarea">
                                            <textarea data-autoresize rows="5" columns="5" placeholder="what's going in your mind?" name="textStatus" class="status align-middle" id="statusEmoji"></textarea>
                                            <!--
                                            <div class="mention-wrap" style="position: absolute;z-index: 2;">
                                                <ul style="background-color:white;padding:5px;margin-top:0;margin-left:155px;box-shadow:0 0 5px gray;border-radius:3px;">
                                                    <li class="mention-individuals align-middle" style="background-color:#4267b2;color:white; font-size:12px; padding:3px;margin-bottom:5px;cursor:pointer;">
                                                        <img src="assets/images/me.jpg" style="height:20px; width:20px; " alt="">
                                                        <div class="mention-name" style="margin-left:3px;">Farhan Abir</div>

                                                    </li>
                                                    <li class="mention-individuals align-middle" style="background-color:#4267b2;color:white; font-size:12px; padding:3px;margin-bottom:5px;cursor:pointer;">
                                                        <img src="assets/images/me.jpg" style="height:20px; width:20px; " alt="">
                                                        <div class="mention-name" style="margin-left:3px;">Farhan Abir</div>

                                                    </li>
                                                    <li class="mention-individuals align-middle" style="background-color:#4267b2;color:white; font-size:12px; padding:3px;margin-bottom:5px;cursor:pointer;">
                                                        <img src="assets/images/me.jpg" style="height:20px; width:20px; " alt="">
                                                        <div class="mention-name" style="margin-left:3px;">Farhan Abir</div>

                                                    </li>
                                                </ul>
                                            </div>
-->
                                        </div>
                                    </div>
                                    <div class="status-bot">

                                        <div class="file-upload remIm">
                                            <label for="multiple_files" class="file-upload__label"><div class="status-bot-1">
                                        <img src="assets/images/photo.JPG" alt="">
                                        <div class="status-bot-text">Photo/Video</div>
                                    </div></label>
                                            <input id="multiple_files" class="file-upload__input status-img-input" type="file" name="file-upload" data-multiple-caption="{count} files selected" multiple="">
                                        </div>




                                        <div class="status-bot-1">
                                            <img src="assets/images/tag.JPG" alt="">
                                            <div class="status-bot-text">Tag Friends</div>
                                        </div>
                                        <div class="status-bot-1">
                                            <img src="assets/images/tag.JPG" alt="">
                                            <div class="status-bot-text">Feeling/Activ...</div>
                                        </div>
                                        <div class="status-bot-1 dott">...</div>
                                    </div>
                                    <ul id="sortable" style="position:relative;">
                                    </ul>
                                    <div id="error_multiple_files"></div>
                                    <div class="status-black-background black-background"></div>
                                    <div class="status-share-button-wrap">
                                        <div class="newsFeed-privacy">
                                            <div class="newsFeed">
                                                <div class="right-sign-icon">
                                                    <img src="assets/images/profile/rightSign.JPG" alt="">
                                                </div>
                                                <div class="newsfeed-icon align-middle">
                                                    <img src="assets/images/profile/newsFeed.JPG" alt="">
                                                </div>
                                                <div class="newsfeed-text">
                                                    News Feed
                                                </div>
                                            </div>
                                            <div class="status-privacy-wrap">
                                                <div class="status-privacy  ">
                                                    <div class="privacy-icon align-middle">
                                                        <img src="assets/images/profile/publicIcon.JPG" alt="">
                                                    </div>
                                                    <div class="privacy-text">Public</div>
                                                    <div class="privacy-downarrow-icon align-middle">
                                                        <img src="assets/images/watchmore.png" alt="">
                                                    </div>
                                                </div>
                                                <div class="status-privacy-option">

                                                </div>
                                            </div>

                                        </div>
                                        <div class="seemore-sharebutton">
                                            <div class="share-seemore-option">
                                                <div class="privacy-downarrow-icon align-middle">
                                                    <img src="assets/images/watchmore.png" alt="">
                                                    <span class="status-seemore">See More</span>
                                                </div>

                                            </div>
                                            <div class="status-share-button align-middle">
                                                Share
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="ptaf-wrap">
                                <div class="profile-timeline">
                                    <div class="news-feed-comp">
                                        <div class="news-feed-text">
                                            <!--               .... Post user photo and name Start.....-->
                                            <div class="nf-1">
                                                <div class="nf-1-left">
                                                    <div class="nf-pro-pic">
                                                        <a href="<?php echo BASE_URL.$post->userLink; ?>">
                                <img src="<?php echo BASE_URL.$post->profilePic; ?>" class="pro-pic" alt="">
                            </a>
                                                    </div>
                                                    <div class="nf-pro-name-time">
                                                        <div class="nf-pro-name">
                                                            <a href="<?php echo BASE_URL.$post->userLink; ?>" class="nf-pro-name"><?php echo ''.$post->firstName.' '.$post->lastName.''; ?></a>

                                                        </div>
                                                        <div class="nf-pro-time-privacy">
                                                            <div class="nf-pro-time">
                                                                <?php echo $loadFromPost->timeAgo($post->postedOn); ?>
                                                            </div>
                                                            <div class="nf-pro-privacy"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nf-1-right">
                                                    <div class="nf-1-right-dott">

                                                        <?php
            if(empty($post->shareId)){

            if($user_id == $profileId){ ?>
                                                            <div class="post-option" data-postid="<?php echo $post->post_id; ?>" data-userid="<?php echo $user_id; ?>">...</div>

                                                            <div class="post-option-details-container"></div>
                                                            <?php }else{}

                            }else{
             if($user_id == $profileId){ ?>
                                                            <div class="shared-post-option" data-postid="<?php echo $post->post_id; ?>" data-userid="<?php echo $user_id; ?>">...</div>

                                                            <div class="shared-post-option-details-container"></div>
                                                            <?php }else{}




            }

                            ?>

                                                    </div>

                                                </div>
                                            </div>
                                            <!--               .... Post user photo and name End.....-->


                                            <!--               ....Post Text Start.....-->

                                            <div class="nf-2">
                                                <div class="nf-2-text" data-postid="<?php echo $post->post_id; ?>" data-userid="<?php echo $user_id; ?> " data-profilepic="<?php echo $post->profilePic; ?>">
                                                    <?php

if(empty($post->shareId)){echo $post->post;}else{
   if(empty($shareDetails)){echo 'share has not found';}else{
       echo '<span class="nf-2-text-span" data-postid="'.$post->post_id.'" data-userid="'.$user_id.' " data-profilepic="'.$post->profilePic.'" >'.$post->shareText.'</span>' ;
foreach($shareDetails as $share){
   ?>

                                                        <!--               .... Share Post user photo and name Start.....-->

                                                        <div class="share-container" style="padding:5px;box-shadow:0 0 3px gray;margin-top:10px;display:flex; flex-direction:column;display: flex;flex-direction: column;align-items: flex-start;cursor:pointer;">

                                                            <div class="nf-1">
                                                                <div class="nf-1-left">
                                                                    <div class="nf-pro-pic">
                                                                        <a href="<?php echo BASE_URL.$share->userLink; ?>">
                                <img src="<?php echo BASE_URL.$share->profilePic; ?>" class="pro-pic" alt="">
                            </a>
                                                                    </div>
                                                                    <div class="nf-pro-name-time">
                                                                        <div class="nf-pro-name">
                                                                            <a href="<?php echo BASE_URL.$share->userLink; ?>" class="nf-pro-name"><?php echo ''.$share->firstName.' '.$share->lastName.''; ?></a>

                                                                        </div>
                                                                        <div class="nf-pro-time-privacy">
                                                                            <div class="nf-pro-time">
                                                                                <?php echo $loadFromPost->timeAgo($share->postedOn); ?>
                                                                            </div>
                                                                            <div class="nf-pro-privacy"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="nf-1-right">


                                                                </div>
                                                            </div>
                                                            <!--               ....Share Post user photo and name End.....-->


                                                            <!--               ....Share Post Text Start.....-->

                                                            <div class="nf-2">
                                                                <div class="nf-2-text" data-postid="<?php echo $share->post_id; ?>" data-userid="<?php echo $user_id; ?> " data-profilepic="<?php echo $share->profilePic; ?>">
                                                                    <?php echo $share->post; ?>




                                                                </div>
                                                                <div class="nf-2-img" data-postid="<?php echo $share->post_id; ?>" data-userid="<?php echo $user_id; ?>">
                                                                    <?php $shareImgJson = json_decode($share->postImage);
                            $shareCount = 0;
                                for($i = 0; $i < count($shareImgJson); $i++) {
                                    echo '<div class="post-img-box" data-postImgID="'.$share->id.'" style="max-height: 400px;
    overflow: hidden;"><img src="'.BASE_URL.$shareImgJson[''.$shareCount++.'']->imageName.'" alt="" style="width: 100%;"></div>';
                                }
                        ?>
                                                                </div>

                                                            </div>

                                                        </div>

                                                        <!--               ....Share  Post Text End.....-->







                                                        <?php
}
}
}



                        ?>




                                                </div>
                                                <div class="nf-2-img" data-postid="<?php echo $post->post_id; ?>" data-userid="<?php echo $user_id; ?>">
                                                    <?php $imgJson = json_decode($post->postImage);
                            $count = 0;
                                for($i = 0; $i < count($imgJson); $i++) {
                                    echo '  <div class="post-img-box" data-postImgID="'.$post->id.'" style="max-height: 400px;
    overflow: hidden;"><img src="'.BASE_URL.$imgJson[''.$count++.'']->imageName.'" class="postImage" alt="" style="width: 100%;cursor:pointer;"></div>';
                                }



                        ?>
                                                </div>

                                            </div>
                                            <!--               .... Post Text End.....-->

                                            <div class="nf-3">
                                                <div class="react-comment-count-wrap" style="width: 100%;display: flex;justify-content: space-between;align-items: center;">
                                                    <div class="react-count-wrap align-middle">
                                                        <div class="nf-3-react-icon">
                                                            <div class="react-inst-img align-middle" style="">
                                                                <?php






                foreach($react_max_show as $react_max){
                echo '<img class="'.$react_max->reactType.'-max-show" src="assets/images/react/'.$react_max->reactType.'.png" alt="" style="height:15px;width:15px;margin-right:2px;cursor:pointer;">';

                 } ?>


                                                            </div>

                                                        </div>
                                                        <div class="nf-3-react-username">
                                                            <!--                        Farhan kabir, Shafiq Rahim and 38 others-->
                                                            <?php if($main_react_count->maxreact == '0'){}else{echo $main_react_count->maxreact;} ?>

                                                        </div>
                                                    </div>
                                                    <div class="comment-share-count-wrap align-middle" style="font-size:12px; color:gray;">
                                                        <div class="comment-count-wrap" style="margin-right:10px;">
                                                            <?php if(empty($totalCommentCount->totalComment)){}else{ echo ''.$totalCommentCount->totalComment.' Comments'; }?> </div>
                                                        <div class="share-count-wrap">
                                                            <?php if(empty($totalShareCount->totalShare)){}else{ echo ''.$totalShareCount->totalShare.' Shares'; }?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="nf-4">
                                                <style>


                                                </style>
                                                <div class="like-action-wrap" data-postId="<?php echo $post->post_id; ?>" data-userid="<?php echo $user_id; ?>" style="position:relative;">
                                                    <div class="react-bundle-wrap">

                                                    </div>

                                                    <div class="like-action ra">
                                                        <?php if(empty($main_react)){
                            ?>
                                                        <div class="like-action-icon">
                                                            <img src="assets/images/likeAction.JPG" alt="">
                                                        </div>
                                                        <div class="like-action-text"><span>Like</span></div>
                                                        <?php
                        }else{  ?>
                                                            <div class="like-action-icon">
                                                                <img class="reactIconSize" src="assets/images/react/<?php echo $main_react->reactType; ?>.png" alt="">
                                                            </div>
                                                            <div class="like-action-text">
                                                                <span class="<?php echo $main_react->reactType; ?>-color">
                                    <?php echo $main_react->reactType; ?>
                                    </span></div>


                                                            <?php } ?>
                                                    </div>

                                                </div>
                                                <div class="comment-action ra">
                                                    <div class="comment-action-icon">
                                                        <img src="assets/images/commentAction.JPG" alt="">
                                                    </div>
                                                    <div class="comment-action-text">
                                                        <div class="comment-count-text-wrap">
                                                            <div class="comment-count"></div>
                                                            <div class="comment-text">Comment</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="share-action ra" data-postId="<?php echo $post->post_id; ?>" data-userid="<?php echo $user_id; ?>" data-profileid="<?php echo $profileId; ?>" data-profilepic="<?php echo $userdata->profilePic; ?>">
                                                    <div class="share-action-icon"><img src="assets/images/shareAction.JPG" alt=""></div>
                                                    <div class="share-action-text">Share</div>
                                                </div>
                                            </div>
                                            <div class="nf-5">
                                                <div class="comment-list">
                                                    <ul class="add-comment">
                                                        <?php foreach($commentDetails as $comment){

                                   $com_react_max_show = $loadFromPost->com_react_max_show($comment->commentOn,$comment->commentID);
	                               $main_react_count = $loadFromPost->com_main_react_count($comment->commentOn,$comment->commentID);
	                               $commentReactCheck = $loadFromPost->commentReactCheck($user_id,$comment->commentOn,$comment->commentID);


        ?>
                                                        <li class="new-comment">
                                                            <div class="com-details">
                                                                <div class="com-pro-pic">
                                                                    <a href="#">
                                                                        <div class="top-pic"><img src="<?php echo $comment->profilePic; ?>" alt=""></div>
                                                                    </a>
                                                                </div>
                                                                <div class="com-pro-wrap">
                                                                    <div class="com-text-react-wrap">
                                                                        <div class="com-text-option-wrap align-middle">
                                                                            <div class="com-pro-text align-middle">


                                                                                <div class="com-react-placeholder-wrap align-middle">

                                                                                    <div>
                                                                                        <span class="nf-pro-name"><a href="" class="nf-pro-name"><?php echo ''.$comment->firstName.' '.$comment->lastName.''; ?></a></span>
                                                                                        <span class="com-text" style="margin-left:5px;" data-postid="<?php echo $comment->commentOn; ?>" data-userid="<?php echo $user_id; ?>" data-commentid="<?php  echo $comment->commentID; ?>" data-profilepic="<?php  echo $userdata->profilePic; ?>"><?php echo $comment->comment; ?></span>
                                                                                    </div>
                                                                                    <div class="com-nf-3-wrap">
                                                                                        <?php

                                                    if($main_react_count->maxreact == '0'){}else{

                                                            ?>
                                                                                            <div class="com-nf-3 align-middle">
                                                                                                <div class="nf-3-react-icon">
                                                                                                    <div class="react-inst-img align-middle" style="">
                                                                                                        <?php
                                                            foreach($com_react_max_show as $react_max){
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
                    ?>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                            <?php if($user_id == $comment->commentBy){ ?>

                                                                            <div class="com-dot-option-wrap">
                                                                                <div class="com-dot" style="color:gray; margin-left:5px; cursor:pointer;" data-postid="<?php echo $comment->commentOn; ?>" data-userid="<?php echo $user_id; ?>" data-commentid="<?php  echo $comment->commentID; ?>">...</div>
                                                                                <div class="com-opton-details-containter">

                                                                                </div>

                                                                            </div>
                                                                            <?php } else{} ?>
                                                                        </div>
                                                                        <div class="com-react">

                                                                            <div class="com-like-react " data-postid="<?php echo $comment->commentOn; ?>" data-userid="<?php echo $user_id; ?>" data-commentid="<?php  echo $comment->commentID; ?>">
                                                                                <div class="com-react-bundle-wrap" data-commentid="<?php  echo $comment->commentID; ?>"></div>

                                                                                <?php if(empty($commentReactCheck)){echo '<div class="com-like-action-text"><span>Like</span></div>';}else{
                        echo '<div class="com-like-action-text"><span class="'.$commentReactCheck->reactType.'-color">'.$commentReactCheck->reactType.'</span></div>';
                    }
?>
                                                                            </div>
                                                                            <div class="com-reply-action" data-postid="<?php echo $post->post_id; ?>" data-userid="
                                                    <?php echo $user_id; ?>" data-commentid="
                                                    <?php echo $comment->commentID; ?>" data-profilepic="<?php echo $userdata->profilePic; ?>">Reply</div>
                                                                            <div class="com-time"> 11h </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="reply-wrap">
                                                                        <div class="reply-text-wrap">
                                                                            <ul class="old-replay">


                                                                                <?php
                                                    $replyDetails=$loadFromPost->replyFetch($comment->commentOn,$comment->commentID);


    foreach($replyDetails as $reply){
        $reply_react_max_show = $loadFromPost->reply_react_max_show($reply->commentOn,$reply->commentID,$reply->commentReplyID);
	    $reply_react_count = $loadFromPost->reply_main_react_count($reply->commentOn,$reply->commentID,$reply->commentReplyID);
        $replytReactCheck = $loadFromPost->replyReactCheck($user_id,$reply->commentOn,$reply->commentID,$reply->commentReplyID);

        ?>
                                                                                    <li class="new-reply" style="margin-top:5px;">
                                                                                        <!--                                                        ///.......demo reply comment......////-->


                                                                                        <div class="com-details">
                                                                                            <div class="com-pro-pic">
                                                                                                <a href="#">
                                                                                                    <div class="top-pic"><img src="<?php echo $reply->profilePic; ?>" alt=""></div>
                                                                                                </a>
                                                                                            </div>
                                                                                            <div class="com-pro-wrap">
                                                                                                <div class="com-text-react-wrap">
                                                                                                    <div class="reply-text-option-wrap align-middle">
                                                                                                        <div class="com-pro-text align-middle">
                                                                                                            <a href="#"><span class="nf-pro-name"><?php echo ''.$reply->firstName.' '.$reply->lastName.''; ?></span></a>
                                                                                                            <div class="com-react-placeholder-wrap align-middle">
                                                                                                                <div class="com-text" data-commentid="<?php  echo $comment->commentID; ?>" data-postid="<?php  echo $comment->commentOn; ?>" data-profilepic="<?php  echo $userdata->profilePic; ?>" data-replyid="<?php  echo $reply->commentID; ?>" data-userid="<?php echo $user_id; ?>" style="margin-left:5px;">
                                                                                                                    <?php echo $reply->comment; ?>
                                                                                                                </div>
                                                                                                                <div class="com-nf-3-wrap">
                                                                                                                    <?php
                                if($reply_react_count->maxreact == '0'){}else{

                                                            ?>
                                                                                                                        <div class="com-nf-3 align-middle">
                                                                                                                            <div class="nf-3-react-icon">
                                                                                                                                <div class="react-inst-img align-middle" style="">
                                                                                                                                    <?php
                                                            foreach($reply_react_max_show as $react_max){
                                                                echo '<img class="'.$react_max->reactType.'-max-show" src="assets/images/react/'.$react_max->reactType.'.png" alt="" style="height:12px;width:12px;margin-right:2px;cursor:pointer;">';
                                                                 } ?> </div>
                                                                                                                            </div>
                                                                                                                            <div class="nf-3-react-username">
                                                                                                                                <?php if($reply_react_count->maxreact == '0'){}else{echo $reply_react_count->maxreact;} ?>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <?php
    }
                    ?>
                                                                                                                </div>

                                                                                                            </div>

                                                                                                        </div>

                                                                                                        <div class="reply-dot-option-wrap">
                                                                                                            <div class="reply-dot" style="color:gray; margin-left:5px; cursor:pointer;" data-postid="<?php echo $comment->commentOn; ?>" data-userid="<?php echo $user_id; ?>" data-commentid="<?php  echo $comment->commentID; ?>" data-replyid="<?php  echo $reply->commentID; ?>">...</div>
                                                                                                            <div class="reply-option-details-containter">
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="com-react">

                                                                                                        <div class="com-like-react reply" data-postid="<?php echo $reply->commentOn; ?>" data-userid="<?php echo $user_id; ?>" data-commentid="<?php  echo $reply->commentID; ?>" data-commentparentid="<?php  echo $reply->commentReplyID; ?>">
                                                                                                            <div class="com-react-bundle-wrap reply" data-commentid="<?php  echo $reply->commentID; ?>" data-commentparentid="<?php  echo $reply->commentReplyID; ?>"></div>

                                                                                                            <?php if(empty($replytReactCheck)){echo '<div class="reply-like-action-text"><span>Like</span></div>';}else{
                        echo '<div class="reply-like-action-text"><span class="'.$replytReactCheck->reactType.'-color">'.$replytReactCheck->reactType.'</span></div>';
                    }
?>


                                                                                                        </div>
                                                                                                        <div class="com-reply-action-child" style="cursor:pointer;" data-postid="<?php echo $reply->commentOn; ?>" data-userid="<?php echo $user_id; ?>" data-commentid="<?php  echo $reply->commentReplyID; ?>" data-profilepic="<?php  echo $userdata->profilePic; ?>">Reply</div>
                                                                                                        <div class="com-time"> 11h </div>
                                                                                                    </div>
                                                                                                </div>

                                                                                            </div>

                                                                                        </div>


                                                                                        <!--                                                        ///.......demo reply comment......////-->


                                                                                    </li>


                                                                                    <?php
    }

                    ?>

                                                                            </ul>
                                                                        </div>
                                                                        <div class="replyInput">


                                                                        </div>
                                                                    </div>

                                                                </div>

                                                            </div>
                                                        </li>



                                                        <?php
    } ?>

                                                    </ul>
                                                </div>
                                                <div class="comment-write">
                                                    <div class="com-pro-pic" style="margin-top: 4px;">
                                                        <a href="#">
                                                            <div class="top-pic"><img src="<?php echo $userdata->profilePic; ?>" alt=""></div>
                                                        </a>
                                                    </div>
                                                    <div class="com-input" style="">
                                                        <div class="comment-input" style="flex-basis:75%;">
                                                            <input type="text" name="" id="" class="comment-input-style comment-submit" style="" data-postid="<?php echo $post->post_id; ?>" data-userid="<?php echo $user_id; ?>" placeholder="Write a comment...">
                                                        </div>
                                                        <div class="comment-input-option ">
                                                            <div class="imoji-action align-middle">
                                                                <img src="<?php echo ''.BASE_URL.'/assets/images/emojiAction.JPG'; ?>" alt="">
                                                            </div>
                                                            <div class="cam-action align-middle">
                                                                <img src="<?php echo ''.BASE_URL.'/assets/images/commentCamera.JPG'; ?>" alt="">
                                                            </div>
                                                            <div class="gif-action align-middle">
                                                                <img src="<?php echo ''.BASE_URL.'/assets/images/commentGif.JPG'; ?>" alt="">
                                                            </div>
                                                            <div class="sticker-action align-middle">
                                                                <img src="<?php echo ''.BASE_URL.'/assets/images/commentSticker.JPG'; ?>" alt="">
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="news-feed-photo"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="cover-right-wrap">
                    <div class="profile-active-user">
                        <?php
                        $loadFromPost->liveUsers($userid);


                        ?>

                    </div>
                </div>
                <!--      ///////////..........start profile cover and photo section...........//////////-->

            </div>
            <div class="top-box-show"></div>
            <div id="adv_dem"></div>
        </main>
        <!--   ////////.........end main area................//////-->

        <!--
.

    <body onload='myLoader()'>
        <div id='loading'></div>
-->


        <script src="assets/js/jquery.js"></script>
        <script src="assets/js/about.js"></script>
        <!--        <script src="assets/js/main.js"></script>-->
        <script src="assets/js/search.js"></script>
        <script src="assets/dist/emojionearea.min.js"></script>

        <script>
            //          var preloader = document.getElementById('loading');
            //
            //	function myLoader(){
            //	    preloader.style.display='none';
            //	}
            jQuery.each(jQuery('textarea[data-autoresize]'), function() {
                var offset = this.offsetHeight - this.clientHeight;

                var resizeTextarea = function(el) {
                    jQuery(el).css('height', 'auto').css('height', el.scrollHeight + offset);
                };
                jQuery(this).on('keyup input', function() {
                    resizeTextarea(this);
                }).removeAttr('data-autoresize');
            });

            $(document).ready(function() {


                $(document).on('click', '.about-button, .profile-edit-button', function() {
                    var userid = $(this).data('userid');
                    var profileid = $(this).data('profileid');

                    $.post('http://localhost/facebook/core/ajax/about.php', {
                        userid: userid,
                        profileid: profileid
                    }, function(data) {

                        $(".bio-timeline").html(data);


                    });



                });
                $(document).on('click', '.friends-button', function() {
                    var userid = $(this).data('userid');
                    var profileid = $(this).data('profileid');

                    $.post('http://localhost/facebook/core/ajax/friend.php', {
                        userid: userid,
                        profileid: profileid
                    }, function(data) {

                        $(".bio-timeline").html(data);


                    });

                });
                $(document).on('click', '.photos-button', function() {
                    var userid = $(this).data('userid');
                    var profileid = $(this).data('profileid');

                    $.post('http://localhost/facebook/core/ajax/photo.php', {
                        userid: userid,
                        profileid: profileid
                    }, function(data) {

                        $(".bio-timeline").html(data);


                    });

                });
                $(document).on('click', '.timeline-button', function() {
                    var userid = $(this).data('userid');
                    var profileid = $(this).data('profileid');

                    $.post('http://localhost/facebook/core/ajax/timeline.php', {
                        userid: userid,
                        profileid: profileid
                    }, function(data) {

                        $(".bio-timeline").html(data);

                        $(document).on('keyup', '.emojionearea-editor', function() {
                            console.log($(this).text());
                        })
                        $('#statusEmoji').emojioneArea({
                            pickerPosition: "right",
                            spellcheck: true
                        })


                    });

                });




                $(document).on('click', '.watchmore-wrap', function() {
                    $('.setting-logout-wrap').toggle();
                })
                $(document).on('click', '.logout-option', function() {
                    window.location.href = "logout.php"
                })

                $(document).on('keyup', '.emojionearea-editor', function() {
                    console.log($(this).text());
                })
                $('#statusEmoji').emojioneArea({
                    pickerPosition: "right",
                    spellcheck: true
                })
                //                $('.comment-submit').emojioneArea({
                //                    pickerPosition: "right",
                //                    spellcheck: true
                //                })









                $(".status-share-button ").on("click", function() {

                    var statusText = $('.emojionearea-editor').html();




                    var form_data = new FormData("#multiple_files");

                    var storeImage = [];
                    var error_images = [];


                    var files = $('#multiple_files')[0].files;
                    //                alert(files.length);
                    //           if (files.length < 1) {
                    //               error_images += 'Please Select Image';
                    //           } else {
                    //                if (files.length == 0) {
                    //                    alert("files are empty");
                    //                }
                    console.log(files, files.length);
                    if (files.length != 0) {
                        if (files.length > 10) {
                            error_images += 'You can not select more than 10 files';
                        } else {
                            for (var i = 0; i < files.length; i++) {
                                var name = document.getElementById("multiple_files").files[i].name;

                                storeImage += '{\"imageName\":\"user/' + <?php echo $userid; ?> + '/postImage/' + name + '\"},'

                                //                            storeImage += "{\"imageName\":\"users/" + <?php echo $userid; ?> +
                                //                                "/postImage/" + name + "\"},";

                                var ext = name.split('.').pop().toLowerCase();
                                if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg', 'PNG']) == -1) {
                                    error_images += '<p>Invalid ' + i + ' File</p>';
                                }
                                var oFReader = new FileReader();
                                oFReader.readAsDataURL(document.getElementById("multiple_files").files[i]);
                                var f = document.getElementById("multiple_files").files[i];
                                var fsize = f.size || f.fileSize;
                                if (fsize > 2000000) {
                                    error_images += '<p>' + i + ' File Size is very big</p>';
                                } else {
                                    form_data.append("file[]", document.getElementById('multiple_files').files[i]);
                                }
                            }
                        }
                        //           }
                        //           console.log(form_data);
                        //
                        if (files.length < 1) {



                        } else {
                            var str = storeImage.replace(/,\s*$/, "");
                            //                $(this).html($(this).html().replace(/,/g , ''));
                            var stIm = '[' + str + ']';
                            //                 var stImage = JSON.stringify(stIm);
                            //                parImag = JSON.parse(stIm);
                            //                alert(parImag["0"].imageName);
                            //                console.log(stIm);

                            //                alert(get_ad_cat);

                        }
                        console.log(stIm);
                        if (error_images == '') {
                            $.ajax({
                                url: "http://localhost/facebook/core/ajax/uploadPostImage.php",
                                method: "POST",
                                data: form_data,
                                contentType: false,
                                cache: false,
                                processData: false,
                                beforeSend: function() {
                                    $('#error_multiple_files').html('<br /><label class="text-primary">Uploading...</label>');
                                },
                                success: function(data) {
                                    $('#error_multiple_files').html(data);
                                    $('#sortable').empty();

                                }
                            });
                        } else {
                            $('#multiple_files').val('');
                            $('#error_multiple_files').html("<span class='text-danger'>" + error_images + "</span>");
                            return false;
                        };

                    } else {

                        var stIm = '';

                    }
                    //          var edit_email_text = $("#edit_email_text").val();


                    //         alert(feat_1, feat_2);
                    console.log(stIm);
                    if (stIm == '') {

                        $.post('http://localhost/facebook/core/ajax/postSubmit.php', {

                            onlyStatusText: statusText
                        }, function(data) {

                            $("#adv_dem").html(data);
                            location.reload();





                        });

                    } else {
                        $.post('http://localhost/facebook/core/ajax/postSubmit.php', {

                            stIm: stIm,
                            statusText: statusText




                        }, function(data) {

                            $("#adv_dem").html(data);
                            location.reload();


                            //        load_comment();


                        });
                    }



                    //                alert(statusText);

                })
                $('.add-cover-photo').on("click", function() {
                    $('.add-cov-opt').toggle()
                })
                $('#cover-upload').on("change", function() {
                    var name = $('#cover-upload').val().split('\\').pop();
                    var file_data = $('#cover-upload').prop('files')[0];

                    var file_size = file_data["size"];
                    var file_type = file_data["type"].split('/').pop();

                    var userid = <?php echo $userid; ?>;

                    var imgName = 'user/' + userid +
                        '/coverphoto/' + name + '';
                    var form_data = new FormData();
                    form_data.append('file', file_data);

                    if (name != '') {
                        $.post('http://localhost/facebook/core/ajax/profile.php', {
                            imgName: imgName,
                            userid: userid,
                        }, function(data) {
                            $('#adv_dem').html(data);
                        });
                        $.ajax({
                            url: 'http://localhost/facebook/core/ajax/profile.php',
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: form_data,
                            type: 'post',
                            success: function(data) {
                                $('.profile-cover-wrap').css('background-image', 'url(' + data + ')');
                                $('.add-cov-opt').hide();
                            }
                        });
                    }

                });
                $('.profile-pic-upload').on("click", function() {
                    $('.top-box-show').html('<div class="top-box align-vertical-middle profile-dialog-show"><div class="profile-pic-upload-action"><div class="pro-pic-up"><div class="file-upload"><label for="profile-upload" class="file-upload__label"><snap class="upload-plus-text align-middle"> <snap class="upload-plus-sign">+</snap>  Upload Photo </snap></label><input id="profile-upload" class="file-upload__input" type="file" name="file-upload"></div></div><div class="pro-pic-choose"></div> </div></div>');
                });
                $(document).on('change', '#profile-upload', function() {
                    var name = $('#profile-upload').val().split('\\').pop();
                    var file_data = $('#profile-upload').prop('files')[0];

                    var file_size = file_data["size"];
                    var file_type = file_data["type"].split('/').pop();

                    var userid = <?php echo $userid; ?>;

                    var imgName = 'user/' + userid +
                        '/profilePhoto/' + name + '';
                    var form_data = new FormData();
                    form_data.append('file', file_data);
                    console.log(imgName, form_data);
                    if (name != '') {
                        $.post('http://localhost/facebook/core/ajax/profilePhoto.php', {
                            imgName: imgName,
                            userid: userid,
                        }, function(data) {
                            $('#adv_dem').html(data);
                        });
                        $.ajax({
                            url: 'http://localhost/facebook/core/ajax/profilePhoto.php',
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: form_data,
                            type: 'post',
                            success: function(data) {
                                $(".profile-pic-me").attr("src", "" + data + "");

                                $('.profile-dialog-show').hide();
                            }
                        });
                    }

                });
                $('.status').on('focus', function() {
                    $('.status-share-button-wrap').show('0.5');
                })
                $('.profile-status-write').on('blur', function() {
                    $('.status-share-button-wrap').hide('0.5');
                })
                $('.status-bot').on('click', function() {
                    $('.status-share-button-wrap').show('0.5');
                })
                $(document).on("click", ".emojionearea-editor", function(e) {
                    $('.status-share-button-wrap').show('0.5');
                })
                var fileCollection = new Array();
                $(document).on("change", "#multiple_files", function(e) {

                    var count = 0;
                    var files = e.target.files;

                    $(this).removeData()
                    var text = "";


                    $.each(files, function(i, file) {
                        fileCollection.push(file);
                        var reader = new FileReader();
                        reader.readAsDataURL(file);
                        reader.onload = function(e) {
                            var name = document.getElementById("multiple_files").files[i].name;
                            var template = '<li class="ui-state-default del" style="position:relative;"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>' +
                                '<img id="' + name + '" style="width:60px; height:60px" src="' + e.target.result + '" alt=""> ' +
                                '</li>';
                            $("#sortable").append(template);
                        }
                        var filesCount = $("#multiple_files")[0].files;
                        if (filesCount.length > 5) {
                            $(".img_error").show();
                            $(".img_error").html("আপনি ৫টির চেয়ে বেশি ছবি নির্বাচন করেছেন যেখান থেকে প্রথম পাচঁটি ছবি আপলোড হবে।");
                        } else {
                            $(".img_error").hide();
                        }
                    });
                    $("#sortable").append('<div class="remImg" style="position:absolute; top:0; right:0;cursor:pointer;  display:flex; justify-content:center; align-items: center; background:white; border-radius:50%; height:1rem; width:1rem; font-size: 0.694rem;">X</div>');
                })
                $(document).on("click", ".remImg", function() {
                    $("#sortable").empty();
                    $(".remIm").empty();
                    $(".remIm").html('<label for="upload" class="file-upload__label" style="margin: 0;border-bottom: none;"><div class="status-bot-1"><img src="assets/images/photo.JPG" alt=""><div class="status-bot-text">Photo/Video</div></label><input id="multiple_files" class="file-upload__input" type="file" name="file-upload remIm" multiple style="width: 100%;">');
                });
                $(".like-action-wrap").hover(function() {
                    var mainReact = $(this).find('.react-bundle-wrap');
                    $(mainReact).html('<div class="react-bundle align-middle" style="position:absolute;margin-top: -43px; margin-left: -40px; display:flex; background-color:white;padding: 0 2px;border-radius: 25px; box-shadow: 0px 0px 5px black; height:45px; width:270px; justify-content:space-around; transition: 0.3s;"><div class="like-react-click align-middle"><img class="main-icon-css" src="<?php echo " ".BASE_URL."assets/images/react/like.png "; ?>" alt=""></div><div class="love-react-click align-middle"><img class="main-icon-css" src="<?php echo " ".BASE_URL."assets/images/react/love.png "; ?>" alt=""></div><div class="haha-react-click align-middle"><img class="main-icon-css" src="<?php echo " ".BASE_URL."assets/images/react/haha.png "; ?>" alt=""></div><div class="wow-react-click align-middle"><img class="main-icon-css" src="<?php echo " ".BASE_URL."assets/images/react/wow.png "; ?>" alt=""></div><div class="sad-react-click align-middle"><img class="main-icon-css" src="<?php echo " ".BASE_URL."assets/images/react/sad.png "; ?>" alt=""></div><div class="angry-react-click align-middle"><img class="main-icon-css" src="<?php echo " ".BASE_URL."assets/images/react/angry.png "; ?>" alt=""></div></div>');
                }, function() {
                    var mainReact = $(this).find('.react-bundle-wrap');
                    $(mainReact).html('');
                });
                $(document).on('click', '.main-icon-css', function() {
                    var likeReact = $(this).parent();
                    reactApply(likeReact);
                })
                var id = 24;

                function reactApply(sClass) {
                    if ($(sClass).hasClass('like-react-click')) {
                        mainReactSub('like', 'blue', id);
                    } else if ($(sClass).hasClass('love-react-click')) {
                        mainReactSub('love', 'red', id);
                    } else if ($(sClass).hasClass('haha-react-click')) {
                        mainReactSub('haha', 'yellow', id);
                    } else if ($(sClass).hasClass('wow-react-click')) {
                        mainReactSub('wow', 'yellow', id);
                    } else if ($(sClass).hasClass('sad-react-click')) {
                        mainReactSub('sad', 'yellow', id);
                    } else if ($(sClass).hasClass('angry-react-click')) {
                        mainReactSub('angry', 'red', id);
                    } else {
                        console.log('not found');
                    }
                }

                function mainReactSub(typeR, color, id) {
                    var reactColor = '' + typeR + '-color';
                    var pClass = $('.' + typeR + '-react-click.align-middle');
                    var likeReactParent = $(pClass).parents('.like-action-wrap');

                    var nf4 = $(likeReactParent).parents('.nf-4');
                    var nf_3 = $(nf4).siblings('.nf-3').find('.react-count-wrap');
                    var reactCount = $(nf4).siblings('.nf-3').find('.nf-3-react-username');
                    var reactNumText = $(reactCount).text();

                    var postId = $(likeReactParent).data('postid');
                    var userId = $(likeReactParent).data('userid');
                    var likeAction = $(likeReactParent).find('.like-action');
                    var likeActionIcon = $(likeAction).find('.like-action-icon img');
                    var spanClass = $(likeAction).find('.like-action-text').find('span');
                    //                $(likeAction).hide();
                    //                alert(nf_3);
                    //                spanClass.text(typeR);
                    if ($(spanClass).hasClass(reactColor)) {
                        $(spanClass).removeClass();
                        spanClass.text("Like");
                        $(likeActionIcon).attr("src", "assets/images/likeAction.JPG");
                        mainReactDelete(typeR, postId, userId, nf_3);

                        //                    reactCountDec(reactCount, reactNumText)

                    } else if ($(spanClass).attr('class') !== undefined) {
                        $(spanClass).removeClass().addClass(reactColor);
                        spanClass.text(typeR);
                        $(likeActionIcon).removeAttr('src').attr("src", "assets/images/react/" + typeR + ".png").addClass('reactIconSize');

                        mainReactSubmit(typeR, postId, userId, nf_3);
                        //                    reactCountInc(reactCount, reactNumText)

                    } else {
                        $(spanClass).addClass(reactColor);
                        $(likeActionIcon).attr("src", "assets/images/react/" + typeR + ".png").addClass('reactIconSize');
                        spanClass.text(typeR);
                        $(likeActionIcon).removeAttr('src').attr("src", "assets/images/react/" + typeR + ".png").addClass('reactIconSize');

                        console.log(typeR, postId, userId);
                        mainReactSubmit(typeR, postId, userId, nf_3);
                        //                    reactCountInc(reactCount, reactNumText)

                    }
                }

                function mainReactDelete(typeR, postId, userId, nf_3) {
                    var profileid = "<?php echo $profileId;  ?>"
                    $.post('http://localhost/facebook/core/ajax/react.php', {
                        deleteReactType: typeR,
                        postId: postId,
                        userId: userId,
                        profileid: profileid

                    }, function(data) {
                        //                    alert(data);
                        $(nf_3).empty().html(data);
                    });
                }

                function mainReactSubmit(typeR, postId, userId, nf_3) {
                    var profileid = "<?php echo $profileId;  ?>"
                    $.post('http://localhost/facebook/core/ajax/react.php', {
                        reactType: typeR,
                        postId: postId,
                        userId: userId,
                        profileid: profileid

                    }, function(data) {
                        //                    alert(data);
                        $(nf_3).empty().html(data);
                    });

                }
                $(document).on('click', '.like-action', function() {
                    var likeActionIcon = $(this).find('.like-action-icon img');
                    var likeReactParent = $(this).parents('.like-action-wrap');

                    var nf4 = $(likeReactParent).parents('.nf-4');
                    var nf_3 = $(nf4).siblings('.nf-3').find('.react-count-wrap');
                    var reactCount = $(nf4).siblings('.nf-3').find('.nf-3-react-username');
                    var reactIcon = $(nf4).siblings('.nf-3').find('.react-inst-img');
                    var reactNumText = $(reactCount).text();
                    var postId = $(likeReactParent).data('postid');
                    var userId = $(likeReactParent).data('userid');
                    var typeText = $(this).find('.like-action-text span');
                    var typeR = $(typeText).text();


                    //                reactNumText--;
                    var spanClass = $(this).find('.like-action-text').find('span');
                    if ($(spanClass).attr('class') !== undefined) {
                        if ($(likeActionIcon).attr('src') == "assets/images/likeAction.JPG") {
                            (spanClass).addClass('like-color');
                            $(likeActionIcon).attr("src", "assets/images/react/like.png").addClass('reactIconSize');
                            spanClass.text("Like");
                            mainReactSubmit(typeR, postId, userId, nf_3)
                            //                        reactCountInc(postId, reactCount, reactNumText)



                        } else {
                            $(likeActionIcon).attr("src", "assets/images/likeAction.JPG");
                            spanClass.removeClass();
                            spanClass.text("Like");
                            mainReactDelete(typeR, postId, userId, nf_3);
                            //                        reactCountDec(reactCount, reactNumText, reactIcon)

                        }
                    } else if ($(spanClass).attr('class') === undefined) {
                        $(spanClass).addClass('like-color');
                        $(likeActionIcon).attr("src", "assets/images/react/like.png").addClass('reactIconSize');
                        spanClass.text("Like");
                        mainReactSubmit(typeR, postId, userId, nf_3);

                        //                    reactCountInc(postId, reactCount, reactNumText)
                    } else {
                        $(spanClass).addClass('like-color');
                        $(likeActionIcon).attr("src", "assets/images/react/like.png").addClass('reactIconSize');
                        spanClass.text("Like");
                        mainReactSubmit(typeR, postId, userId, nf_3);
                        //                    reactCountInc(postId, reactCount, reactNumText)

                    }
                })

                /////////////.........Share part start..............///////////

                $(document).on('click', '.share-action', function() {
                    var postid = $(this).data('postid');
                    var userid = $(this).data('userid');
                    var profileid = $(this).data('profileid');
                    var profilePic = $(this).data('profilepic');
                    var nf_1 = $(this).parents('.nf-4').siblings('.nf-1').html();
                    var nf_2 = $(this).parents('.nf-4').siblings('.nf-2').html();
                    console.log(postid, userid, profileid);
                    $('.top-box-show').html(' <div class="top-box profile-dialog-show" style="overflow: hidden;background-color: rgb(236, 236, 236);"> <div class="edit-post-header align-middle " style="justify-content: space-between; padding: 10px; height: 20px; background-color: lightgray;font-size: 14px; font-weight:600; "> <div class="edit-post-text">Share Post</div> <div class="edit-post-close" style="padding: 5px; color: gray; cursor:pointer;">x</div> </div> <div class="edit-post-value" style=""> <div class="status-med"> <div class="status-prof"> <div class="top-pic"><img src="' + profilePic + '" alt=""></div> </div> <div class="status-prof-textarea"> <textarea data-autoresize rows="5" columns="5" placeholder="Tell something about the post.." name="textStatus" class="shareText align-middle" style="padding-top: 10px;"></textarea> </div> </div> </div> <div class="news-feed-text" style=" display: flex; flex-direction: column; align-items: baseline; margin:5px;box-shadow:0 0 2px darkgray;overflow: hidden;"> ' + nf_1 + ' ' + nf_2 + ' </div> <div class="edit-post-submit" style="position: absolute;right:0; bottom: 0; display: flex; align-items: center; margin: 10px; z-index: 1;"> <div class="status-privacy-wrap"> <div class="status-privacy " style="background-color: #f5f6f8;"> <div class="privacy-icon align-middle"> <img src="assets/images/profile/publicIcon.JPG" alt=""> </div> <div class="privacy-text">Public</div> <div class="privacy-downarrow-icon align-middle"> <img src="assets/images/watchmore.png" alt=""> </div> </div> <div class="status-privacy-option"> </div> </div> <div class="post-Share" style="padding: 3px 15px; background-color: #4267bc;color: white; font-size: 14px; margin-left:5px;cursor:pointer;" data-postid="' + postid + '" data-userid="' + userid + '" data-profileid="' + profileid + '" >Share</div> </div> <div style=" position: absolute; bottom: 0; height: 43px; width: 100%; text-align: center; background: lightgrey;box-shadow: -1px -1px 5px grey;"></div> </div>');
                    nf_1_right_dott_hide();
                })

                function nf_1_right_dott_hide() {
                    $('.nf-1-right-dott').hide();
                }
                $(document).on('click', '.post-Share', function() {
                    var postid = $(this).data('postid');
                    var userid = $(this).data('userid');
                    var profileid = $(this).data('profileid');
                    var shareText = $(this).parents('.edit-post-submit').siblings('.edit-post-value').find('.shareText').val();


                    $.post('http://localhost/facebook/core/ajax/share.php', {
                        shareText: shareText,
                        profileid: profileid,
                        postid: postid,
                        userid: userid
                    }, function(data) {
                        $('.top-box-show').empty();
                        console.log(data);
                    });


                })


                /////////.........share part end..............///////


                /////////.........Freind Request Start..............///////
                $(document).on('click', '.profile-add-friend', function() {
                    $(this).parents('.profile-action').find('.profile-follow-button').removeClass().addClass('profile-unfollow-button').html('<img src="assets/images/rightsignGray.JPG" alt=""><div class="profile-activity-button-text">Following</div>');

                    $(this).find('.edit-profile-button-text').text('Friend Request Sent');
                    $(this).removeClass().addClass('profile-friend-sent');
                    var userid = $(this).data('userid');
                    var profileid = $(this).data('profileid');

                    $.post('http://localhost/facebook/core/ajax/request.php', {
                        request: profileid,
                        userid: userid
                    }, function(data) {
                        console.log(data)
                    });

                    $.post('http://localhost/facebook/core/ajax/request.php', {
                        follow: profileid,
                        userid: userid
                    }, function(data) {});


                });
                $(document).on('click', '.accept-req', function() {
                    var userid = $(this).data('userid');
                    var profileid = $(this).data('profileid');
                    $(this).parent().empty().html('<div class="edit-profile-confirm-button" style="position:relative;"> <div class="con-req align-middle"><img src="assets/images/rightsignGray.JPG" alt="">Friend</div> <div class="request-unfriend" style="" data-userid="' + userid + '" data-profileid="' + profileid + '">Unfriend</div> </div>')
                    $.post('http://localhost/facebook/core/ajax/request.php', {
                        confirmRequest: profileid,
                        userid: userid
                    }, function(data) {});
                });




                $(document).on('click', '.profile-follow-button', function() {
                    $(this).removeClass().addClass('profile-unfollow-button').html('<img src="assets/images/rightsignGray.JPG" alt=""><div class="profile-activity-button-text">Following</div>');
                    var userid = $(this).data('userid');
                    var profileid = $(this).data('profileid');

                    $.post('http://localhost/facebook/core/ajax/request.php', {
                        follow: profileid,
                        userid: userid
                    }, function(data) {});

                });
                $(document).on('click', '.profile-unfollow-button', function() {
                    $(this).removeClass().addClass('profile-follow-button').html('<img src="assets/images/followGray.JPG" alt=""><div class="profile-activity-button-text">Follow</div>');
                    var userid = $(this).data('userid');
                    var profileid = $(this).data('profileid');

                    $.post('http://localhost/facebook/core/ajax/request.php', {
                        unfollow: profileid,
                        userid: userid
                    }, function(data) {});

                });

                $(document).on('click', '.profile-friend-sent', function() {

                    $(this).parents('.profile-action').find('.profile-unfollow-button').removeClass().addClass('profile-follow-button').html('<img src="assets/images/followGray.JPG" alt=""><div class="profile-activity-button-text">Follow</div>');
                    $(this).find('.edit-profile-button-text').text('Add Friend');
                    $(this).removeClass().addClass('profile-add-friend');
                    var userid = $(this).data('userid');
                    var profileid = $(this).data('profileid');

                    $.post('http://localhost/facebook/core/ajax/request.php', {
                        cancelSentRequest: profileid,
                        userid: userid
                    }, function(data) {});
                    $.post('http://localhost/facebook/core/ajax/request.php', {
                        unfollow: profileid,
                        userid: userid
                    }, function(data) {});
                });

                $(document).on('click', '.request-cancel', function() {
                    $(this).parents('.profile-friend-confirm').removeClass().addClass('profile-add-friend').html('<img src="assets/images/friendRequestGray.JPG" alt=""><div class="edit-profile-button-text">Add Friend</div>');
                    var userid = $(this).data('userid');
                    var profileid = $(this).data('profileid');

                    $.post('http://localhost/facebook/core/ajax/request.php', {
                        cancelSentRequest: userid,
                        userid: profileid
                    }, function(data) {});
                });
                $(document).on('click', '.request-unfriend', function() {

                    $(this).parents('.profile-friend-confirm').removeClass().addClass('profile-add-friend').html('<img src="assets/images/friendRequestGray.JPG" alt=""><div class="edit-profile-button-text">Add Friend</div>');
                    var userid = $(this).data('userid');
                    var profileid = $(this).data('profileid');

                    $.post('http://localhost/facebook/core/ajax/request.php', {
                        unfriendRequest: profileid,
                        userid: userid
                    }, function(data) {});
                });




                $(document).on('click', '.profile-message-button', function() {
                    location.href = '';



                });
                $(document).on('mouseenter', '.edit-profile-confirm-button', function() {
                    var reqCancel = $(this).find('.request-cancel');
                    var reqUnfriend = $(this).find('.request-unfriend');
                    $(reqCancel).show();
                    $(reqUnfriend).show();
                });
                $(document).on('mouseleave', '.profile-friend-confirm', function() {
                    var reqCancel = $(this).find('.request-cancel');
                    var reqUnfriend = $(this).find('.request-unfriend');
                    $(reqCancel).hide();
                    $(reqUnfriend).hide();
                });



                //                                    <div class="profile-add-friend">
                //                                        <img src="assets/images/friendRequestGray.JPG" alt="">
                //                                        <div class="edit-profile-button-text">Add Friend</div>
                //                                    </div>
                //                                    <div class="profile-follow-button" style="border-right: 1px solid gray;">
                //                                        <img src="assets/images/followGray.JPG" alt="">
                //                                        <div class="profile-activity-button-text">Follow</div>
                //                                    </div>
                //                                    <div class="profile-message-button">
                //                                        <img src="assets/images/messangerGray.png" alt="">
                //                                        <div class="profile-activity-button-text">Message</div>
                //                                    </div>



                /////////.........Freind Request end..............///////
                //            function reactCountInc(postId, reactCount, reactNumText) {
                //
                //                reactNumText++;
                //                $(reactCount).text(reactNumText);
                //
                //            }
                //
                //            function reactCountDec(reactCount, reactNumText, reactIcon) {
                //                reactNumText--;
                //                if (reactNumText === 0) {
                //                    $(reactCount).empty();
                //                    $(reactIcon).empty();
                //                } else {
                //                    $(reactCount).show().text(reactNumText);
                //                }
                //            }

                /////////////.........comment part start..............///////


                $(document).on('click', '.comment-action', function() {
                    var nf_4 = $(this).parents('.nf-4').siblings('.nf-5').find('input.comment-input-style.comment-submit').focus();
                })
                $('.comment-submit').keyup(function(e) {
                    if (e.keyCode == 13) {
                        var inputNull = $(this);
                        var comment = $(this).val();
                        var postid = $(this).data('postid');
                        var userid = $(this).data('userid');
                        var profileid = "<?php echo $profileId; ?>"
                        //                    alert(comment);
                        var commentPlaceholder = $(this).parents('.nf-5').find('ul.add-comment');
                        if (comment == '') {
                            alert("Please Enter Some Text");
                        } else {

                            $.ajax({
                                type: "POST",
                                url: "http://localhost/facebook/core/ajax/comment.php",
                                data: {
                                    comment: comment,
                                    userid: userid,
                                    postid: postid,
                                    profileid: profileid
                                },
                                cache: false,
                                success: function(html) {
                                    $(commentPlaceholder).append(html);
                                    //                                console.log(html);
                                    $(inputNull).val('');
                                    commentHover()
                                }
                            });

                        }
                    }
                });
                commentHover()

                function commentHover() {
                    $(".com-like-react").hover(function() {
                        var mainReact = $(this).find('.com-react-bundle-wrap');
                        $(mainReact).html('<div class="react-bundle align-middle" style="position:absolute;margin-top: -45px; margin-left: -40px; display:flex; background-color:white;padding: 0 2px;border-radius: 25px; box-shadow: 0px 0px 5px black; height:45px; width:270px; justify-content:space-around; transition: 0.3s;z-index:2"><div class="com-like-react-click align-middle"><img class="com-main-icon-css" src="<?php echo " ".BASE_URL."assets/images/react/like.png "; ?>" alt=""></div><div class="com-love-react-click align-middle"><img class="com-main-icon-css" src="<?php echo " ".BASE_URL."assets/images/react/love.png "; ?>" alt=""></div><div class="com-haha-react-click align-middle"><img class="com-main-icon-css" src="<?php echo " ".BASE_URL."assets/images/react/haha.png "; ?>" alt=""></div><div class="com-wow-react-click align-middle"><img class="com-main-icon-css" src="<?php echo " ".BASE_URL."assets/images/react/wow.png "; ?>" alt=""></div><div class="com-sad-react-click align-middle"><img class="com-main-icon-css" src="<?php echo " ".BASE_URL."assets/images/react/sad.png "; ?>" alt=""></div><div class="com-angry-react-click align-middle"><img class="com-main-icon-css" src="<?php echo " ".BASE_URL."assets/images/react/angry.png "; ?>" alt=""></div></div>');
                    }, function() {
                        var mainReact = $(this).find('.com-react-bundle-wrap');
                        $(mainReact).html('');
                    });
                }

                $(document).on('click', '.com-main-icon-css', function() {

                    var com_bundle = $(this).parents('.com-react-bundle-wrap');
                    var commentID = $(com_bundle).data('commentid');
                    var likeReact = $(this).parent();
                    comReactApply(likeReact, commentID);
                });

                function comReactApply(sClass, commentID) {
                    if ($(sClass).hasClass('com-like-react-click')) {
                        comReactSub('like', 'blue', commentID);
                    } else if ($(sClass).hasClass('com-love-react-click')) {
                        comReactSub('love', 'red', commentID);
                    } else if ($(sClass).hasClass('com-haha-react-click')) {
                        comReactSub('haha', 'yellow', commentID);
                    } else if ($(sClass).hasClass('com-wow-react-click')) {
                        comReactSub('wow', 'yellow', commentID);
                    } else if ($(sClass).hasClass('com-sad-react-click')) {
                        comReactSub('sad', 'yellow', commentID);
                    } else if ($(sClass).hasClass('com-angry-react-click')) {
                        comReactSub('angry', 'red', commentID);
                    } else {
                        console.log('not found');
                    }
                }

                function comReactSub(typeR, color, commentID) {
                    var reactColor = '' + typeR + '-color';


                    var parentClass = $('.com-' + typeR + '-react-click.align-middle');

                    var grandParent = $(parentClass).parents(".com-like-react");
                    var postid = $(grandParent).data('postid');
                    var userid = $(grandParent).data('userid');
                    //                var commentid = $(grandParent).data('commentid');
                    var spanClass = $(grandParent).find('.com-like-action-text').find('span');
                    var com_nf_3 = $(grandParent).parent('.com-react').siblings('.com-text-option-wrap').find('.com-nf-3-wrap');
                    if ($(spanClass).attr('class') !== undefined) {

                        if ($(spanClass).hasClass(reactColor)) {
                            $(spanClass).removeAttr('class');
                            spanClass.text("Like");
                            comReactDelete(typeR, postid, userid, commentID, com_nf_3);
                        } else {
                            $(spanClass).removeClass().addClass(reactColor);
                            spanClass.text(typeR);
                            comReactSubmit(typeR, postid, userid, commentID, com_nf_3);
                        }




                    } else {
                        $(spanClass).addClass(reactColor);
                        spanClass.text(typeR);
                        comReactSubmit(typeR, postid, userid, commentID, com_nf_3);
                    }



                }

                $(document).on('click', '.com-like-action-text', function() {

                    var thisParents = $(this).parents('.com-like-react');
                    var postId = $(thisParents).data('postid');
                    var userId = $(thisParents).data('userid');
                    var commentID = $(thisParents).data('commentid');
                    var typeText = $(thisParents).find('.com-like-action-text span');
                    var typeR = $(typeText).text();
                    var com_nf_3 = $(thisParents).parents('.com-react').siblings('.com-text-option-wrap').find('.com-nf-3-wrap');
                    //                    $(thisParents).hide();

                    //                reactNumText--;
                    var spanClass = $(thisParents).find('.com-like-action-text').find('span');
                    if ($(spanClass).attr('class') !== undefined) {

                        $(spanClass).removeAttr('class');
                        spanClass.text("Like");
                        comReactDelete(typeR, postId, userId, commentID, com_nf_3);
                        //                        reactCountDec(reactCount, reactNumText, reactIcon)
                        //                    alert('2');

                    } else {
                        $(spanClass).addClass('like-color');
                        //                    $(likeActionIcon).attr("src", "assets/images/react/like.png").addClass('reactIconSize');
                        spanClass.text("Like");
                        comReactSubmit(typeR, postId, userId, commentID, com_nf_3);
                        //                    alert('3');
                        //                    reactCountInc(postId, reactCount, reactNumText)
                    }
                })

                function comReactSubmit(typeR, postId, userId, commentID, com_nf_3) {
                    var profileid = "<?php echo $profileId;  ?>"

                    $.post('http://localhost/facebook/core/ajax/commentReact.php', {
                        commentid: commentID,
                        reactType: typeR,
                        postId: postId,
                        userId: userId,
                        profileid: profileid


                    }, function(data) {
                        $(com_nf_3).empty().html(data);
                        console.log(data);
                    });

                }

                function comReactDelete(typeR, postId, userId, commentID, com_nf_3) {
                    var profileid = "<?php echo $profileId;  ?>"
                    $.post('http://localhost/facebook/core/ajax/commentReact.php', {
                        delcommentid: commentID,
                        deleteReactType: typeR,
                        postId: postId,
                        userId: userId,
                        profileid: profileid


                    }, function(data) {
                        //                    alert(data);
                        $(com_nf_3).empty().html(data);
                    });
                }

                //.................... comment edit delete start...............
                $(document).on('click', '.com-dot', function() {
                    $('.com-dot').removeAttr('id');
                    $(this).attr('id', 'com-opt-click');
                    var postid = $(this).data('postid');
                    var userid = $(this).data('userid');
                    var commentid = $(this).data('commentid');
                    var postDetails = $(this).siblings('.com-opton-details-containter');
                    $(postDetails).show().html('<div class="com-option-details" style="z-index:2;"><ul><li class="com-edit" data-postid="' + postid + '" data-userid="' + userid + '" data-commentid="' + commentid + '">Edit</li><li class="com-delete" data-postid="' + postid + '" data-userid="' + userid + '" data-commentid="' + commentid + '">Delete</li><li class="com-privacy" data-postid="' + postid + '" data-userid="' + userid + '">privacy</li></ul></div>');
                })
                $(document).on('click', 'li.com-edit', function() {

                    var comTextContainer = $(this).parents('.com-dot-option-wrap').siblings('.com-pro-text').find('.com-text');
                    var addId = $(comTextContainer).attr('id', 'editComPut');
                    var getComText1 = $(comTextContainer).text();
                    var postid = $(comTextContainer).data('postid');
                    var userid = $(comTextContainer).data('userid');
                    var commentid = $(comTextContainer).data('commentid');
                    var profilepic = $(comTextContainer).data('profilepic');
                    var getComText = getComText1.replace(/\s+/g, " ").trim()
                    //                    var getPostImg = $(this).parents('.nf-1').siblings('.nf-2').find('.nf-2-img');
                    //                    var thiss = $(this).parents('.nf-1').siblings('.nf-2').find('.nf-2-img');

                    $('.top-box-show').html('<div class="top-box profile-dialog-show" style="top: 12.5%;left: 22.5%;width: 55%;"><div class="edit-post-header align-middle " style="justify-content: space-between; padding: 10px; height: 20px; background-color: lightgray;font-size: 14px; font-weight:600; "><div class="edit-post-text">Edit Comment</div><div class="edit-post-close" style="padding: 5px; color: gray; cursor:pointer;">x</div></div><div class="edit-post-value" style="border-bottom: 1px solid lightgray;"><div class="status-med"><div class="status-prof"><div class="top-pic"><img src="' + profilepic + '" alt=""></div></div><div class="status-prof-textarea"><textarea data-autoresize rows="5" columns="5" placeholder="" name="textStatus" class="editCom align-middle" style="font-family:sens-serif; font-weight:400; padding:5px;">' + getComText + '</textarea></div></div></div><div class="edit-post-submit" style="position: absolute;right:0; bottom: 0; display: flex; align-items: center; margin: 10px;"><div class="status-privacy-wrap"><div class="status-privacy  "><div class="privacy-icon align-middle"><img src="assets/images/profile/publicIcon.JPG" alt=""></div><div class="privacy-text">Public</div><div class="privacy-downarrow-icon align-middle"><img src="assets/images/watchmore.png" alt=""></div></div><div class="status-privacy-option"></div></div><div class="edit-com-save" style="padding: 3px 15px; background-color: #4267bc;color: white; font-size: 14px; margin-left:5px; cursor:pointer;" data-postid="' + postid + '" data-userid="' + userid + '" data-commentid="' + commentid + '" >Save</div></div></div>');
                });
                $(document).on('click', '.edit-com-save', function() {
                    var postid = $(this).data('postid');
                    var userid = $(this).data('userid');
                    var commentid = $(this).data('commentid');
                    var editedText = $(this).parents('.edit-post-submit').siblings('.edit-post-value').find('.editCom');
                    //                    var editedText = $(this).parents('.com-dot-option-wrap').siblings('.com-pro-text').find('.com-text');;
                    var editedTextVal = $(editedText).val();
                    $.post('http://localhost/facebook/core/ajax/editComment.php', {
                        postid: postid,
                        userid: userid,
                        editedTextVal: editedTextVal,
                        commentid: commentid

                    }, function(data) {
                        $('#editComPut').html(data).removeAttr('id');
                        $('.top-box-show').empty();

                    });




                });
                $(document).on('click', '.com-delete', function() {
                    var postid = $(this).data('postid');
                    var userid = $(this).data('userid');
                    var commentid = $(this).data('commentid');
                    var postContainer = $(this).parents('.new-comment');

                    //                    if (confirm() {

                    var profileid = "<?php echo $profileId; ?>"
                    var r = confirm("Do you want to delete the post?");
                    if (r == true) {
                        $.post('http://localhost/facebook/core/ajax/editComment.php', {
                            deletePost: postid,
                            userid: userid,
                            commentid: commentid,
                            profileid: profileid
                        }, function(data) {

                            $(postContainer).empty();

                        });
                    } else {

                    }

                    //                        } else {
                    //                            alert('not confirmed')
                    //                        })



                });

                //.................... comment edit delete end...............


                /////////////.........comment part end..............///////

                ////////////////........Reply Part Start ............/////////



                $(document).on('click', '.com-reply-action', function() {
                    $('.reply-input').empty();
                    $('.reply-write').hide();
                    var BASE_URL = 'http://localhost/facebook';
                    var userid = $(this).data('userid');
                    var postid = $(this).data('postid');
                    var commentid = $(this).data('commentid');
                    var profilePic = $(this).data('profilepic');
                    var input_field = $(this).parents('.com-text-react-wrap').siblings('.reply-wrap').find('.replyInput');
                    $('.input_field').hide();
                    input_field.html('<div class="reply-write"><div class="com-pro-pic" style="margin-top: 4px;"><a href="#"><div class="top-pic"><img src="' + profilePic + '" alt=""></div></a></div><div class="com-input" style=""><div class="reply-input" style="flex-basis:75%;"><input type="text" name="" id="" class="reply-input-style reply-submit" style="" data-postid="' + postid + '" data-userid="' + userid + '" data-commentid="' + commentid + '" placeholder="Write a reply..."></div><div class="comment-input-option "><div class="imoji-action align-middle"><img src="' + BASE_URL + '/assets/images/emojiAction.JPG" alt=""></div><div class="cam-action align-middle"><img src="' + BASE_URL + '/assets/images/commentCamera.JPG" alt=""></div><div class="gif-action align-middle"><img src="' + BASE_URL + '/assets/images/commentGif.JPG" alt=""></div><div class="sticker-action align-middle"><img src="' + BASE_URL + '/assets/images/commentSticker.JPG" alt=""></div></div></div></div>');
                    replyInput(input_field)

                });

                $(document).on('click', '.com-reply-action-child', function() {
                    $('.reply-input').empty();
                    $('.reply-write').hide();
                    var BASE_URL = 'http://localhost/facebook';
                    var userid = $(this).data('userid');
                    var postid = $(this).data('postid');
                    var commentid = $(this).data('commentid');
                    //                var replyid = $(this).data('replyid');
                    var profilePic = $(this).data('profilepic');
                    var input_field = $(this).parents('.reply-wrap').find('.replyInput');
                    $('.input_field').hide();
                    input_field.html('<div class="reply-write"><div class="com-pro-pic" style="margin-top: 4px;"><a href="#"><div class="top-pic"><img src="' + profilePic + '" alt=""></div></a></div><div class="com-input" style=""><div class="reply-input" style="flex-basis:75%;"><input type="text" name="" id="" class="reply-input-style reply-submit" style="" data-postid="' + postid + '" data-userid="' + userid + '" data-commentid="' + commentid + '" placeholder="Write a reply..."></div><div class="comment-input-option "><div class="imoji-action align-middle"><img src="' + BASE_URL + '/assets/images/emojiAction.JPG" alt=""></div><div class="cam-action align-middle"><img src="' + BASE_URL + '/assets/images/commentCamera.JPG" alt=""></div><div class="gif-action align-middle"><img src="' + BASE_URL + '/assets/images/commentGif.JPG" alt=""></div><div class="sticker-action align-middle"><img src="' + BASE_URL + '/assets/images/commentSticker.JPG" alt=""></div></div></div></div>');
                    replyInput(input_field)

                });
                replyInput()

                function replyInput(input_field) {
                    $(input_field).find('input.reply-input-style.reply-submit').focus();
                    $('input.reply-input-style.reply-submit').keyup(function(e) {
                        if (e.keyCode == 13) {
                            var inputNull = $(this);
                            var comment = $(this).val();
                            var postid = $(this).data('postid');
                            var userid = $(this).data('userid');
                            var commentid = $(this).data('commentid');
                            var profileid = "<?php echo $profileId; ?>"
                            alert(userid);
                            var replyPlaceholder = $(this).parents('.replyInput').siblings('.reply-text-wrap').find('.old-replay');
                            if (comment == '') {
                                alert("Please Enter Some Text");
                            } else {

                                $.ajax({
                                    type: "POST",
                                    url: "http://localhost/facebook/core/ajax/reply.php",
                                    data: {
                                        replyComment: comment,
                                        userid: userid,
                                        postid: postid,
                                        commentid: commentid,
                                        profileid: profileid
                                    },
                                    cache: false,
                                    success: function(html) {
                                        $(replyPlaceholder).append(html);
                                        //                                console.log(html);
                                        $(inputNull).val('');
                                        replyHover()
                                    }
                                });

                            }
                        }
                    });
                }
                replyHover()

                function replyHover() {
                    $(".com-like-react.reply").hover(function() {
                        var mainReact = $(this).find('.com-react-bundle-wrap.reply');
                        $(mainReact).html('<div class="react-bundle  align-middle" style="position:absolute;margin-top: -45px; margin-left: -40px; display:flex; background-color:white;padding: 0 2px;border-radius: 25px; box-shadow: 0px 0px 5px black; height:45px; width:270px; justify-content:space-around; transition: 0.3s;z-index:2"><div class="com-like-react-click  align-middle"><img class="reply-main-icon-css " src="<?php echo " ".BASE_URL."assets/images/react/like.png "; ?>" alt=""></div><div class="com-love-react-click align-middle"><img class="reply-main-icon-css " src="<?php echo " ".BASE_URL."assets/images/react/love.png "; ?>" alt=""></div><div class="com-haha-react-click  align-middle"><img class="reply-main-icon-css " src="<?php echo " ".BASE_URL."assets/images/react/haha.png "; ?>" alt=""></div><div class="com-wow-react-click  align-middle"><img class="reply-main-icon-css " src="<?php echo " ".BASE_URL."assets/images/react/wow.png "; ?>" alt=""></div><div class="com-sad-react-click  align-middle"><img class="reply-main-icon-css " src="<?php echo " ".BASE_URL."assets/images/react/sad.png "; ?>" alt=""></div><div class="com-angry-react-click  align-middle"><img class="reply-main-icon-css " src="<?php echo " ".BASE_URL."assets/images/react/angry.png "; ?>" alt=""></div></div>');
                    }, function() {
                        var mainReact = $(this).find('.com-react-bundle-wrap.reply');
                        $(mainReact).html('');
                    });
                }

                $(document).on('click', '.reply-main-icon-css', function() {

                    var com_bundle = $(this).parents('.com-react-bundle-wrap.reply');
                    var commentID = $(com_bundle).data('commentid');
                    var commentparentid = $(com_bundle).data('commentparentid');
                    var likeReact = $(this).parent();
                    replyReactApply(likeReact, commentID, commentparentid);

                });

                function replyReactApply(sClass, commentID, commentparentid) {
                    if ($(sClass).hasClass('com-like-react-click')) {
                        replyReactSub('like', 'blue', commentID, commentparentid);
                    } else if ($(sClass).hasClass('com-love-react-click')) {
                        replyReactSub('love', 'red', commentID, commentparentid);
                    } else if ($(sClass).hasClass('com-haha-react-click')) {
                        replyReactSub('haha', 'yellow', commentID, commentparentid);
                    } else if ($(sClass).hasClass('com-wow-react-click')) {
                        replyReactSub('wow', 'yellow', commentID, commentparentid);
                    } else if ($(sClass).hasClass('com-sad-react-click')) {
                        replyReactSub('sad', 'yellow', commentID, commentparentid);
                    } else if ($(sClass).hasClass('com-angry-react-click')) {
                        replyReactSub('angry', 'red', commentID, commentparentid);
                    } else {
                        console.log('not found');
                    }
                }

                function replyReactSub(typeR, color, commentID, commentparentid) {
                    var reactColor = '' + typeR + '-color';

                    var parentClass = $('.com-' + typeR + '-react-click.align-middle');

                    var grandParent = $(parentClass).parents(".com-like-react");
                    var postid = $(grandParent).data('postid');
                    var userid = $(grandParent).data('userid');
                    //                var commentid = $(grandParent).data('commentid');
                    var spanClass = $(grandParent).find('.reply-like-action-text').find('span');
                    var com_nf_3 = $(grandParent).parent('.com-react').siblings('.reply-text-option-wrap').find('.com-nf-3-wrap');

                    if ($(spanClass).attr('class') !== undefined) {

                        if ($(spanClass).hasClass(reactColor)) {
                            $(spanClass).removeAttr('class');
                            spanClass.text("Like");
                            replyReactDelete(typeR, postid, userid, commentID, commentparentid, com_nf_3);

                        } else {
                            $(spanClass).removeClass().addClass(reactColor);
                            spanClass.text(typeR);
                            replyReactSubmit(typeR, postid, userid, commentID, commentparentid, com_nf_3);

                        }




                    } else {
                        $(spanClass).addClass(reactColor);
                        spanClass.text(typeR);
                        replyReactSubmit(typeR, postid, userid, commentID, commentparentid, com_nf_3);

                    }



                }

                $(document).on('click', '.reply-like-action-text', function() {

                    var thisParents = $(this).parents('.com-like-react');
                    var postId = $(thisParents).data('postid');
                    var userId = $(thisParents).data('userid');
                    var commentID = $(thisParents).data('commentid');
                    var commentparentid = $(thisParents).data('commentparentid');
                    var typeText = $(thisParents).find('.reply-like-action-text span');
                    var typeR = $(typeText).text();
                    var reactColor = '' + typeR + '-color';
                    var com_nf_3 = $(thisParents).parent('.com-react').siblings('.reply-text-option-wrap').find('.com-nf-3-wrap');
                    //                $(com_nf_3).hide();

                    //                reactNumText--;
                    var spanClass = $(thisParents).find('.reply-like-action-text').find('span');

                    if ($(spanClass).attr('class') !== undefined) {

                        if ($(spanClass).hasClass(reactColor)) {
                            $(spanClass).removeAttr('class');
                            spanClass.text("Like");
                            replyReactDelete(typeR, postId, userId, commentID, commentparentid, com_nf_3);

                        } else {
                            $(spanClass).removeClass().addClass(reactColor);
                            spanClass.text(typeR);
                            replyReactSubmit(typeR, postId, userId, commentID, commentparentid, com_nf_3);

                        }




                    } else {
                        $(spanClass).addClass(reactColor);
                        //                    $(likeActionIcon).attr("src", "assets/images/react/like.png").addClass('reactIconSize');
                        spanClass.text("Like");
                        replyReactSubmit(typeR, postId, userId, commentID, commentparentid, com_nf_3);
                        //                    reactCountInc(postId, reactCount, reactNumText)

                    }
                })

                function replyReactSubmit(typeR, postId, userId, commentID, commentparentid, com_nf_3) {
                    var profileid = "<?php echo $profileId; ?>"
                    $.post('http://localhost/facebook/core/ajax/replyReact.php', {
                        commentid: commentID,
                        reactType: typeR,
                        postId: postId,
                        userId: userId,
                        commentparentid: commentparentid,
                        profileid: profileid



                    }, function(data) {
                        $(com_nf_3).empty().html(data);
                        //                    console.log(data);
                    });

                }

                function replyReactDelete(typeR, postId, userId, commentID, commentparentid, com_nf_3) {
                    var profileid = "<?php echo $profileId; ?>"
                    $.post('http://localhost/facebook/core/ajax/replyReact.php', {
                        delcommentid: commentID,
                        deleteReactType: typeR,
                        postId: postId,
                        userId: userId,
                        commentparentid: commentparentid,
                        profileid: profileid


                    }, function(data) {
                        //                    alert(data);
                        $(com_nf_3).empty().html(data);
                    });
                }



                //.................... reply edit delete start...............
                $(document).on('click', '.reply-dot', function() {
                    $('.com-dot').removeAttr('id');
                    $(this).attr('id', 'reply-opt-click');
                    var postid = $(this).data('postid');
                    var userid = $(this).data('userid');
                    var commentid = $(this).data('commentid');
                    var replyid = $(this).data('replyid');
                    var postDetails = $(this).siblings('.reply-option-details-containter');
                    $(postDetails).show().html('<div class="reply-option-details" style="z-index:2;"><ul><li class="reply-edit" data-postid="' + postid + '" data-userid="' + userid + '" data-commentid="' + commentid + '">Edit</li><li class="reply-delete" data-postid="' + postid + '" data-userid="' + userid + '" data-commentid="' + commentid + '" data-replyid="' + replyid + '">Delete</li><li class="reply-privacy" data-postid="' + postid + '" data-userid="' + userid + '">privacy</li></ul></div>');
                })
                $(document).on('click', 'li.reply-edit', function() {

                    var comTextContainer = $(this).parents('.reply-dot-option-wrap').siblings('.com-pro-text').find('.com-text');
                    var addId = $(comTextContainer).attr('id', 'editReplyPut');
                    var getComText1 = $(comTextContainer).text();
                    var postid = $(comTextContainer).data('postid');
                    var userid = $(comTextContainer).data('userid');
                    var commentid = $(comTextContainer).data('commentid');
                    var replyid = $(comTextContainer).data('replyid');
                    var profilepic = $(comTextContainer).data('profilepic');
                    var getComText = getComText1.replace(/\s+/g, " ").trim()
                    //                    var getPostImg = $(this).parents('.nf-1').siblings('.nf-2').find('.nf-2-img');
                    //                    var thiss = $(this).parents('.nf-1').siblings('.nf-2').find('.nf-2-img');

                    $('.top-box-show').html('<div class="top-box profile-dialog-show" style="top: 12.5%;left: 22.5%;width: 55%;"><div class="edit-post-header align-middle " style="justify-content: space-between; padding: 10px; height: 20px; background-color: lightgray;font-size: 14px; font-weight:600; "><div class="edit-post-text">Edit Comment</div><div class="edit-post-close" style="padding: 5px; color: gray; cursor:pointer;">x</div></div><div class="edit-post-value" style="border-bottom: 1px solid lightgray;"><div class="status-med"><div class="status-prof"><div class="top-pic"><img src="' + profilepic + '" alt=""></div></div><div class="status-prof-textarea"><textarea data-autoresize rows="5" columns="5" placeholder="" name="textStatus" class="editReply align-middle" style="font-family:sens-serif; font-weight:400; padding:5px;">' + getComText + '</textarea></div></div></div><div class="edit-post-submit" style="position: absolute;right:0; bottom: 0; display: flex; align-items: center; margin: 10px;"><div class="status-privacy-wrap"><div class="status-privacy  "><div class="privacy-icon align-middle"><img src="assets/images/profile/publicIcon.JPG" alt=""></div><div class="privacy-text">Public</div><div class="privacy-downarrow-icon align-middle"><img src="assets/images/watchmore.png" alt=""></div></div><div class="status-privacy-option"></div></div><div class="edit-reply-save" style="padding: 3px 15px; background-color: #4267bc;color: white; font-size: 14px; margin-left:5px; cursor:pointer;" data-postid="' + postid + '" data-userid="' + userid + '" data-commentid="' + commentid + '" data-replyid="' + replyid + '">Save</div></div></div>');
                });
                $(document).on('click', '.edit-reply-save', function() {
                    var postid = $(this).data('postid');
                    var userid = $(this).data('userid');
                    var commentid = $(this).data('commentid');
                    var replyid = $(this).data('replyid');
                    var editedText = $(this).parents('.edit-post-submit').siblings('.edit-post-value').find('.editReply');
                    //                    var editedText = $(this).parents('.com-dot-option-wrap').siblings('.com-pro-text').find('.com-text');;
                    var editedTextVal = $(editedText).val();
                    $.post('http://localhost/facebook/core/ajax/editReply.php', {
                        postid: postid,
                        userid: userid,
                        editedTextVal: editedTextVal,
                        commentid: commentid,
                        replyid: replyid

                    }, function(data) {
                        $('#editReplyPut').html(data).removeAttr('id');
                        $('.top-box-show').empty();

                    });




                });
                $(document).on('click', '.reply-delete', function() {
                    var postid = $(this).data('postid');
                    var userid = $(this).data('userid');
                    var commentid = $(this).data('commentid');
                    var replyid = $(this).data('replyid');
                    var postContainer = $(this).parents('.new-reply');

                    //                    if (confirm() {


                    var r = confirm("Do you want to delete the post?");
                    if (r == true) {
                        $.post('http://localhost/facebook/core/ajax/editReply.php', {
                            deletePost: postid,
                            userid: userid,
                            commentid: commentid,
                            replyid: replyid
                        }, function(data) {

                            $(postContainer).empty();

                        });
                    } else {

                    }

                    //                        } else {
                    //                            alert('not confirmed')
                    //                        })



                });

                //.................... reply edit delete end...............
                ////////////////........Reply Part End............/////////


                ////////////............Post Option Start.............///////////
                $(document).on('click', '.post-option', function() {
                    $('.post-option').removeAttr('id');
                    $(this).attr('id', 'opt-click');
                    var postid = $(this).data('postid');
                    var userid = $(this).data('userid');
                    var postDetails = $(this).siblings('.post-option-details-container');
                    $(postDetails).show().html('<div class="post-option-details"><ul><li class="post-edit" data-postid="' + postid + '" data-userid="' + userid + '">Edit</li><li class="post-delete" data-postid="' + postid + '" data-userid="' + userid + '">Delete</li><li class="post-privacy" data-postid="' + postid + '" data-userid="' + userid + '">privacy</li></ul></div>');
                })
                $(document).on('click', '.shared-post-option', function() {
                    $('.post-option').removeAttr('id');
                    $(this).attr('id', 'opt-click');
                    var postid = $(this).data('postid');
                    var userid = $(this).data('userid');
                    var postDetails = $(this).siblings('.shared-post-option-details-container');
                    $(postDetails).show().html('<div class="shared-post-option-details"><ul><li class="shared-post-edit" data-postid="' + postid + '" data-userid="' + userid + '">Edit</li><li class="shared-post-delete" data-postid="' + postid + '" data-userid="' + userid + '">Delete</li><li class="post-privacy" data-postid="' + postid + '" data-userid="' + userid + '">privacy</li></ul></div>');
                })




                $(document).on('click', 'li.post-edit', function() {

                    var statusTextContainer = $(this).parents('.nf-1').siblings('.nf-2').find('.nf-2-text');
                    var addId = $(statusTextContainer).attr('id', 'editPostPut');
                    var getPostText1 = $(statusTextContainer).text();
                    var postid = $(statusTextContainer).data('postid');
                    var userid = $(statusTextContainer).data('userid');
                    var getPostImg = $(this).parents('.nf-1').siblings('.nf-2').find('.nf-2-img');
                    var thiss = $(this).parents('.nf-1').siblings('.nf-2').find('.nf-2-img');
                    var profilepic = $(statusTextContainer).data('profilepic');
                    var getPostText = getPostText1.replace(/\s+/g, " ").trim();


                    $('.top-box-show').html('<div class="top-box profile-dialog-show" style="top: 12.5%;left: 22.5%;width: 55%;"><div class="edit-post-header align-middle " style="justify-content: space-between; padding: 10px; height: 20px; background-color: lightgray;font-size: 14px; font-weight:600; "><div class="edit-post-text">Edit Post</div><div class="edit-post-close" style="padding: 5px; color: gray; cursor:pointer;">x</div></div><div class="edit-post-value" style="border-bottom: 1px solid lightgray;"><div class="status-med"><div class="status-prof"><div class="top-pic"><img src="' + profilepic + '" alt=""></div></div><div class="status-prof-textarea"><textarea data-autoresize rows="5" columns="5" placeholder="" name="textStatus" class="editStatus align-middle" style="font-family:sens-serif; font-weight:400; padding:5px;">' + getPostText + '</textarea></div></div></div><div class="edit-post-submit" style="position: absolute;right:0; bottom: 0; display: flex; align-items: center; margin: 10px;"><div class="status-privacy-wrap"><div class="status-privacy  "><div class="privacy-icon align-middle"><img src="assets/images/profile/publicIcon.JPG" alt=""></div><div class="privacy-text">Public</div><div class="privacy-downarrow-icon align-middle"><img src="assets/images/watchmore.png" alt=""></div></div><div class="status-privacy-option"></div></div><div class="edit-post-save" style="padding: 3px 15px; background-color: #4267bc;color: white; font-size: 14px; margin-left:5px; cursor:pointer;" data-postid="' + postid + '" data-userid="' + userid + '" data-tag="' + thiss + '">Save</div></div></div>');
                });

                $(document).on('click', 'li.shared-post-edit', function() {

                    var statusTextContainer = $(this).parents('.nf-1').siblings('.nf-2').find('.nf-2-text-span');
                    var addId = $(statusTextContainer).attr('id', 'editPostPut');
                    var getPostText1 = $(statusTextContainer).text();
                    var postid = $(statusTextContainer).data('postid');
                    var userid = $(statusTextContainer).data('userid');
                    var getPostImg = $(this).parents('.nf-1').siblings('.nf-2').find('.nf-2-img');
                    var thiss = $(this).parents('.nf-1').siblings('.nf-2').find('.nf-2-img');
                    var profilepic = $(statusTextContainer).data('profilepic');
                    var getPostText = getPostText1.replace(/\s+/g, " ").trim();


                    $('.top-box-show').html('<div class="top-box profile-dialog-show" style="top: 12.5%;left: 22.5%;width: 55%;"><div class="edit-post-header align-middle " style="justify-content: space-between; padding: 10px; height: 20px; background-color: lightgray;font-size: 14px; font-weight:600; "><div class="edit-post-text">Edit Post</div><div class="shared-edit-post-close" style="padding: 5px; color: gray; cursor:pointer;">x</div></div><div class="edit-post-value" style="border-bottom: 1px solid lightgray;"><div class="status-med"><div class="status-prof"><div class="top-pic"><img src="' + profilepic + '" alt=""></div></div><div class="status-prof-textarea"><textarea data-autoresize rows="5" columns="5" placeholder="" name="textStatus" class="sharedEditStatus align-middle" style="font-family:sens-serif; font-weight:400; padding:5px;">' + getPostText + '</textarea></div></div></div><div class="edit-post-submit" style="position: absolute;right:0; bottom: 0; display: flex; align-items: center; margin: 10px;"><div class="status-privacy-wrap"><div class="status-privacy  "><div class="privacy-icon align-middle"><img src="assets/images/profile/publicIcon.JPG" alt=""></div><div class="privacy-text">Public</div><div class="privacy-downarrow-icon align-middle"><img src="assets/images/watchmore.png" alt=""></div></div><div class="status-privacy-option"></div></div><div class="shared-edit-post-save" style="padding: 3px 15px; background-color: #4267bc;color: white; font-size: 14px; margin-left:5px; cursor:pointer;" data-postid="' + postid + '" data-userid="' + userid + '" data-tag="' + thiss + '">Save</div></div></div>');
                });


                $(document).on('click', '.edit-post-close', function() {
                    //                    alert($('.editStatus').val());
                    $('.top-box-show').empty();
                });
                $(document).on('click', '.shared-edit-post-close', function() {
                    //                    alert($('.editStatus').val());
                    $('.top-box-show').empty();
                });

                $(document).on('click', '.edit-post-save', function() {
                    var postid = $(this).data('postid');
                    var userid = $(this).data('userid');
                    var editedText = $(this).parents('.edit-post-submit').siblings('.edit-post-value').find('.editStatus');
                    var editedTextVal = $(editedText).val();
                    console.log(postid, userid, editedText, editedTextVal)

                    $.post('http://localhost/facebook/core/ajax/editPost.php', {
                        postid: postid,
                        userid: userid,
                        editedTextVal: editedTextVal

                    }, function(data) {
                        $('#editPostPut').html(data).removeAttr('id');
                        $('.top-box-show').empty();

                    });




                });
                $(document).on('click', '.shared-edit-post-save', function() {
                    var postid = $(this).data('postid');
                    var userid = $(this).data('userid');
                    var editedText = $(this).parents('.edit-post-submit').siblings('.edit-post-value').find('.sharedEditStatus');
                    var editedTextVal = $(editedText).val();
                    console.log(postid, userid, editedText, editedTextVal)

                    $.post('http://localhost/facebook/core/ajax/sharedEditPost.php', {
                        sharedpostid: postid,
                        userid: userid,
                        editedTextVal: editedTextVal

                    }, function(data) {
                        $('#editPostPut').html(data).removeAttr('id');
                        $('.top-box-show').empty();

                    });




                });

                $(document).on('click', '.post-delete', function() {
                    var postid = $(this).data('postid');
                    var userid = $(this).data('userid');
                    var postContainer = $(this).parents('.profile-timeline');

                    //                    if (confirm() {


                    var r = confirm("Do you want to delete the post?");
                    if (r == true) {
                        $.post('http://localhost/facebook/core/ajax/editPost.php', {
                            deletePost: postid,
                            userid: userid
                        }, function(data) {

                            $(postContainer).empty();

                        });
                    } else {

                    }


                });





                $(document).on('click', '.shared-post-delete', function() {
                    var postid = $(this).data('postid');
                    var userid = $(this).data('userid');
                    var postContainer = $(this).parents('.profile-timeline');

                    //                    if (confirm() {


                    var r = confirm("Do you want to delete the post?");
                    if (r == true) {
                        $.post('http://localhost/facebook/core/ajax/sharedEditPost.php', {
                            deletePost: postid,
                            userid: userid
                        }, function(data) {

                            $(postContainer).empty();

                        });
                    } else {

                    }

                    //                        } else {
                    //                            alert('not confirmed')
                    //                        })



                });


                ////////////............Post Option End.............////////////


            });

            //function AjaxSendForm(url, placeholder, form, append) {
            //var data = $(form).serialize();
            //append = (append === undefined ? false : true); // whatever, it will evaluate to true or false only
            //$.ajax({
            //    type: 'POST',
            //    url: url,
            //    data: data,
            //    beforeSend: function() {
            //        // setting a timeout
            //        $(placeholder).addClass('loading');
            //    },
            //    success: function(data) {
            //        if (append) {
            //            $(placeholder).append(data);
            //        } else {
            //            $(placeholder).html(data);
            //        }
            //    },
            //    error: function(xhr) { // if error occured
            //        alert("Error occured.please try again");
            //        $(placeholder).append(xhr.statusText + xhr.responseText);
            //        $(placeholder).removeClass('loading');
            //    },
            //    complete: function() {
            //        $(placeholder).removeClass('loading');
            //    },
            //    dataType: 'html'
            //});
            //}


            $(document).mouseup(function(e) {
                var container = new Array();
                container.push($('.add-cov-opt'));
                container.push($('.profile-dialog-show'));
                container.push($('.top-box'));
                container.push($('.post-option-details'));
                container.push($('.setting-logout-wrap'));
                //            container.push($('#item_2'));

                $.each(container, function(key, value) {
                    if (!$(value).is(e.target) // if the target of the click isn't the container...
                        &&
                        $(value).has(e.target).length === 0) // ... nor a descendant of the container
                    {
                        $(value).hide();
                    }
                });
            });
            $(document).mouseup(function(e) {
                var container = new Array();
                container.push($('.post-option-details-container'));
                container.push($('.shared-post-option-details-container'));
                container.push($('.com-opton-details-containter'));
                container.push($('.reply-option-details-containter'));
                //            container.push($('#item_2'));

                $.each(container, function(key, value) {
                    if (!$(value).is(e.target) // if the target of the click isn't the container...
                        &&
                        $(value).has(e.target).length === 0) // ... nor a descendant of the container
                    {
                        $(value).empty();
                    }
                });
            });
            $(document).mouseup(function(e) {
                var container = new Array();
                container.push($('.profile-status-write'));


                //            container.push($('#item_2'));

                $.each(container, function(key, value) {
                    if (!$(value).is(e.target) // if the target of the click isn't the container...
                        &&
                        $(value).has(e.target).length === 0) // ... nor a descendant of the container
                    {
                        $('.status-share-button-wrap').hide('0.2');
                    }
                });
            });

        </script>

    </body>

    </html>

    <?php
		}

?>
