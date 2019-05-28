<?php
include '../load.php';
include '../../connect/login.php';

$user_id =login::isLoggedIn();

if(isset($_POST['userid'])){
$userid = $_POST['userid'];
$profileId = $_POST['profileid'];




?>
<div class="bio-wrap">
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
                                <?php $loadFromPost->posts($userid, $profileId, 20);?>
                            </div>
                        </div>






    <?php

}
    ?>
