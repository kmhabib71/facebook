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




?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>facebook</title>
        <link rel="stylesheet" href="assets/css/style.css">
        <style>


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
                        <div class="search-icon"></div>
                    </div>
                </div>
                <div class="top_right_part">
                    <div class="top-pic-name-wrap">
                        <a href="profile.php?username=<?php echo $profileData->userLink; ?>" class="top-pic-name">
                            <div class="top-pic"><img src="<?php echo $profileData->profilePic; ?>" alt=""></div>
                            <div class="top-name top-css">
                                <?php echo $profileData->first_name; ?> </div>
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
            <div class="main-area">
                <!--      ///////////..........start profile cover and photo section...........//////////-->

                <div class="profile-left-wrap">

                    <div class="profile-cover-wrap" style="background-image: url(<?php echo $profileData->coverPic; ?>);">
                        <div class="upload-cov-opt-wrap">

                            <?php if($profileId == $userid){ ?>
                            <div class="add-cover-photo">
                                <img src="assets/images/profile/uploadCoverPhoto.JPG" alt="">
                                <div class="add-cover-text">Add a cover photo</div>

                            </div>

                            <?php  }else{ ?>
                            <div class="dont-add-cover-photo">
                                <!--
<img src="assets/images/profile/uploadCoverPhoto.JPG" alt="">
<div class="add-cover-text">Add a cover photo</div>-->

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
                            <div class="profile-action">
                                <div class="profile-edit-button">
                                    <img src="assets/images/profile/editProfile.JPG" alt="">
                                    <div class="edit-profile-button-text">Edit Profile</div>
                                </div>
                                <div class="profile-activity-button">
                                    <img src="assets/images/profile/activityLog.JPG" alt="">
                                    <div class="profile-activity-button-text">Edit Profile</div>
                                </div>
                                <div class="dot-wrap">
                                    <div class="profile-activity-button-dot"> ... </div>
                                    <div class="timeline-settings ">Timeline Settings</div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="cover-bottom-part">
                        <div class="timeline-button align-middle cover-but-css">
                            <div>Timeline</div> <img src="assets/images/profile/timelineDownArrow.JPG" alt="">
                        </div>
                        <div class="about-button cover-but-css">About</div>
                        <div class="friends-button cover-but-css">Friends</div>
                        <div class="photos-button cover-but-css">Photos</div>
                        <div class="archive-button align-middle cover-but-css">
                            <img src="assets/images/profile/archive.JPG" alt="">
                            <div>Archive</div>
                        </div>
                        <div class="more-button align-middle cover-but-css">
                            <div>More</div> <img src="assets/images/profile/more.JPG" alt=""></div>
                    </div>
                    <div class="bio-timeline">
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
                        <div class="status-timeline-wrap">
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
                                            <textarea data-autoresize rows="5" columns="5" placeholder="what's going in your mind?" name="textStatus" class="status align-middle"></textarea>
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
                            <?php $loadFromPost->posts($userid, $profileId, 20);?>
                        </div>
                    </div>

                </div>
                <div class="cover-right-wrap">
                    <div class="profile-active-user">
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
                $(".status-share-button ").on("click", function() {

                    var statusText = $('.status').val();




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
                    var nf_3 = $(nf4).siblings('.nf-3');
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
                    $.post('http://localhost/facebook/core/ajax/react.php', {
                        deleteReactType: typeR,
                        postId: postId,
                        userId: userId

                    }, function(data) {
                        //                    alert(data);
                        $(nf_3).empty().html(data);
                    });
                }

                function mainReactSubmit(typeR, postId, userId, nf_3) {
                    $.post('http://localhost/facebook/core/ajax/react.php', {
                        reactType: typeR,
                        postId: postId,
                        userId: userId

                    }, function(data) {
                        //                    alert(data);
                        $(nf_3).empty().html(data);
                    });

                }
                $(document).on('click', '.like-action', function() {
                    var likeActionIcon = $(this).find('.like-action-icon img');
                    var likeReactParent = $(this).parents('.like-action-wrap');

                    var nf4 = $(likeReactParent).parents('.nf-4');
                    var nf_3 = $(nf4).siblings('.nf-3');
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
                                    postid: postid
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
                    var com_nf_3 = $(grandParent).parent('.com-react').siblings('.com-pro-text').find('.com-nf-3-wrap');
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
                    var com_nf_3 = $(thisParents).parent('.com-react').siblings('.com-pro-text').find('.com-nf-3-wrap');
                    //                $(com_nf_3).hide();

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

                    $.post('http://localhost/facebook/core/ajax/commentReact.php', {
                        commentid: commentID,
                        reactType: typeR,
                        postId: postId,
                        userId: userId


                    }, function(data) {
                        $(com_nf_3).empty().html(data);
                        console.log(data);
                    });

                }

                function comReactDelete(typeR, postId, userId, commentID, com_nf_3) {
                    $.post('http://localhost/facebook/core/ajax/commentReact.php', {
                        delcommentid: commentID,
                        deleteReactType: typeR,
                        postId: postId,
                        userId: userId


                    }, function(data) {
                        //                    alert(data);
                        $(com_nf_3).empty().html(data);
                    });
                }





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
                                        commentid: commentid
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
                    var com_nf_3 = $(grandParent).parent('.com-react').siblings('.com-pro-text').find('.com-nf-3-wrap');

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
                    var com_nf_3 = $(thisParents).parent('.com-react').siblings('.com-pro-text').find('.com-nf-3-wrap');
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

                    $.post('http://localhost/facebook/core/ajax/replyReact.php', {
                        commentid: commentID,
                        reactType: typeR,
                        postId: postId,
                        userId: userId,
                        commentparentid: commentparentid



                    }, function(data) {
                        $(com_nf_3).empty().html(data);
                        //                    console.log(data);
                    });

                }

                function replyReactDelete(typeR, postId, userId, commentID, commentparentid, com_nf_3) {
                    $.post('http://localhost/facebook/core/ajax/replyReact.php', {
                        delcommentid: commentID,
                        deleteReactType: typeR,
                        postId: postId,
                        userId: userId,
                        commentparentid: commentparentid


                    }, function(data) {
                        //                    alert(data);
                        $(com_nf_3).empty().html(data);
                    });
                }



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

                $(document).on('click', 'li.post-edit', function() {

                    var statusTextContainer = $(this).parents('.nf-1').siblings('.nf-2').find('.nf-2-text');
                    var addId = $(statusTextContainer).attr('id', 'editPostPut');
                    var getPostText = $(statusTextContainer).text();
                    var postid = $(statusTextContainer).data('postid');
                    var userid = $(statusTextContainer).data('userid');
                    var getPostImg = $(this).parents('.nf-1').siblings('.nf-2').find('.nf-2-img');
                    var thiss = $(this).parents('.nf-1').siblings('.nf-2').find('.nf-2-img');

                    $('.top-box-show').html('<div class="top-box profile-dialog-show" style="top: 12.5%;left: 22.5%;width: 55%;"><div class="edit-post-header align-middle " style="justify-content: space-between; padding: 10px; height: 20px; background-color: lightgray;font-size: 14px; font-weight:600; "><div class="edit-post-text">Edit Post</div><div class="edit-post-close" style="padding: 5px; color: gray; cursor:pointer;">x</div></div><div class="edit-post-value" style="border-bottom: 1px solid lightgray;"><div class="status-med"><div class="status-prof"><div class="top-pic"><img src="assets/images/me.jpg" alt=""></div></div><div class="status-prof-textarea"><textarea data-autoresize rows="5" columns="5" placeholder="" name="textStatus" class="editStatus align-middle" style="font-family:sens-serif; font-weight:400; padding:5px;">' + getPostText + '</textarea></div></div></div><div class="edit-post-submit" style="position: absolute;right:0; bottom: 0; display: flex; align-items: center; margin: 10px;"><div class="status-privacy-wrap"><div class="status-privacy  "><div class="privacy-icon align-middle"><img src="assets/images/profile/publicIcon.JPG" alt=""></div><div class="privacy-text">Public</div><div class="privacy-downarrow-icon align-middle"><img src="assets/images/watchmore.png" alt=""></div></div><div class="status-privacy-option"></div></div><div class="edit-post-save" style="padding: 3px 15px; background-color: #4267bc;color: white; font-size: 14px; margin-left:5px; cursor:pointer;" data-postid="' + postid + '" data-userid="' + userid + '" data-tag="' + thiss + '">Save</div></div></div>');
                });

                $(document).on('click', '.edit-post-close', function() {
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

 }else{
    echo 'Profile not found';
}

?>
