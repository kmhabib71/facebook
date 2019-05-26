<?php
include '../load.php';
include '../../connect/login.php';

$user_id =login::isLoggedIn();
if(isset($_POST['userid'])){
$user_id = $_POST['userid'];
$profileid = $_POST['profileid'];
    $userdata = $loadFromUser->userdata($profileid);

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
    </div>
    <?php

                           }              ?>
