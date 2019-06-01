<?php
include '../load.php';
include '../../connect/login.php';

$user_id =login::isLoggedIn();

if(isset($_POST['searchText'])){

$searchText = $_POST['searchText'];

$searchResult = $loadFromPost->searchText($searchText);
echo '<ul style="background-color:white;padding:5px;margin-top:0;box-shadow:0 0 5px gray;border-radius:3px;">';

    foreach($searchResult as $search){

        ?>

    <li class="mention-individuals align-middle" style="background-color:#4267b2;color:white; font-size:12px; padding:3px;margin-bottom:5px;cursor:pointer;">
        <a href="<?php echo BASE_URL.$search->userLink;  ?>" class="align-middle" style="color:white;">
                <img src="<?php echo BASE_URL.$search->profilePic;  ?>" style="height:20px; width:20px; " alt="">
                <div class="mention-name" style="margin-left:3px;"><?php echo ''.$search->first_name.' '.$search->last_name.'';  ?></div>
            </a>
    </li>

    <?php

 }
     echo '</ul>';
}
if(isset($_POST['msgUser'])){

$msgUser = $_POST['msgUser'];

$searchResult = $loadFromPost->searchText($msgUser);
echo '<ul style="background-color:white;padding:5px;margin-top:0;box-shadow:0 0 5px gray;border-radius:3px;" >';

    foreach($searchResult as $search){

        ?>

        <li class="mention-individuals align-middle" style="background-color:#4267b2;color:white; font-size:12px; padding:3px;margin-bottom:5px;cursor:pointer;" data-profileid="<?php echo $search->user_id; ?>">

            <img class="search-image" src="<?php echo BASE_URL.$search->profilePic;  ?>" style="height:30px; width:30px; " alt="">
            <div class="mention-name" style="margin-left:3px;font-size: 13px;">
                <?php echo ''.$search->first_name.' '.$search->last_name.'';  ?>
            </div>

        </li>

        <?php

 }
     echo '</ul>';
}





?>
