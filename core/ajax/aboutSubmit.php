<?php
include '../load.php';
include '../../connect/login.php';

$user_id =login::isLoggedIn();
if(isset($_POST['submitType'])){
    $submitType = $_POST['submitType'];
    $inputVal = $_POST['inputVal'];
    $userid = $_POST['userid'];
    $profileid = $_POST['profileid'];

    $loadFromUser->update('profile', $userid, array($submitType => $inputVal));
    echo $inputVal;



}

if(isset($_POST['overview'])){
    $userid = $_POST['overview'];
    $profileid = $_POST['profileid'];

  $userdata = $loadFromUser->userdata($profileid);
    ?>
    <div class="overview-wrap" style="">
        <div class="overview-left" style="flex-basis:70%;">
            <div class="about-work-heading">WORK</div>
            <div class="about-border"></div>
            <?php echo ($userid !== $profileid) ? '<span class="about-success" style="">'.$userdata->workplace.'</span><br><br>' : (($userdata->workplace == '') ? '<div class="add-workplace align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style="margin: 0 0 20px 0;"><div class="plus-square">+</div><div class="add-workplace-text" style="font-size:15px;">Add a workplace</div></div>' : '<div class="add-workplace align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style="margin: 0 0 20px 0;"><span class="about-success" style="">'.$userdata->workplace.'</span></div><br>') ?>
            <div class="about-work-heading">SCHOOL</div>
            <div class="about-border"></div>
            <?php echo ($userid !== $profileid) ? '<span class="about-success" style="">'.$userdata->highSchool.'</span><br><br>' : (($userdata->highSchool == '') ? '<div class="add-highSchool align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style="margin: 0 0 20px 0;"><div class="plus-square">+</div><div class="add-highSchool-text" style="font-size:15px;">Add a highSchool</div></div>' : '<div class="add-highSchool align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style="margin: 0 0 20px 0;"><span class="about-success" style="">'.$userdata->highSchool.'</span></div><br>') ?>
            <div class="about-work-heading">PLACE</div>
            <div class="about-border"></div>
            <?php echo ($userid !== $profileid) ? '<span class="about-success" style="">'.$userdata->address.'</span><br>' : (($userdata->address == '') ? '<div class="add-address align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style="margin: 0 0 20px 0;"><div class="contact-plus" style="margin-right:10px;">+</div><div class="contact-add-address-text" style="font-size:13px;">Add your address</div></div><br>' : '<div class="add-address align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style="margin: 0 0 20px 0;"><span class="about-success" style="">'.$userdata->address.'</span></div><br>') ?>
            <div class="about-work-heading">RELATIONSHIP</div>
            <div class="about-border"></div>
            <?php echo ($userid !== $profileid) ? '<span class="about-success" style="">'.$userdata->relationship.'</span><br><br>' : (($userdata->relationship == '') ? '<div class="add-relationship align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style="margin: 0 0 20px 0;"><div class="plus-square">+</div><div class="add-relationship-text" style="font-size:15px;">Add a relationship</div></div>' : '<div class="add-relationship align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style="margin: 0 0 20px 0;"><span class="about-success" style="">'.$userdata->relationship.'</span></div><br>') ?>
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



    <?php

}
if(isset($_POST['workEducation'])){
    $userid = $_POST['workEducation'];
    $profileid = $_POST['profileid'];

  $userdata = $loadFromUser->userdata($profileid);
    ?>
        <div class="overview-wrap" style="">
            <div class="overview-left">
                <div class="about-work-heading">WORK</div>
                <div class="about-border"></div>
                <?php echo ($userid !== $profileid) ? '<span class="about-success" style="">'.$userdata->workplace.'</span><br><br>' : (($userdata->workplace == '') ? '<div class="add-workplace align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style="margin: 0 0 20px 0;"><div class="plus-square">+</div><div class="add-workplace-text" style="font-size:15px;">Add a workplace</div></div>' : '<div class="add-workplace align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style="margin: 0 0 20px 0;"><span class="about-success" style="">'.$userdata->workplace.'</span></div><br>') ?>
                <div class="about-work-heading">PROFESSIONAL SKILL</div>
                <div class="about-border"></div>
                <?php echo ($userid !== $profileid) ? '<span class="about-success" style="">'.$userdata->professional.'</span><br><br>' : (($userdata->professional == '') ? '<div class="add-professional align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style="margin: 0 0 20px 0;"><div class="plus-square">+</div><div class="add-professional-text" style="font-size:15px;">Add a professional</div></div>' : '<div class="add-professional align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style="margin: 0 0 20px 0;"><span class="about-success" style="">'.$userdata->professional.'</span></div><br>') ?>
                <div class="about-work-heading">COLLEGE</div>
                <div class="about-border"></div>
                <?php echo ($userid !== $profileid) ? '<span class="about-success" style="">'.$userdata->college.'</span><br><br>' : (($userdata->college == '') ? '<div class="add-college align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style="margin: 0 0 20px 0;"><div class="plus-square">+</div><div class="add-college-text" style="font-size:15px;">Add a college</div></div>' : '<div class="add-college align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style="margin: 0 0 20px 0;"><span class="about-success" style="">'.$userdata->college.'</span></div><br>') ?>
                <div class="about-work-heading">HIGH SCHOOL</div>
                <div class="about-border"></div>

                <?php echo ($userid !== $profileid) ? '<span class="about-success" style="">'.$userdata->highSchool.'</span>' : (
         ($userdata->highSchool == '') ? '<div class="add-highSchool align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style="margin: 0 0 20px 0;"><div class="plus-square">+</div><div class="add-highSchool-text" style="font-size:15px;">Add a highSchool</div></div>' : '<div class="add-highSchool align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style="margin: 0 0 20px 0;"><span class="about-success" style="">'.$userdata->highSchool.'</span></div><br>') ?>
            </div>
        </div>



        <?php

}
if(isset($_POST['placesLived'])){
    $userid = $_POST['placesLived'];
    $profileid = $_POST['profileid'];

  $userdata = $loadFromUser->userdata($profileid);
    ?>
            <div class="overview-wrap" style="">
                <div class="overview-left">
                    <div class="about-work-heading">CURRENT CITY</div>
                    <div class="about-border"></div>
                    <?php echo ($userid !== $profileid) ? '<span class="about-success" style="">'.$userdata->currentCity.'</span><br><br>' : (($userdata->currentCity == '') ? '<div class="add-currentCity align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style="margin: 0 0 20px 0;"><div class="plus-square">+</div><div class="add-currentCity-text" style="font-size:15px;">Add a currentCity</div></div>' : '<div class="add-currentCity align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style="margin: 0 0 20px 0;"><span class="about-success" style="">'.$userdata->currentCity.'</span></div><br>') ?>
                    <div class="about-work-heading">HOMETOWN</div>
                    <div class="about-border"></div>
                    <?php echo ($userid !== $profileid) ? '<span class="about-success" style="">'.$userdata->hometown.'</span><br><br>' : (($userdata->hometown == '') ? '<div class="add-hometown align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style="margin: 0 0 20px 0;"><div class="plus-square">+</div><div class="add-hometown-text" style="font-size:15px;">Add a hometown</div></div>' : '<div class="add-hometown align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style="margin: 0 0 20px 0;"><span class="about-success" style="">'.$userdata->hometown.'</span></div><br>') ?>
                    <div class="about-work-heading">OTHER PLACES LIVED</div>
                    <div class="about-border"></div>
                    <?php echo ($userid !== $profileid) ? '<span class="about-success" style="">'.$userdata->otherPlace.'</span><br><br>' : (($userdata->otherPlace == '') ? '<div class="add-otherPlace align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style="margin: 0 0 20px 0;"><div class="plus-square">+</div><div class="add-otherPlace-text" style="font-size:15px;">Add a otherPlace</div></div>' : '<div class="add-otherPlace align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style="margin: 0 0 20px 0;"><span class="about-success" style="">'.$userdata->otherPlace.'</span></div><br>') ?> </div>
            </div>



            <?php

}
if(isset($_POST['contactBasic'])){
    $userid = $_POST['contactBasic'];
    $profileid = $_POST['profileid'];

  $userdata = $loadFromUser->userdata($profileid);
    ?>
                <div class="overview-wrap" style="">
                    <div class="overview-left">
                        <div class="about-work-heading">CURRENT CITY AND HOMETOWN</div>
                        <div class="about-border"></div>
                        <div class="contact-mobile" style="width: 100%;display:flex; ">
                            <div class="contact-mobile-text setting" style="flex-basis:40%">Mobile Phones</div>
                            <div class="contact-mobile-number setting" style="flex-basis:60%">01815-667719</div>
                        </div>
                        <div class="about-border"></div>
                        <div class="contact-id" style="width: 100%;display:flex; ">
                            <div class="contact-id-text setting" style="flex-basis:40%">Facebook</div>
                            <div class="contact-id-number setting" style="flex-basis:60%">http:localhost/facebook/mesha_shafi</div>
                        </div>
                        <br><br>
                        <div class="about-work-heading">Address</div>
                        <div class="about-border"></div>
                        <?php echo ($userid !== $profileid) ? '<span class="about-success" style="">'.$userdata->address.'</span><br>' : (($userdata->address == '') ? '<div class="add-address align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style="margin: 0 0 20px 0;"><div class="contact-plus" style="margin-right:10px;">+</div><div class="contact-add-address-text" style="font-size:13px;">Add your address</div></div><br>' : '<div class="add-address align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style="margin: 0 0 20px 0;"><span class="about-success" style="">'.$userdata->address.'</span></div><br>') ?>


                        <div class="about-work-heading">WEBSITE AND SOCIAL LINKS</div>
                        <div class="about-border"></div>
                        <?php echo ($userid !== $profileid) ? '<span class="about-success" style="">'.$userdata->website.'</span>' : (($userdata->website == '') ? '<div class="add-website align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style=""><div class="contact-plus" style="margin-right:10px;">+</div><div class="contact-add-website-text" style="font-size:13px;">Add your website</div></div>' : '<div class="add-website align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style=""><span class="about-success" style="">'.$userdata->website.'</span></div>') ?>
                        <div class="about-border"></div>
                        <?php echo ($userid !== $profileid) ? '<span class="about-success" style="">'.$userdata->socialLink.'</span><br> <br>' : (($userdata->socialLink == '') ? '<div class="add-socialLink align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style="margin: 0 0 20px 0;"><div class="contact-plus" style="margin-right:10px;">+</div><div class="contact-add-socialLink-text" style="font-size:13px;">Add your socialLink</div></div><br> <br>' : '<div class="add-socialLink align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style=""><span class="about-success" style="">'.$userdata->socialLink.'</span></div><br> <br>') ?>
                        <div class="about-work-heading">BASIC INFORMATION</div>
                        <div class="about-border"></div>
                        <div class="contact-birthday setting" style="width: 100%;display:flex; ">
                            <div class="contact-birthday-text" style="flex-basis:40%;font-size: 13px;color: gray;">Birth Date</div>
                            <div class="contact-birthday-date" style="flex-basis:60%;font-size: 13px;color: black;">January 29</div>
                        </div>
                        <div class="about-border "></div>
                        <div class="contact-birthyear setting" style="width: 100%;display:flex; ">
                            <div class="contact-birthyear-text" style="flex-basis:40%;font-size: 13px;color: gray;"> Birth Year</div>
                            <div class="contact-birthyear-date" style="flex-basis:60%;font-size: 13px;color: black;">1990</div>
                        </div>
                        <div class="about-border "></div>
                        <div class="contact-gender setting" style="width: 100%;display:flex; ">
                            <div class="contact-gender-text" style="flex-basis:40%;font-size: 13px;color: gray;">Gender</div>
                            <div class="contact-gender-date" style="flex-basis:60%;font-size: 13px;color: black;">Male</div>
                        </div>
                        <br>

                        <div class="about-work-heading">LANGUAGE</div>

                        <div class="about-border"></div>
                        <?php echo ($userid !== $profileid) ? '<span class="about-success" style="margin-top: -5px;margin-bottom: 16px;">'.$userdata->language.'</span>' : (($userdata->language == '') ? '<div class="add-language align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style=""><div class="contact-plus" style="margin-right:10px;">+</div><div class="contact-add-language-text" style="font-size:13px;">Add your language</div></div>' : '<div class="add-language align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style=""><span class="about-success" style="margin-top: -5px;margin-bottom: 16px;">'.$userdata->language.'</span></div>') ?>
                        <br>
                        <div class="about-work-heading">RELIGIOUS VIEWS</div>

                        <div class="about-border"></div>
                        <?php echo ($userid !== $profileid) ? '<span class="about-success" style="margin-top: -5px;margin-bottom: 16px;">'.$userdata->religion.'</span>' : (($userdata->religion == '') ? '<div class="add-religion align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style=""><div class="contact-plus" style="margin-right:10px;">+</div><div class="contact-add-religion-text" style="font-size:13px;">Add your religion</div></div>' : '<div class="add-religion align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style=""><span class="about-success" style="margin-top: -5px;margin-bottom: 16px;">'.$userdata->religion.'</span></div>') ?>
                        <br>

                        <div class="about-work-heading">POLITICAL VIEWS</div>

                        <div class="about-border"></div>
                        <?php echo ($userid !== $profileid) ? '<span class="about-success" style="margin-top: -5px;margin-bottom: 16px;">'.$userdata->politicalViews.'</span>' : (($userdata->politicalViews == '') ? '<div class="add-politicalViews align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style=""><div class="contact-plus" style="margin-right:10px;">+</div><div class="contact-add-politicalViews-text" style="font-size:13px;">Add your politicalViews</div></div>' : '<div class="add-politicalViews align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style=""><span class="about-success" style="margin-top: -5px;margin-bottom: 16px;">'.$userdata->politicalViews.'</span></div>') ?>
                    </div>
                </div>



                <?php

}
if(isset($_POST['familyRelation'])){
    $userid = $_POST['familyRelation'];
    $profileid = $_POST['profileid'];

  $userdata = $loadFromUser->userdata($profileid);
    ?>
                    <div class="overview-wrap" style="">
                        <div class="overview-left">
                            <div class="about-work-heading">RELATIONSHIP</div>
                            <div class="about-border"></div>
                            <?php echo ($userid !== $profileid) ? '<span class="about-success" style="">'.$userdata->relationship.'</span><br><br>' : (($userdata->relationship == '') ? '<div class="add-relationship align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style="margin: 0 0 20px 0;"><div class="plus-square">+</div><div class="add-relationship-text" style="font-size:15px;">Add a relationship</div></div>' : '<div class="add-relationship align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style="margin: 0 0 20px 0;"><span class="about-success" style="">'.$userdata->relationship.'</span></div><br>') ?> <br> </div>
                    </div>



                    <?php

}

