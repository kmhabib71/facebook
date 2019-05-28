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


    <div class="yourPhotoWrap">
        <div class="friend-request-wrapp " style="background-color: #f5f6f7;box-shadow: 0 0 1px grey;">
            <div class="about-top-wrap" style="display:flex; justify-content: space-between;align-items:center;">
                <div class="about-header">
                    <div class="about-icon"><img src="assets/images/profile/yourPhoto.JPG" alt=""></div>
                    <div class="about-text">Photo</div>
                </div>

            </div>
            <div class="friend-follow-tab" style="display:flex; margin-left:15px; font-size:12px;padding-bottom: 5px;">
                <div class="friend-tab" style="color: #32518e;font-weight:600;margin-right:10px; cursor:pointer;">Your Photo
                </div>


            </div>
        </div>

        <div class="about-main" style="flex-wrap: wrap;padding:10px;">
            <?php $postImage = $loadFromPost->yourPhoto($profileid);

            foreach($postImage as $image){

 $yourPhoto = json_decode($image->postImage);
                            $imageCount = 0;
                                for($i = 0; $i < count($yourPhoto); $i++) {
                                    echo '<img src="'.BASE_URL.$yourPhoto[''.$imageCount++.'']->imageName.'" alt="" data-userid="'.$user_id.'" data-profileid="'.$profileid.'" data-postid="'.$image->post_id.'" data-imageid="'.$imageCount.'" class="postImage" style="height:206px; width:206px;margin:0 10px 10px 0;">';
                                }
            }
            ?>


        </div>
    </div>




    <?php

}
    ?>
