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


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>facebook</title>
    <link rel="stylesheet" href="assets/css/style.css">
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
                    <div class="search-icon"></div>
                </div>
            </div>
            <div class="top_right_part">
                <div class="top-pic-name-wrap">
                    <a href="profile.php" class="top-pic-name">
                        <div class="top-pic"><img src="assets/images/me.jpg" alt=""></div>
                        <div class="top-name top-css">Habib</div>
                    </a>
                </div>
                <a href="home.php">
                    <div class="top-home top-css border-left">
                        Home
                    </div>
                </a>
                <a href="create.php">
                    <div class="top-create top-css border-left"> Create</div>
                </a>
                <div class="top-request top-css top-icon border-left">
                    <img src="assets/images/request.png" alt="">
                </div>
                <div class="top-messanger top-css top-icon ">
                    <img src="assets/images/messanger.png" alt="">
                </div>
                <div class="top-notification top-css top-icon">
                    <img src="assets/images/Notification.png" alt="">
                </div>
                <div class="top-help top-css top-icon border-left">
                    <img src="assets/images/help.png" alt="">
                </div>
                <div class="top-more top-css top-icon">
                    <img src="assets/images/watchmore.png" alt="">
                </div>
            </div>
        </div>
    </header>
    <!--   ////////.........end header tob bar................//////-->


    <!--   ////////.........start main area................//////-->
    <main>
        <div class="main_area">
            <!--   ////////.........start first section................//////-->

            <div class="first-section">
                <div class="active-wrap top-pic-name-wrap   ">
                    <a href="profile.php" class="top-pic-name">
                        <div class="top-pic"><img src="assets/images/me.jpg" alt=""></div>
                        <div class="top-name top-css" style="color:black;">Habib</div>
                    </a>
                </div>
                <br>

                <div class="news-feed">
                    <a href="index.php" class="active-wrap-2">
                        <div class="right-nav-icon">
                            <img src="assets/images/newsfeed.JPG" alt="">
                        </div>
                        <div class="right-nav-text">News Feed</div>
                    </a>
                </div>


                <div class="news-feed ">
                    <a href="messenger.php" class="active-wrap-3">
                        <div class="right-nav-icon">
                            <img src="assets/images/msginnews.JPG" alt="">
                        </div>
                        <div class="right-nav-text">Messenger</div>
                    </a>
                </div>


                <div class="news-feed ">
                    <a href="watch.php" class="active-wrap-3">
                        <div class="right-nav-icon">
                            <img src="assets/images/watchnewsfeed.JPG" alt="">
                        </div>
                        <div class="right-nav-text">Watch</div>
                    </a>
                </div>
                <p class="first-sect-head">Shortcuts</p>

                <div class="sortcut-section">
                    <a href="" class="group-shortcuts">
                        <div class="right-nav-icon">
                            <img src="assets/images/pagenewsfeed.JPG" alt="">
                        </div>
                        <div class="right-nav-text">Upwork Bangladesh</div>
                    </a>
                </div>
                <div class="sortcut-section">
                    <a href="" class="group-shortcuts">
                        <div class="right-nav-icon">
                            <img src="assets/images/groupnewsfeed.JPG" alt="">
                        </div>
                        <div class="right-nav-text">Upwork Bangladesh</div>
                    </a>
                </div>
                <div class="sortcut-section">
                    <a href="" class="group-shortcuts">
                        <div class="right-nav-icon">
                            <img src="assets/images/profoundlynewsfeed.JPG" alt="">
                        </div>
                        <div class="right-nav-text">profoundly</div>
                    </a>
                </div>
                <p class="first-sect-head">Explore</p>

                <div class="sortcut-section">
                    <a href="" class="group-shortcuts">
                        <div class="right-nav-icon">
                            <img src="assets/images/page_color_newsfeed.JPG" alt="">
                        </div>
                        <div class="right-nav-text">Pages</div>
                    </a>
                </div>
                <div class="sortcut-section">
                    <a href="" class="group-shortcuts">
                        <div class="right-nav-icon">
                            <img src="assets/images/group_color_newsfeed.JPG" alt="">
                        </div>
                        <div class="right-nav-text">Groups</div>
                    </a>
                </div>
                <div class="sortcut-section">
                    <a href="" class="group-shortcuts">
                        <div class="right-nav-icon">
                            <img src="assets/images/event.JPG" alt="">
                        </div>
                        <div class="right-nav-text">Events</div>
                    </a>
                </div>
                <div class="sortcut-section">
                    <a href="" class="group-shortcuts">
                        <div class="right-nav-icon">
                            <img src="assets/images/saved.JPG" alt="">
                        </div>
                        <div class="right-nav-text">Saved</div>
                    </a>
                </div>
                <div class="sortcut-section">
                    <a href="" class="group-shortcuts">
                        <div class="right-nav-icon">
                            <img src="assets/images/fundraises.JPG" alt="">
                        </div>
                        <div class="right-nav-text">Fundraisers</div>
                    </a>
                </div>




            </div>
            <!--   ////////.........end first section................//////-->

            <!--   ////////.........start second section................//////-->

            <div class="second-section">
                <!--                ............ Start Status write part................-->
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
                        <div class="status-prof">
                            <textarea name="" id="status" placeholder=""></textarea>
                        </div>
                    </div>
                    <div class="status-bot">
                        <div class="status-bot-1">
                            <img src="assets/images/photo.JPG" alt="">
                            <div class="status-bot-text">Photo/Video</div>
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
                </div>
                <!--                ............ end Status write part................-->

                <!--                ............ Start timeline part................-->

                <div class="news-feed-comp">
                    <div class="news-feed-text">
                        <div class="nf-1">
                            <div class="nf-1-left">
                                <div class="nf-pro-pic">
                                    <a href="">
                                        <img src="assets/images/me.jpg" class="pro-pic" alt="">
                                    </a>
                                </div>
                                <div class="nf-pro-name-time">
                                    <div class="nf-pro-name">
                                        <a href="" class="nf-pro-name">Raihan Kabir</a>

                                    </div>
                                    <div class="nf-pro-time-privacy">
                                        <div class="nf-pro-time">2 hrs</div>
                                        <div class="nf-pro-privacy"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="nf-1-right">
                                <div class="nf-1-right-dott">
                                    ...
                                </div>

                            </div>
                        </div>
                        <div class="nf-2">
                            <div class="nf-2-text">
                                How is going everything? This is cool to work in such environment.
                            </div>
                        </div>
                        <div class="nf-3">
                            <div class="nf-3-react-icon">
                                <div class="likeReact">

                                </div>

                            </div>
                            <div class="nf-3-react-username">
                                Farhan kabir, Shafiq Rahim and 38 others
                            </div>
                        </div>
                        <div class="nf-4">
                            <div class="like-action ra">
                                <div class="like-action-icon">
                                    <img src="assets/images/likeAction.JPG" alt="">
                                </div>
                                <div class="like-action-text">Like</div>
                            </div>
                            <div class="comment-action ra">
                                <div class="comment-action-icon">
                                    <img src="assets/images/commentAction.JPG" alt="">
                                </div>
                                <div class="comment-action-text">Comment</div>
                            </div>
                            <div class="share-action ra">
                                <div class="share-action-icon"><img src="assets/images/shareAction.JPG" alt=""></div>
                                <div class="share-action-text">Share</div>
                            </div>
                        </div>
                        <div class="nf-5">
                            <div class="comment-list">
                                <div class="com-details">
                                    <div class="com-pro-pic">
                                        <a href="#">
                                            <div class="top-pic"><img src="assets/images/me.jpg" alt=""></div>
                                        </a>
                                    </div>
                                    <div class="com-pro-wrap">
                                        <div class="com-pro-text">
                                            <a href="#"><span class="nf-pro-name">Raihan Kabir</span></a> This is comment section for test purpose.This is comment section for test purpose.This is comment section for test purpose.This is comment section for test purpose.
                                        </div>
                                        <div class="com-react">
                                            <div class="com-like-react">Like</div>
                                            <div class="com-reply-action">Reply</div>
                                            <div class="com-time"> 11h </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="comment-write">
                                <div class="com-pro-pic">
                                    <a href="#">
                                        <div class="top-pic"><img src="assets/images/me.jpg" alt=""></div>
                                    </a>
                                </div>
                                <div class="com-input">
                                    <input type="text" name="" id="" style="width:100%;border:none;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="news-feed-photo"></div>
                </div>
                <!--                ............ end timeline................-->
            </div>
            <div class="third-section">
                <div class="story-wrap">
                    <div class="story-head">
                        Stories
                    </div>
                    <div class="add-story">
                        <div class="add-circle">
                            +
                        </div>
                        <div class="add-your-story-wrap">
                            <div class="add-your-story">
                                Add to Your Story
                            </div>
                            <div class="add-story-details">
                                Share a photo, video or write something
                            </div>
                        </div>
                    </div>
                    <a href="">
                        <div class="user-story">
                            <div class="story-profile-pic">
                                <img src="assets/images/me.jpg" class="story-photo" alt="">
                            </div>
                            <div class="story-profile-wrap">
                                <div class="story-profile-name">Raihan Kabir</div>
                                <div class="story-profile-time">2 hours ago</div>
                            </div>
                        </div>
                    </a>
                    <a href="">
                        <div class="user-story">
                            <div class="story-profile-pic">
                                <img src="assets/images/me2.jpg" class="story-photo" alt="">
                            </div>
                            <div class="story-profile-wrap">
                                <div class="story-profile-name">Mahir Shishir</div>
                                <div class="story-profile-time">3 hours ago</div>
                            </div>
                        </div>
                    </a>
                    <a href="">
                        <div class="user-story">
                            <div class="story-profile-pic">
                                <img src="assets/images/me3.png" class="story-photo" alt="">
                            </div>
                            <div class="story-profile-wrap">
                                <div class="story-profile-name">Raihan Jebin</div>
                                <div class="story-profile-time">1 hours ago</div>
                            </div>
                        </div>
                    </a>
                    <div class="more-story"><img src="assets/images/seeMoreStory.JPG" alt="">
                        <div>See More</div>
                    </div>
                </div>
                <div class="birthday-wrap">
                    <a href="" class="birthday-gift">
                        <div class="birth-img">
                            <img src="assets/images/birthdayGift.JPG" alt="">
                        </div>
                        <div class="birth-name-wrap"><span class="birth-name">Mahir Shishir</span><span class="birth-date">'s birthday today</span></div>
                    </a>
                </div>
                <div class="friend-request-wrap">
                    <div class="friend-request-text-wrap">
                        <div class="friend-request-text">Friend Request</div>
                        <div class="friend-request-seeAll">See All</div>
                    </div>

                    <div class="friend-request-user">
                        <div class="request-profile-pic">
                            <img src="assets/images/me3.png" class="request-photo" alt="">
                        </div>
                        <div class="request-name-conf">
                            <div class="req-name">Maruf Hossain</div>
                            <div class="req-conf">
                                <div class="req-conf-yes">Confirm</div>
                                <div class="req-conf-del">Delete</div>
                            </div>
                        </div>
                    </div>
                    <div class="friend-request-user">
                        <div class="request-profile-pic">
                            <img src="assets/images/me2.jpg" class="request-photo" alt="">
                        </div>
                        <div class="request-name-conf">
                            <div class="req-name">Kamrul Hassan</div>
                            <div class="req-conf">
                                <div class="req-conf-yes">Confirm</div>
                                <div class="req-conf-del">Delete</div>
                            </div>
                        </div>
                    </div>
                    <div class="friend-request-user">
                        <div class="request-profile-pic">
                            <img src="assets/images/me.jpg" class="request-photo" alt="">
                        </div>
                        <div class="request-name-conf">
                            <div class="req-name">Shareef Kabir</div>
                            <div class="req-conf">
                                <div class="req-conf-yes">Confirm</div>
                                <div class="req-conf-del">Delete</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="fourth-section">
                <div class="active-user-wrap">
                    <div class="active-user-pro">
                        <div class="active-user-photo">
                            <img src="assets/images/me.jpg" class="active-user-pro-pic" alt="">
                            <div class="active-user-name">
                                Jarib Farhan
                            </div>
                        </div>

                        <div class="active-user-circle"></div>
                    </div>
                    <div class="active-user-pro">
                        <div class="active-user-photo">
                            <img src="assets/images/me2.jpg" class="active-user-pro-pic" alt="">
                            <div class="active-user-name">
                                Rashid Shareef
                            </div>
                        </div>

                        <div class="active-user-circle"></div>
                    </div>
                    <div class="active-user-pro">
                        <div class="active-user-photo">
                            <img src="assets/images/me3.png" class="active-user-pro-pic" alt="">
                            <div class="active-user-name">
                                Kamal Joardar
                            </div>
                        </div>

                        <div class="active-user-circle"></div>
                    </div>
                    <div class="active-user-pro">
                        <div class="active-user-photo">
                            <img src="assets/images/me.jpg" class="active-user-pro-pic" alt="">
                            <div class="active-user-name">
                                Tahin Ashab
                            </div>
                        </div>

                        <div class="active-user-circle"></div>
                    </div>
                    <div class="active-user-pro">
                        <div class="active-user-photo">
                            <img src="assets/images/me.jpg" class="active-user-pro-pic" alt="">
                            <div class="active-user-name">
                                Sheikh kalim
                            </div>
                        </div>

                        <div class="active-user-circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--   ////////.........start header tob bar................//////-->


    <!--
    <script src="assets/js/jquery.js"></script>

    <script>
        $(document).ready(function() {
            $('textarea').autoResize();

        })

    </script>
-->
</body>

</html>
