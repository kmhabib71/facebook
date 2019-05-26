$(document).ready(function () {

    $(document).on('click', '.setting', function () {

        window.location.href = "http://localhost/facebook/settings.php";
    })




    //......................Overview.....................//
    $(document).on('click', 'li.overview', function () {
        $('.activeAbout').removeClass();
        $(this).find('span').addClass('activeAbout');
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");

        $.post('http://localhost/facebook/core/ajax/aboutSubmit.php', {
            overview: userid,
            profileid: profileid
        }, function (data) {
            $('.about-menu-details').html(data);

        });
    })

    //......................Overview End.....................//



    //......................Work & Education.....................//

    $(document).on('click', 'li.work-education', function () {
        $('.activeAbout').removeClass();
        $(this).find('span').addClass('activeAbout');
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");

        $.post('http://localhost/facebook/core/ajax/aboutSubmit.php', {
            workEducation: userid,
            profileid: profileid
        }, function (data) {
            $('.about-menu-details').html(data);

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

    //......................Work & Education End.....................//


    //......................places you lived.....................//

    $(document).on('click', 'li.places-lived', function () {
        $('.activeAbout').removeClass();
        $(this).find('span').addClass('activeAbout');
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");

        $.post('http://localhost/facebook/core/ajax/aboutSubmit.php', {
            placesLived: userid,
            profileid: profileid
        }, function (data) {
            $('.about-menu-details').html(data);

        });



    })

    $(document).on('click', '.add-currentCity.align-middle', function () {
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");
        $(this).removeClass().addClass('db-return');
        $(this).html('<div><input type="text" name="textfield" class="about-class" placeholder="Company, position, City"> <div class="currentCity-submit about-submit" data-userid="' + userid + '" data-profileid="' + profileid + '">Save Changes</div></div>');

    })

    $(document).on('click', '.currentCity-submit.about-submit', function () {

        $(this).parents('.db-return').removeClass().addClass('add-currentCity align-middle');
        var db_returnClass = $(this).parents('.add-currentCity.align-middle');
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");
        var dbReturn = $(this).parents('.db-return');
        var inputVal = $(this).siblings('.about-class').val();
        aboutSubmit('currentCity', inputVal, userid, profileid, dbReturn, db_returnClass);

    })
    $(document).on('click', '.add-hometown.align-middle', function () {
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");
        $(this).removeClass().addClass('db-return');
        $(this).html('<div><input type="text" name="textfield" class="about-class" placeholder="Company, position, City"> <div class="hometown-submit about-submit" data-userid="' + userid + '" data-profileid="' + profileid + '">Save Changes</div></div>');

    })

    $(document).on('click', '.hometown-submit.about-submit', function () {

        $(this).parents('.db-return').removeClass().addClass('add-hometown align-middle');
        var db_returnClass = $(this).parents('.add-hometown.align-middle');
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");
        var dbReturn = $(this).parents('.db-return');
        var inputVal = $(this).siblings('.about-class').val();
        aboutSubmit('hometown', inputVal, userid, profileid, dbReturn, db_returnClass);

    })
    $(document).on('click', '.add-otherPlace.align-middle', function () {
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");
        $(this).removeClass().addClass('db-return');
        $(this).html('<div><input type="text" name="textfield" class="about-class" placeholder="Company, position, City"> <div class="otherPlace-submit about-submit" data-userid="' + userid + '" data-profileid="' + profileid + '">Save Changes</div></div>');

    })

    $(document).on('click', '.otherPlace-submit.about-submit', function () {

        $(this).parents('.db-return').removeClass().addClass('add-otherPlace align-middle');
        var db_returnClass = $(this).parents('.add-otherPlace.align-middle');
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");
        var dbReturn = $(this).parents('.db-return');
        var inputVal = $(this).siblings('.about-class').val();
        aboutSubmit('otherPlace', inputVal, userid, profileid, dbReturn, db_returnClass);

    })

    //......................places you lived End.....................//



    //......................Contact And Basic Info .....................//
    $(document).on('click', 'li.contact-basic', function () {
        $('.activeAbout').removeClass();
        $(this).find('span').addClass('activeAbout');
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");

        $.post('http://localhost/facebook/core/ajax/aboutSubmit.php', {
            contactBasic: userid,
            profileid: profileid
        }, function (data) {
            $('.about-menu-details').html(data);

        });
    })


    $(document).on('click', '.add-address.align-middle', function () {
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");
        $(this).removeClass().addClass('db-return');
        $(this).html('<div><input type="text" name="textfield" class="about-class" placeholder="Company, position, City"> <div class="address-submit about-submit" data-userid="' + userid + '" data-profileid="' + profileid + '">Save Changes</div></div>');

    })

    $(document).on('click', '.address-submit.about-submit', function () {

        $(this).parents('.db-return').removeClass().addClass('add-address align-middle');
        var db_returnClass = $(this).parents('.add-address.align-middle');
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");
        var dbReturn = $(this).parents('.db-return');
        var inputVal = $(this).siblings('.about-class').val();
        aboutSubmit('address', inputVal, userid, profileid, dbReturn, db_returnClass);

    })
    $(document).on('click', '.add-website.align-middle', function () {
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");
        $(this).removeClass().addClass('db-return');
        $(this).html('<div><input type="text" name="textfield" class="about-class" placeholder="Company, position, City"> <div class="website-submit about-submit" data-userid="' + userid + '" data-profileid="' + profileid + '">Save Changes</div></div>');

    })

    $(document).on('click', '.website-submit.about-submit', function () {

        $(this).parents('.db-return').removeClass().addClass('add-website align-middle');
        var db_returnClass = $(this).parents('.add-website.align-middle');
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");
        var dbReturn = $(this).parents('.db-return');
        var inputVal = $(this).siblings('.about-class').val();
        aboutSubmit('website', inputVal, userid, profileid, dbReturn, db_returnClass);

    })
    $(document).on('click', '.add-socialLink.align-middle', function () {
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");
        $(this).removeClass().addClass('db-return');
        $(this).html('<div><input type="text" name="textfield" class="about-class" placeholder="Company, position, City"> <div class="socialLink-submit about-submit" data-userid="' + userid + '" data-profileid="' + profileid + '">Save Changes</div></div>');

    })

    $(document).on('click', '.socialLink-submit.about-submit', function () {

        $(this).parents('.db-return').removeClass().addClass('add-socialLink align-middle');
        var db_returnClass = $(this).parents('.add-socialLink.align-middle');
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");
        var dbReturn = $(this).parents('.db-return');
        var inputVal = $(this).siblings('.about-class').val();
        aboutSubmit('socialLink', inputVal, userid, profileid, dbReturn, db_returnClass);

    })
    $(document).on('click', '.add-language.align-middle', function () {
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");
        $(this).removeClass().addClass('db-return');
        $(this).html('<div><input type="text" name="textfield" class="about-class" placeholder="Company, position, City"> <div class="language-submit about-submit" data-userid="' + userid + '" data-profileid="' + profileid + '">Save Changes</div></div>');

    })

    $(document).on('click', '.language-submit.about-submit', function () {

        $(this).parents('.db-return').removeClass().addClass('add-language align-middle');
        var db_returnClass = $(this).parents('.add-language.align-middle');
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");
        var dbReturn = $(this).parents('.db-return');
        var inputVal = $(this).siblings('.about-class').val();
        aboutSubmit('language', inputVal, userid, profileid, dbReturn, db_returnClass);

    })
    $(document).on('click', '.add-religion.align-middle', function () {
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");
        $(this).removeClass().addClass('db-return');
        $(this).html('<div><input type="text" name="textfield" class="about-class" placeholder="Company, position, City"> <div class="religion-submit about-submit" data-userid="' + userid + '" data-profileid="' + profileid + '">Save Changes</div></div>');

    })

    $(document).on('click', '.religion-submit.about-submit', function () {

        $(this).parents('.db-return').removeClass().addClass('add-religion align-middle');
        var db_returnClass = $(this).parents('.add-religion.align-middle');
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");
        var dbReturn = $(this).parents('.db-return');
        var inputVal = $(this).siblings('.about-class').val();
        aboutSubmit('religion', inputVal, userid, profileid, dbReturn, db_returnClass);

    })
    $(document).on('click', '.add-politicalViews.align-middle', function () {
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");
        $(this).removeClass().addClass('db-return');
        $(this).html('<div><input type="text" name="textfield" class="about-class" placeholder="Company, position, City"> <div class="politicalViews-submit about-submit" data-userid="' + userid + '" data-profileid="' + profileid + '">Save Changes</div></div>');

    })

    $(document).on('click', '.politicalViews-submit.about-submit', function () {

        $(this).parents('.db-return').removeClass().addClass('add-politicalViews align-middle');
        var db_returnClass = $(this).parents('.add-politicalViews.align-middle');
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");
        var dbReturn = $(this).parents('.db-return');
        var inputVal = $(this).siblings('.about-class').val();
        aboutSubmit('politicalViews', inputVal, userid, profileid, dbReturn, db_returnClass);

    })


    //......................Contact And Basic Info End.....................//


    //......................Family And Relationship  .....................//

    $(document).on('click', 'li.family-relation', function () {
        $('.activeAbout').removeClass();
        $(this).find('span').addClass('activeAbout');
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");

        $.post('http://localhost/facebook/core/ajax/aboutSubmit.php', {
            familyRelation: userid,
            profileid: profileid
        }, function (data) {
            $('.about-menu-details').html(data);

        });
    })

    $(document).on('click', '.add-relationship.align-middle', function () {
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");
        $(this).removeClass().addClass('db-return');
        $(this).html('<div><input type="text" name="textfield" class="about-class" placeholder="Single, Married, Complicated"> <div class="relationship-submit about-submit" data-userid="' + userid + '" data-profileid="' + profileid + '">Save Changes</div></div>');

    })

    $(document).on('click', '.relationship-submit.about-submit', function () {

        $(this).parents('.db-return').removeClass().addClass('add-relationship align-middle');
        var db_returnClass = $(this).parents('.add-relationship.align-middle');
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");
        var dbReturn = $(this).parents('.db-return');
        var inputVal = $(this).siblings('.about-class').val();
        aboutSubmit('relationship', inputVal, userid, profileid, dbReturn, db_returnClass);

    })

    //......................Family And Relationship  End.....................//

    //......................Details About you  .....................//

    $(document).on('click', 'li.details-you', function () {
        $('.activeAbout').removeClass();
        $(this).find('span').addClass('activeAbout');
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");

        $.post('http://localhost/facebook/core/ajax/aboutSubmit.php', {
            aboutYou: userid,
            profileid: profileid
        }, function (data) {
            $('.about-menu-details').html(data);

        });
    })

    $(document).on('click', '.add-aboutYou.align-middle', function () {
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");
        $(this).removeClass().addClass('db-return');
        $(this).html('<div><input type="text" name="textfield" class="about-class" placeholder="Single, Married, Complicated"> <div class="aboutYou-submit about-submit" data-userid="' + userid + '" data-profileid="' + profileid + '">Save Changes</div></div>');

    })

    $(document).on('click', '.aboutYou-submit.about-submit', function () {

        $(this).parents('.db-return').removeClass().addClass('add-aboutYou align-middle');
        var db_returnClass = $(this).parents('.add-aboutYou.align-middle');
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");
        var dbReturn = $(this).parents('.db-return');
        var inputVal = $(this).siblings('.about-class').val();
        aboutSubmit('aboutYou', inputVal, userid, profileid, dbReturn, db_returnClass);

    })
    $(document).on('click', '.add-quotes.align-middle', function () {
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");
        $(this).removeClass().addClass('db-return');
        $(this).html('<div><input type="text" name="textfield" class="about-class" placeholder="Single, Married, Complicated"> <div class="quotes-submit about-submit" data-userid="' + userid + '" data-profileid="' + profileid + '">Save Changes</div></div>');

    })

    $(document).on('click', '.quotes-submit.about-submit', function () {

        $(this).parents('.db-return').removeClass().addClass('add-quotes align-middle');
        var db_returnClass = $(this).parents('.add-quotes.align-middle');
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");
        var dbReturn = $(this).parents('.db-return');
        var inputVal = $(this).siblings('.about-class').val();
        aboutSubmit('quotes', inputVal, userid, profileid, dbReturn, db_returnClass);

    })
    $(document).on('click', '.add-otherName.align-middle', function () {
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");
        $(this).removeClass().addClass('db-return');
        $(this).html('<div><input type="text" name="textfield" class="about-class" placeholder="Single, Married, Complicated"> <div class="otherName-submit about-submit" data-userid="' + userid + '" data-profileid="' + profileid + '">Save Changes</div></div>');

    })

    $(document).on('click', '.otherName-submit.about-submit', function () {

        $(this).parents('.db-return').removeClass().addClass('add-otherName align-middle');
        var db_returnClass = $(this).parents('.add-otherName.align-middle');
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");
        var dbReturn = $(this).parents('.db-return');
        var inputVal = $(this).siblings('.about-class').val();
        aboutSubmit('otherName', inputVal, userid, profileid, dbReturn, db_returnClass);

    })


    //......................Details About you  End.....................//

    //......................Life Events  .....................//

    $(document).on('click', 'li.life-events', function () {
        $('.activeAbout').removeClass();
        $(this).find('span').addClass('activeAbout');
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");

        $.post('http://localhost/facebook/core/ajax/aboutSubmit.php', {
            lifeEvent: userid,
            profileid: profileid
        }, function (data) {
            $('.about-menu-details').html(data);

        });
    })
    $(document).on('click', '.add-lifeEvent.align-middle', function () {
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");
        $(this).removeClass().addClass('db-return');
        $(this).html('<div><input type="text" name="textfield" class="about-class" placeholder="Single, Married, Complicated"> <div class="lifeEvent-submit about-submit" data-userid="' + userid + '" data-profileid="' + profileid + '">Save Changes</div></div>');

    })

    $(document).on('click', '.lifeEvent-submit.about-submit', function () {

        $(this).parents('.db-return').removeClass().addClass('add-lifeEvent align-middle');
        var db_returnClass = $(this).parents('.add-lifeEvent.align-middle');
        var userid = $(this).data("userid");
        var profileid = $(this).data("profileid");
        var dbReturn = $(this).parents('.db-return');
        var inputVal = $(this).siblings('.about-class').val();
        aboutSubmit('lifeEvent', inputVal, userid, profileid, dbReturn, db_returnClass);

    })
    //......................Life Events  End.....................//









    function aboutSubmit(submitType, inputVal, userid, profileid, dbReturn, db_returnClass) {
        $.post('http://localhost/facebook/core/ajax/aboutSubmit.php', {
            submitType: submitType,
            inputVal: inputVal,
            userid: userid,
            profileid: profileid
        }, function (data) {
            $(db_returnClass).empty().html('<span class="about-success" style="">' + data + '</span>');
        });

    };

})
