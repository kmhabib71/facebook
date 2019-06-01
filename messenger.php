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
if(isset($_GET['username']) == true && empty($_GET['username']) === false){

$username = $loadFromUser->checkInput($_GET['username']);

$profileId = $loadFromUser->userIdByUsername($username);

$profileData = $loadFromUser->userData($profileId);
$userData = $loadFromUser->userData($userid);

$requestCheck = $loadFromPost->requestCheck($userid,$profileId);
$requestConf = $loadFromPost->requestConf($profileId,$userid);
$followCheck = $loadFromPost->followCheck($profileId,$userid);
$allusers = $loadFromPost->lastPersonWithAllUserMSG($userid);


    $lastpersonidFromPost = $loadFromPost->lastPersonsMsg($userid);

$lastpersonid = $lastpersonidFromPost->userId;

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
            .msg-wrap {
                display: flex;
            }

            .left-part {
                flex-basis: 25%;
                border-right: 1px solid lightgray;
                height: 100vh;
            }

            .right-part {
                flex-basis: 75%;
            }

            .msg-setting-write {
                height: 50px;
                border-bottom: 1px solid lightgray;
                display: flex;
                justify-content: space-around;
                align-items: center;
                font-size: 14px;
            }

            .msg-receiver-top {
                height: 50px;
                border-bottom: 1px solid lightgray;
                font-size: 14px;
                display: flex;
            }

            .msg-receiver-name {
                flex-basis: 50%;
                text-align: center;
                align-self: center;
            }

            .msg-call-option {
                flex-basis: 50%;
            }

            .msg-user-name-wrap {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 10px;
            }

            .msg-user-photo-name-wrap {
                display: flex;
                justify-content: flex-start;
                align-items: center;
                padding: 0 115px 0 0;
            }

            .msg-user-name-text {
                margin-left: 5px;
            }

            .msg-user-name {
                font-size: 13px;
            }

            .msg-user-text {
                font-size: 12px;
                color: gray;
            }

            .msg-date {
                font-size: 12px;
                color: gray;
            }

            .msg-setting-img {
                opacity: 0;
            }

            .msg-setting:hover .msg-setting-img {
                opacity: 1;
            }

            .msg-box {
                display: flex;
                flex-direction: column;
                padding: 10px;
                min-width: 444px;
                border-right: 1px solid lightgray;
                height: 75vh;
                max-width: 650px;
                overflow-y: scroll;
            }

            .left-msg {
                display: flex;
                margin-top: 10px;
            }

            .receiver-text-time {
                margin-left: 5px;
            }

            .right-receiver-text-time {
                margin-right: 5px;
                display: flex;
                flex-direction: column;
                align-items: flex-end;
            }

            .receiver-text {
                font-size: 12px;
                padding: 9px;
                background-color: rgba(211, 211, 211, 0.44);
                border-radius: 20px;
            }

            .receiver-time {
                font-size: 12px;
                color: gray;
            }

            .right-msg {
                display: flex;
                justify-content: flex-end;
                margin-top: 10px;
            }

            .write-msg-input {
                position: fixed;
                bottom: 0;
                min-width: 50%;
                max-width: 49%;
                margin-bottom: 5px;
            }

            .emojionearea .emojionearea-editor {
                min-height: 40px;
                border-radius: 20px;
            }

             ::-webkit-scrollbar {
                width: 10px;
            }
            /* Track */

             ::-webkit-scrollbar-track {
                box-shadow: inset 0 0 5px grey;
                border-radius: 10px;
            }
            /* Handle */

             ::-webkit-scrollbar-thumb {
                background: #00BCD4;
                border-radius: 10px;
            }
            /* Handle on hover */

             ::-webkit-scrollbar-thumb:hover {
                background: #007786;
            }

        </style>
    </head>

    <body style="background-color: white;height: 100vh;overflow: hidden;">
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
                    <div class="top-request top-css top-icon border-left">
                        <img src="assets/images/request.png" alt="">
                    </div>
                    <a href="messenger.php">
                        <div class="top-messanger top-css top-icon ">
                            <img src="assets/images/messanger.png" alt="">
                        </div>
                    </a>
                    <div class="top-notification top-css top-icon">
                        <img src="assets/images/Notification.png" alt="">
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
        <main>
            <div class="msg-wrap">
                <div class="left-part">
                    <div class="msg-setting-write">
                        <div class="msg-setting">
                            <img src="assets/images/messenger/msgSetting.JPG" alt="">
                        </div>
                        <div class="msg-name-text">Message</div>
                        <div class="msg-write-button">
                            <img src="assets/images/messenger/writeMsg.JPG" alt="">
                        </div>
                    </div>

                    <div class="user-search" style="margin: 5px 0; width:100%; padding: 0 10px;position:relative;">
                        <input type="text" name="" class="user-search" placeholder="Find user" style="width:90%;height: 25px;border-radius: 34px;border: 1px solid lightgray;padding:5px;text-align:center;">
                        <div class="user-show" style="width:90%;position:absolute;text-align:center;">

                        </div>
                    </div>

                    <div>
                        <ul class="msg-user-add">
                            <?php foreach($allusers as $user){ ?>
                            <li class="msg-user-name-wrap" id="<?php echo $user->user_id; ?>">

                                <div class="msg-user-photo-name-wrap" style="cursor:pointer;" data-profileid="<?php echo $user->user_id; ?>">
                                    <div class="msg-user-photo">
                                        <img src="<?php echo $user->profilePic; ?>" alt="" style="height:50px;width:50px;border-radius:50%;">
                                    </div>

                                    <div class="msg-user-name-text">
                                        <div class="msg-user-name">
                                            <?php echo ''.$user->firstName.' '.$user->lastName.''; ?>
                                        </div>
                                        <div class="msg-user-text">
                                            <?php echo $user->message; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="msg-date-setting">
                                    <div class="msg-date">
                                        <?php echo $loadFromUser->timeAgo($user->messageOn); ?>
                                    </div>
                                    <div class="msg-setting">
                                        <img src="assets/images/messenger/userSetting.JPG" alt="" class="msg-setting-img">
                                    </div>
                                </div>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>

                </div>
                <div class="right-part">
                    <div class="msg-receiver-top">
                        <div class="msg-receiver-name" style="font-weight:600;"><?php echo ''.$lastpersonidFromPost->firstName.' '.$lastpersonidFromPost->lastName.'' ?></div>
                        <div class="msg-call-option"></div>
                    </div>
                    <div class="msg-show-wrap">
                        <div class="user-info" data-userid="<?php echo $userid; ?>" data-otherid="<?php echo $lastpersonid; ?>"></div>
                        <div class="msg-box">
                            <?php

  $messageData = $loadFromPost->messageData($userid, $lastpersonid);
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
    ?>
                        </div>
                    </div>
                    <div class="write-msg-input">
                        <textarea name="" id="msgInput" style="width:100%;border-radius:20px;"></textarea>
                    </div>

                </div>
            </div>
        </main>
        <script src="assets/js/jquery.js"></script>
        <script src="assets/dist/emojionearea.min.js"></script>
        <script src="assets/js/search.js"></script>
        <script src="assets/js/main.js"></script>

        <script>
            jQuery.each(jQuery('textarea[data-autoresize]'), function() {
                var offset = this.offsetHeight - this.clientHeight;

                var resizeTextarea = function(el) {
                    jQuery(el).css('height', 'auto').css('height', el.scrollHeight + offset);
                };
                jQuery(this).on('keyup input', function() {
                    resizeTextarea(this);
                }).removeAttr('data-autoresize');
            });
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
            $(document).ready(function() {



                $('#msgInput').emojioneArea({
                    pickerPosition: "top",
                    spellcheck: true
                })

                function msgSubmit(userId, otherId) {



                }
                var useridd = $('.user-info').data('userid');
                var otheridd = $('.user-info').data('otherid');
                var userid;
                var otherid;

                function abc(var1, var2) {

                    if (var1 === undefined || var2 === undefined) {
                        return userid = useridd, otherid = otheridd;

                    } else {
                        return userid = var1, otherid = var2;

                    }
                }

                function xyz(name, surname, callback) {
                    if (typeof callback == "function") {

                        callback(name, surname);

                    } else {
                        alert("Argument is not function type");
                    }
                }


                setTimeout(function() {
                    $(document).on('keyup', '.emojionearea .emojionearea-editor', function(e) {
                        if (e.keyCode == 13) {
                            var thisEl = $(this);
                            var rawWsg = $(this).html();
                            if (userid === undefined) {
                                xyz(userid, otherid, abc);
                            }

                            var msg = (rawWsg).slice(0, -15);
                            console.log(msg, otherid);

                            $.ajax({
                                type: "POST",
                                url: "http://localhost/facebook/core/ajax/message.php",
                                data: {
                                    userid: userid,
                                    otherid: otherid,
                                    msg: msg
                                },
                                success: function(data) {
                                    $('.msg-box').html(data);
                                    $(thisEl).text('');
                                    scrollItself()
                                    $('.msg-box').on('scroll', function() {

                                        if ($(this).scrollTop() < $(this).scrollHeight - $(this).height()) {
                                            selfScroll = false;

                                        } else {
                                            selfScroll = true;

                                        }
                                    });
                                    //                                    commentHover()
                                }
                            });
                        }
                    });

                }, 2000);


                function loadMessage(ds, sd) {
                    var userid = $('.user-info').data('userid');
                    var otherid = $('.user-info').data('otherid');
                    var pastDataCount = $('.past-data-count').data('datacount');
                    $.ajax({
                        type: "POST",
                        url: "http://localhost/facebook/core/ajax/message.php",
                        data: {
                            showmsg: otherid,
                            yourid: userid
                        },
                        success: function(data) {
                            $('.msg-box').html(data);

                        }


                    });
                }

                function loadMessageAfterClick(userid, otherid) {
                    var pastDataCount = $('.past-data-count').data('datacount');
                    $.ajax({
                        type: "POST",
                        url: "http://localhost/facebook/core/ajax/message.php",
                        data: {
                            showmsg: otherid,
                            yourid: userid
                        },
                        success: function(data) {
                            $('.msg-box').html(data);

                        }


                    });

                    $.post('http://localhost/facebook/core/ajax/message.php', {
                        dataCount: otherid,
                        profileid: userid,
                    }, function(data) {
                        if (pastDataCount == data) {
                            console.log('data same');
                        } else {
                            scrollItself()
                            console.log('data is not same');

                        }


                    });

                }
                var ds = 30;
                var sd = 29;
                var loadTimer = setInterval(function() {
                    loadMessage(ds, sd);
                }, 1000);



                $(document).on('keyup', 'input.user-search', function() {

                    var searchText = $(this).val();
                    if (searchText == '') {
                        $(".user-show").empty()
                    } else {
                        $.post('http://localhost/facebook/core/ajax/search.php', {
                            msgUser: searchText
                        }, function(data) {
                            if (data == '') {
                                alert('Search person nei')
                            } else {
                                $(".user-show").html(data);

                            }

                        });
                    }

                });
                var intervalId;
var intervalIdtwo;
                $(document).on('click', 'li.mention-individuals.align-middle', function() {
                    clearInterval(loadTimer);
                    var otherid = $(this).data('profileid');
                    var userid = '<?php echo $userid; ?>';
                    var searchImage = $(this).find('img.search-image').attr('src');
                    var searchName = $(this).find('.mention-name').text();
                    $('.user-info').attr("data-otherid", otherid);
                    $('#' + otherid + '').remove();
                    xyz(userid, otherid, abc);
                    console.log(otherid, userid, searchImage);
                    $.post('http://localhost/facebook/core/ajax/message.php', {
                        showmsg: otherid,
                        yourid: userid
                    }, function(data) {

                        $('.msg-box').html(data);
                        $(".user-show").empty()
                        $('input.user-search').val('');
                        $('ul.msg-user-add').prepend('<li class="msg-user-name-wrap" id="' + otherid + '" style="cursor:pointer;"> <div class="msg-user-photo-name-wrap" data-profileid="' + otherid + '"> <div class="msg-user-photo"> <img src="' + searchImage + '" alt="" style="height:50px;width:50px;border-radius:50%;"> </div> <div class="msg-user-name-text"> <div class="msg-user-name">' + searchName + '</div> <div class="msg-user-text"></div> </div> </div> <div class="msg-date-setting"> <div class="msg-date">Now</div> <div class="msg-setting"> <img src="assets/images/messenger/userSetting.JPG" alt="" class="msg-setting-img"> </div> </div> </li>')
                        scrollItself()

                    });

  if (!intervalId) {
                        intervalId = setInterval(function() {
                            loadMessageAfterClick(userid, otherid);
                        }, 1000);
                          clearInterval(intervalIdtwo);
                          intervalIdtwo = null;
                      } else if(!intervalIdtwo) {
                        clearInterval(intervalId);
                        intervalId = null;
                           intervalIdtwo = setInterval(function() {
                            loadMessageAfterClick(userid, otherid);
                        }, 1000);
                      }else{
alert('Nothing found')}
                });


                function scrollItself() {
                    var elVeiwHeight = $('.msg-box').height();
                    var elTotalHeight = $('.msg-box')[0].scrollHeight;
                    if (elTotalHeight > elVeiwHeight) {
                        $('.msg-box').scrollTop(elTotalHeight - elVeiwHeight);
                    }
                }
  scrollItself()
                var loadTimerAfterCLick;
                $(document).on('click', '.msg-user-photo-name-wrap', function(e) {
                    var useridi = "<?php echo $userid; ?>"
                    var profileid = $(this).data('profileid');
                    $('.user-info').attr("data-otherid", profileid);
//                    alert(useridi);
                    xyz(useridi, profileid, abc);
                    //                    loadMessageAfterClick(userid, profileid);
                    clearInterval(loadTimer);
                    scrollItself();
//                    clearInterval(loadTimerAfterCLick);

                      if (!intervalId) {
                        intervalId = setInterval(function() {
                            loadMessageAfterClick(useridi, profileid);
                        }, 1000);
                          clearInterval(intervalIdtwo);
                          intervalIdtwo = null;
                      } else if(!intervalIdtwo) {
                        clearInterval(intervalId);
                        intervalId = null;
                           intervalIdtwo = setInterval(function() {
                            loadMessageAfterClick(useridi, profileid);
                        }, 1000);
                      }else{
alert('Nothing found')}

//                    function abc(var1, var2) {
//                        alert('abc');
//                        var loadTimerAfterCLick = setInterval(function() {
//                            loadMessageAfterClick(useridi, profileid);
//                        }, 1000);
//
//
//                    }
//
//                    function xyz(name, surname, callback) {
//                        if (typeof callback == "function") {
//                            alert('xyz');
//                            clearInterval(loadTimerAfterCLick);
//                            callback(name, surname);
//
//                        } else {
//                            alert("Argument is not function type");
//                        }
//                    }

                    //                    var loadTimerByClick = setInterval(function() {
                    //                        loadMessageAfterClick(userid, profileid);
                    //                    }, 1000);


                    //
                })

            })

        </script>
    </body>

    </html>


    <?php
}
    ?>
