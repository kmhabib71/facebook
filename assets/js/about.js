$(document).ready(function () {

    $(document).on('click', 'li.overview', function () {
        $('.activeAbout').removeClass();
        $(this).find('span').addClass('activeAbout');
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");

        $('.about-menu-details').html(' <div class="overview-wrap" style=""> <div class="overview-left"> <div class="add-workplace align-middle" data-userid="' + userid + '" data-profileid="' + profileid + ' " style="margin: 0 0 20px 0;"> <div class="plus-square">+</div> <div class="add-workplace-text" style="font-size:15px;">Add workplace</div> </div> <div class="add-school align-middle" data-userid="' + userid + '" data-profileid="' + profileid + ' " style="margin: 20px 0 20px 0;"> <div class="plus-square">+</div> <div class="add-school-text" style="font-size:15px;">Add school</div> </div> <div class="add-place align-middle" data-userid="' + userid + '" data-profileid="' + profileid + ' " style="margin: 20px 0 20px 0;"> <div class="plus-square">+</div> <div class="add-place-text" style="font-size:15px;">Add place</div> </div> <div class="add-relationship align-middle" data-userid="' + userid + '" data-profileid="' + profileid + ' " style="margin: 20px 0 20px 0;"> <div class="plus-square">+</div> <div class="add-relationship-text" style="font-size:15px;">Add relationship</div> </div> </div> <div class="overview-right"> <div class="overview-mobile align-middle" data-userid="' + userid + '" data-profileid="' + profileid + ' " style="margin-bottom:10px;"> <div class="overview-mobile-icon"><img src="../../assets/images/profile/overview%20mobile.JPG" alt="" style="margin-right:5px;"></div> <div class="overview-mobile-number">01815-667719</div> </div> <div class="overview-birthday align-middle" data-userid="' + userid + '" data-profileid="' + profileid + ' "> <div class="overview-mobile-icon"> <img src="../../assets/images/profile/overview%20birthday.JPG" alt="" style="margin-right:5px;"></div> <div class="overview-mobile-number">29th January 1990</div> </div> </div> </div>');

    })

    $(document).on('click', '.add-workplace', function () {


    })









    $(document).on('click', 'li.work-education', function () {
        $('.activeAbout').removeClass();
        $(this).find('span').addClass('activeAbout');
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");

        $.post('http://localhost/facebook/core/ajax/aboutSubmit.php', {
            dataFetch: userid
        }, function (data) {
            //            $(db_returnClass).empty().html('<span style="color:gray; font-size:12px;">' + data + '</span>');


            //            (name === 'true') ? 'Y' : 'N';
            //            data['screenName']



            $('.about-menu-details').html('<div class="overview-wrap" style=""> <div class="overview-left"> <div class="about-work-heading">WORK</div> <div class="about-border"></div> <div class="add-workplace align-middle" data-userid="' + userid + '" data-profileid="' + profileid + '" style="margin: 0 0 20px 0;"> <div class="plus-square">+</div> <div class="add-workplace-text" style="font-size:15px;">Add a workplace</div> </div> <br> <div class="about-work-heading">' + data[8] + 'PROFESSIONAL SKILL</div> <div class="about-border"></div> <div class="add-professional align-middle" data-userid="' + userid + '" data-profileid="' + profileid + '" style="margin: 0 0 20px 0;"> <div class="plus-square">+</div> <div class="add-professional-text" style="font-size:15px;">Add a professional skill</div> </div> <br> <div class="about-work-heading">COLLEGE</div> <div class="about-border"></div> <div class="add-college align-middle" data-userid="' + userid + '" data-profileid="' + profileid + '" style="margin: 0 0 20px 0;"> <div class="plus-square">+</div> <div class="add-place-text" style="font-size:15px;">Add a college</div> </div> <br> <div class="about-work-heading">HIGH SCHOOL</div> <div class="about-border"></div> <div class="add-highSchool align-middle" data-userid="' + userid + '" data-profileid="' + profileid + '" style="margin: 0 0 20px 0;"> <div class="plus-square">+</div> <div class="add-highSchool-text" style="font-size:15px;">Add a high school</div> </div> </div> </div>');

        });
    })

    $(document).on('click', '.add-workplace.align-middle', function () {
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");
        $(this).removeClass().addClass('db-return');
        $(this).html('<div><input type="text" name="textfield" class="about-class" placeholder="Company, position, City"> <div class="workplace-submit about-submit" data-userid="' + userid + '" data-profileid="' + profileid + '">Save Changes</div></div>');

    })
    $(document).on('click', '.workplace-submit.about-submit', function () {

        $(this).parents('.db-return').removeClass().addClass('add-workplace align-middle');
        var db_returnClass = $(this).parents('.add-workplace.align-middle');
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");
        var dbReturn = $(this).parents('.db-return');
        var inputVal = $(this).siblings('.about-class').val();
        aboutSubmit('workplace', inputVal, userid, profileid, dbReturn, db_returnClass);

    })

    $(document).on('click', '.add-professional.align-middle', function () {
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");
        $(this).removeClass().addClass('db-return');
        $(this).html('<div><input type="text" name="textfield" class="about-class" placeholder="Add Professional Skill"> <div class="professional-submit about-submit" data-userid="' + userid + '" data-profileid="' + profileid + '">Save Changes</div></div>');

    })
    $(document).on('click', '.professional-submit.about-submit', function () {

        $(this).parents('.db-return').removeClass().addClass('add-professional align-middle');
        var db_returnClass = $(this).parents('.add-professional.align-middle');
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");
        var dbReturn = $(this).parents('.db-return');
        var inputVal = $(this).siblings('.about-class').val();
        aboutSubmit('professional', inputVal, userid, profileid, dbReturn, db_returnClass);

    })
    $(document).on('click', '.add-college.align-middle', function () {
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");
        $(this).removeClass().addClass('db-return');
        $(this).html('<div><input type="text" name="textfield" class="about-class" placeholder="Add college"> <div class="college-submit about-submit" data-userid="' + userid + '" data-profileid="' + profileid + '">Save Changes</div></div>');

    })
    $(document).on('click', '.college-submit.about-submit', function () {

        $(this).parents('.db-return').removeClass().addClass('add-college align-middle');
        var db_returnClass = $(this).parents('.add-college.align-middle');
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");
        var dbReturn = $(this).parents('.db-return');
        var inputVal = $(this).siblings('.about-class').val();
        aboutSubmit('college', inputVal, userid, profileid, dbReturn, db_returnClass);

    })
    $(document).on('click', '.add-highSchool.align-middle', function () {
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");
        $(this).removeClass().addClass('db-return');
        $(this).html('<div><input type="text" name="textfield" class="about-class" placeholder="Add High School"> <div class="highSchool-submit about-submit" data-userid="' + userid + '" data-profileid="' + profileid + '">Save Changes</div></div>');

    })
    $(document).on('click', '.highSchool-submit.about-submit', function () {

        $(this).parents('.db-return').removeClass().addClass('add-highSchool align-middle');
        var db_returnClass = $(this).parents('.add-highSchool.align-middle');
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");
        var dbReturn = $(this).parents('.db-return');
        var inputVal = $(this).siblings('.about-class').val();
        aboutSubmit('highSchool', inputVal, userid, profileid, dbReturn, db_returnClass);

    })









    $(document).on('click', 'li.places-lived', function () {
        $('.activeAbout').removeClass();
        $(this).find('span').addClass('activeAbout');
        $('.about-menu-details').html('<div class="overview-wrap" style=""> <div class="overview-left"> <div class="about-work-heading">CURRENT CITY AND HOMETOWN</div> <div class="about-border"></div> <div class="add-current-city align-middle" style="margin: 0 0 20px 0;"> <div class="plus-square">+</div> <div class="add-workplace-text">Add your current city</div> </div> <br> <div class="add-professional-skill align-middle" style="margin: 0 0 20px 0;"> <div class="plus-square">+</div> <div class="add-school-text">Add your hometown</div> </div> <br> <div class="about-work-heading">OTHER PLACES LIVED</div> <div class="about-border"></div> <div class="add-other-place align-middle" style="margin: 0 0 20px 0;"> <div class="plus-square">+</div> <div class="add-place-text">Add a place</div> </div> <br> </div> </div>');
    })
    $(document).on('click', 'li.contact-basic', function () {
        $('.activeAbout').removeClass();
        $(this).find('span').addClass('activeAbout');
        $('.about-menu-details').html('<div class="overview-wrap" style=""> <div class="overview-left"> <div class="about-work-heading">CURRENT CITY AND HOMETOWN</div> <div class="about-border"></div> <div class="contact-mobile" style="width: 100%;display:flex; "> <div class="contact-mobile-text" style="flex-basis:40%">Mobile Phones</div> <div class="contact-mobile-number" style="flex-basis:60%">01815-667719</div> </div> <div class="about-border"></div> <div class="contact-id" style="width: 100%;display:flex; "> <div class="contact-id-text" style="flex-basis:40%">Facebook</div> <div class="contact-id-number" style="flex-basis:60%">http:localhost/facebook/mesha_shafi</div> </div> <div class="about-border"></div> <div class="contact-add-address" style="width: 100%;display:flex;color: #3578e5;cursor: pointer; "> <div class="contact-plus" style="margin-right:10px;">+</div> <div class="contact-add-address-text" style="font-size:13px;">Add your address</div> </div> <br> <br> <div class="about-work-heading">WEBSITE AND SOCIAL LINKS</div> <div class="about-border"></div> <div class="contact-add-website" style="width: 100%;display:flex;color: #3578e5;cursor: pointer; "> <div class="contact-plus" style="margin-right:10px;">+</div> <div class="contact-add-website-text" style="font-size:13px;">Add a website</div> </div> <div class="about-border"></div> <div class="contact-add-social" style="width: 100%;display:flex;color: #3578e5;cursor: pointer; "> <div class="contact-plus" style="margin-right:10px;">+</div> <div class="contact-add-social-text" style="font-size:13px;">Add a social link</div> </div> <br> <br> <div class="about-work-heading">BASIC INFORMATION</div> <div class="about-border"></div> <div class="contact-birthday" style="width: 100%;display:flex; "> <div class="contact-birthday-text" style="flex-basis:40%;font-size: 13px;color: gray;">Birth Date</div> <div class="contact-birthday-date" style="flex-basis:60%;font-size: 13px;color: black;">January 29</div> </div> <div class="about-border"></div> <div class="contact-birthyear" style="width: 100%;display:flex; "> <div class="contact-birthyear-text" style="flex-basis:40%;font-size: 13px;color: gray;"> Birth Year</div> <div class="contact-birthyear-date" style="flex-basis:60%;font-size: 13px;color: black;">1990</div> </div> <div class="about-border"></div> <div class="contact-gender" style="width: 100%;display:flex; "> <div class="contact-gender-text" style="flex-basis:40%;font-size: 13px;color: gray;">Gender</div> <div class="contact-gender-date" style="flex-basis:60%;font-size: 13px;color: black;">Male</div> </div> <div class="about-border"></div> <div class="contact-add-language" style="width: 100%;display:flex;color: #3578e5;cursor: pointer; "> <div class="contact-plus" style="margin-right:10px;">+</div> <div class="contact-add-language-text" style="font-size:13px;">Add a language</div> </div> <div class="about-border"></div> <div class="contact-add-religious" style="width: 100%;display:flex;color: #3578e5;cursor: pointer; "> <div class="contact-plus" style="margin-right:10px;">+</div> <div class="contact-add-religious-text" style="font-size:13px;">Add your religious views</div> </div> <div class="about-border"></div> <div class="contact-add-political" style="width: 100%;display:flex;color: #3578e5;cursor: pointer; "> <div class="contact-plus" style="margin-right:10px;">+</div> <div class="contact-add-political-text" style="font-size:13px;">Add your political views</div> </div> </div> </div>');
    })
    $(document).on('click', 'li.family-relation', function () {
        $('.activeAbout').removeClass();
        $(this).find('span').addClass('activeAbout');
        $('.about-menu-details').html('<div class="overview-wrap" style=""> <div class="overview-left"> <div class="about-work-heading">RELATIONSHIP</div> <div class="about-border"></div> <div class="add-workplace align-middle" style="margin: 0 0 20px 0;"> <div class="plus-square">+</div> <div class="add-workplace-text" style="font-size:15px;">Add your relationship status</div> </div> <br> </div> </div>');
    })
    $(document).on('click', 'li.details-you', function () {
        $('.activeAbout').removeClass();
        $(this).find('span').addClass('activeAbout');
        $('.about-menu-details').html('<div class="overview-wrap" style=""> <div class="overview-left"> <div class="about-work-heading">ABOUT YOU</div> <div class="about-border"></div> <div class="contact-add-details" style="width: 100%;display:flex;color: #3578e5;cursor: pointer; "> <div class="contact-plus" style="margin-right:10px;">+</div> <div class="contact-add-details-text" style="font-size:13px;">Add some details about yourself</div> </div> <br> <br> <div class="about-work-heading">OTHER NAMES</div> <div class="about-border"></div> <div class="contact-add-other" style="width: 100%;display:flex;color: #3578e5;cursor: pointer; "> <div class="contact-plus" style="margin-right:10px;">+</div> <div class="contact-add-other-text" style="font-size:13px;">Add a nickname, a birth name</div> </div><br> <br> <div class="about-work-heading">FABORIT QUOTES</div> <div class="about-border"></div> <div class="contact-add-other" style="width: 100%;display:flex;color: #3578e5;cursor: pointer; "> <div class="contact-plus" style="margin-right:10px;">+</div> <div class="contact-add-other-text" style="font-size:13px;">Add your favorite quotations</div> </div> </div> </div>');
    })
    $(document).on('click', 'li.life-events', function () {
        $('.activeAbout').removeClass();
        $(this).find('span').addClass('activeAbout');
        $('.about-menu-details').html(' <div class="overview-wrap" style=""> <div class="overview-left"> <div class="about-work-heading">LIFE EVENTS</div> <div class="about-border"></div> <div class="contact-add-life-event" style="width: 100%;display:flex;color: #3578e5;cursor: pointer; "> <div class="contact-plus" style="margin-right:10px;">+</div> <div class="contact-add-life-event-text" style="font-size:13px;">Add a life event</div> </div> <br> </div> </div>');
    })



    function aboutSubmit(submitType, inputVal, userid, profileid, dbReturn, db_returnClass) {
        $.post('http://localhost/facebook/core/ajax/aboutSubmit.php', {
            submitType: submitType,
            inputVal: inputVal,
            userid: userid,
            profileid: profileid
        }, function (data) {
            $(db_returnClass).empty().html('<span style="color:gray; font-size:12px;">' + data + '</span>');
        });

    };

})
