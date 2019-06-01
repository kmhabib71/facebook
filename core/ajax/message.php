<?php
include '../load.php';
include '../../connect/login.php';

$user_id =login::isLoggedIn();

if(isset($_POST['userid'])){
     $userid=$_POST['userid'];
     $msg=$_POST['msg'];
 $otherid=$_POST['otherid'];

    $loadFromUser->create('messages', array('message' => $msg, 'messageTo' => $otherid, 'messageFrom' => $userid, 'messageOn' => date('Y-m-d H:i:s')));
    $messageData = $loadFromPost->messageData($userid, $otherid);
     foreach($messageData as $message){
    ?>
    <?php
        if($message->messageFrom == $userid){
        ?>
        <div class="right-msg">
            <div class="right-receiver-text-time">
                <div class="receiver-text" style="background-color:#03A9F4;color:white;">
                    <?php echo $message->message; ?>
                </div>
                <div class="receiver-time" style="margin-right:10px;"><?php echo $loadFromUser->timeAgo($message->messageOn); ?></div>
            </div>
            <div class="receiver-img">
                <img src="<?php echo BASE_URL.$message->profilePic; ?>" alt="" style="height:30px; width:30px;border-radius:50%;">
            </div>
        </div>
        <?php

        }else{
        ?>

            <div class="left-msg">
                <div class="receiver-img">
                    <img src="<?php echo BASE_URL.$message->profilePic; ?>" alt="" style="height:30px; width:30px;border-radius:50%;">
                </div>
                <div class="receiver-text-time">
                    <div class="receiver-text">
                        <?php echo $message->message; ?>
                    </div>
                    <div class="receiver-time" style="margin-left:10px;"><?php echo $loadFromUser->timeAgo($message->messageOn); ?></div>
                </div>
            </div>

            <?php
        }

        ?>




                <?php
}


}

if(isset($_POST['showmsg'])){
     $otherid=$_POST['showmsg'];
     $userid=$_POST['yourid'];


    $messageData = $loadFromPost->messageData($userid, $otherid);
    echo '<div class="past-data-count" data-datacount="'.count($messageData).'"> </div>';
     foreach($messageData as $message){
    ?>
                    <?php
        if($message->messageFrom == $userid){
        ?>
                        <div class="right-msg">
                            <div class="right-receiver-text-time">
                                <div class="receiver-text" style="background-color:#03A9F4;color:white;">
                                    <?php echo $message->message; ?>
                                </div>
                                <div class="receiver-time" style="margin-right:10px;"><?php echo $loadFromUser->timeAgo($message->messageOn); ?></div>
                            </div>
                            <div class="receiver-img">
                                <img src="<?php echo $message->profilePic; ?>" alt="" style="height:30px; width:30px;border-radius:50%;">
                            </div>
                        </div>
                        <?php

        }else{
        ?>

                            <div class="left-msg">
                                <div class="receiver-img">
                                    <img src="<?php echo $message->profilePic; ?>" alt="" style="height:30px; width:30px;border-radius:50%;">
                                </div>
                                <div class="receiver-text-time">
                                    <div class="receiver-text">
                                        <?php echo $message->message; ?>
                                    </div>
                                    <div class="receiver-time" style="margin-left:10px;"><?php echo $loadFromUser->timeAgo($message->messageOn); ?></div>
                                </div>
                            </div>

                            <?php
        }

        ?>




                                <?php
}


}
if(isset($_POST['dataCount'])){
     $otherid=$_POST['dataCount'];
     $userid=$_POST['profileid'];


    $messageData = $loadFromPost->messageData($userid, $otherid);
   echo count($messageData);


}
?>