if(isset($_POST['aboutYou'])){
    $userid = $_POST['aboutYou'];
    $profileid = $_POST['profileid'];

  $userdata = $loadFromUser->userdata($profileid);
    ?>
                        <div class="overview-wrap" style="">
                            <div class="overview-left">
                                <div class="about-work-heading">ABOUT YOU</div>
                                <div class="about-border"></div>
                                <?php echo ($userid !== $profileid) ? '<span class="about-success" style="">'.$userdata->aboutYou.'</span>' : (($userdata->aboutYou == '') ? '<div class="add-aboutYou align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style=""><div class="contact-plus" style="margin-right:10px;">+</div><div class="contact-add-aboutYou-text" style="font-size:13px;">Add your aboutYou</div></div>' : '<div class="add-aboutYou align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style=""><span class="about-success" style="">'.$userdata->aboutYou.'</span></div>') ?> <br> <br>
                                <div class="about-work-heading"> OTHER NAMES</div>
                                <div class="about-border"></div>
                                <?php echo ($userid !== $profileid) ? '<span class="about-success" style="">'.$userdata->otherName.'</span>' : (($userdata->otherName == '') ? '<div class="add-otherName align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style=""><div class="contact-plus" style="margin-right:10px;">+</div><div class="contact-add-otherName-text" style="font-size:13px;">Add your otherName</div></div>' : '<div class="add-otherName align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style=""><span class="about-success" style="">'.$userdata->otherName.'</span></div>') ?><br> <br>
                                <div class="about-work-heading">FABORIT QUOTES</div>
                                <div class="about-border"></div>
                                <?php echo ($userid !== $profileid) ? '<span class="about-success" style="">'.$userdata->quotes.'</span>' : (($userdata->quotes == '') ? '<div class="add-quotes align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style=""><div class="contact-plus" style="margin-right:10px;">+</div><div class="contact-add-quotes-text" style="font-size:13px;">Add your quotes</div></div>' : '<div class="add-quotes align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style=""><span class="about-success" style="">'.$userdata->quotes.'</span></div>') ?>

                            </div>
                        </div>



                        <?php

}


if(isset($_POST['lifeEvent'])){
    $userid = $_POST['lifeEvent'];
    $profileid = $_POST['profileid'];

  $userdata = $loadFromUser->userdata($profileid);
    ?>

                            <div class="overview-wrap" style="">
                                <div class="overview-left">
                                    <div class="about-work-heading">LIFE EVENTS</div>
                                    <div class="about-border"></div>
                                    <div class="contact-add-life-event" style="width: 100%;display:flex;color: #3578e5;cursor: pointer; ">
                                        <?php echo ($userid !== $profileid) ? '<span class="about-success" style="">'.$userdata->lifeEvent.'</span>' : (($userdata->lifeEvent == '') ? '<div class="add-lifeEvent align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style=""><div class="contact-plus" style="margin-right:10px;">+</div><div class="contact-add-lifeEvent-text" style="font-size:13px;">Add your lifeEvent</div></div>' : '<div class="add-lifeEvent align-middle" data-userid="'.$userid.'" data-profileid="'.$profileid.'" style=""><span class="about-success" style="">'.$userdata->lifeEvent.'</span></div>') ?>
                                    </div> <br> </div>
                            </div>


                            <?php

}

?>
