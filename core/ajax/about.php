<?php
include '../load.php';
include '../../connect/login.php';

$user_id =login::isLoggedIn();
if(isset($_POST['userid'])){

}else{

}

$profileid = '31';

?>

    <html lang="en">

    <head>
        <meta charset="UTF-8">

        <link rel="stylesheet" href="../../assets/css/style.css">
        <style>


        </style>


    </head>

    <body>
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
                    <div class="overview-wrap" style="">
                        <div class="overview-left">
                            <div class="about-work-heading">WORK</div>
                            <div class="about-border"></div>
                            <div class="add-workplace align-middle" data-userid="'+userid+'" data-profileid="'+profileid+'" style="margin: 0 0 20px 0;">
                                <div class="plus-square">+</div>
                                <div class="add-workplace-text" style="font-size:15px;">Add a workplace</div>
                            </div> <br>
                            <div class="about-work-heading">PROFESSIONAL SKILL</div>
                            <div class="about-border"></div>
                            <div class="add-professional align-middle" data-userid="'+userid+'" data-profileid="'+profileid+'" style="margin: 0 0 20px 0;">
                                <div class="plus-square">+</div>
                                <div class="add-professional-text" style="font-size:15px;">Add a professional skill</div>
                            </div> <br>
                            <div class="about-work-heading">COLLEGE</div>
                            <div class="about-border"></div>
                            <div class="add-college align-middle" data-userid="'+userid+'" data-profileid="'+profileid+'" style="margin: 0 0 20px 0;">
                                <div class="plus-square">+</div>
                                <div class="add-place-text" style="font-size:15px;">Add a college</div>
                            </div> <br>
                            <div class="about-work-heading">HIGH SCHOOL</div>
                            <div class="about-border"></div>
                            <div class="add-highSchool align-middle" data-userid="'+userid+'" data-profileid="'+profileid+'" style="margin: 0 0 20px 0;">
                                <div class="plus-square">+</div>
                                <div class="add-highSchool-text" style="font-size:15px;">Add a high school</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--
                <div class="overview-wrap" style="">
                        <div class="overview-left">
                            <div class="add-workplace align-middle" data-userid="<?php echo $user_id; ?>" data-profileid="<?php echo $profileid; ?>" style="margin: 0 0 20px 0;">
                                <div class="plus-square">+</div>
                                <div class="add-workplace-text" style="font-size:15px;">Add workplace</div>
                            </div>
                            <div class="add-school align-middle" data-userid="<?php echo $user_id; ?>" data-profileid="<?php echo $profileid; ?>" style="margin: 20px 0 20px 0;">
                                <div class="plus-square">+</div>
                                <div class="add-school-text" style="font-size:15px;">Add school</div>
                            </div>
                            <div class="add-place align-middle" data-userid="<?php echo $user_id; ?>" data-profileid="<?php echo $profileid; ?>" style="margin: 20px 0 20px 0;">
                                <div class="plus-square">+</div>
                                <div class="add-place-text" style="font-size:15px;">Add place</div>
                            </div>
                            <div class="add-relationship align-middle" data-userid="<?php echo $user_id; ?>" data-profileid="<?php echo $profileid; ?>" style="margin: 20px 0 20px 0;">
                                <div class="plus-square">+</div>
                                <div class="add-relationship-text" style="font-size:15px;">Add relationship</div>
                            </div>
                        </div>
                        <div class="overview-right">
                            <div class="overview-mobile align-middle" data-userid="<?php echo $user_id; ?>" data-profileid="<?php echo $profileid; ?>" style="margin-bottom:10px;">
                                <div class="overview-mobile-icon"><img src="../../assets/images/profile/overview%20mobile.JPG" alt="" style="margin-right:5px;"></div>
                                <div class="overview-mobile-number">01815-667719</div>
                            </div>
                            <div class="overview-birthday align-middle" data-userid="<?php echo $user_id; ?>" data-profileid="<?php echo $profileid; ?>">
                                <div class="overview-mobile-icon"> <img src="../../assets/images/profile/overview%20birthday.JPG" alt="" style="margin-right:5px;"></div>
                                <div class="overview-mobile-number">29th January 1990</div>
                            </div>
                        </div>
                    </div>
-->
            </div>
        </div>
        <script src="../../assets/js/jquery.js"></script>
        <script src="../../assets/js/about.js"></script>
    </body>

    </html>
