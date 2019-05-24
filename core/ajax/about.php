<?php
include '../load.php';
include '../../connect/login.php';

$user_id =login::isLoggedIn();
if(isset($_POST['userid'])){
    echo 'I found it';
}else{

}

$profileid = '31';

?>

    <html lang="en">

    <head>
        <meta charset="UTF-8">

        <link rel="stylesheet" href="assets/css/style.css">
        <style>


        </style>


    </head>

    <body>
        <div class="about-wrap">
            <div class="about-header">

            </div>
            <div class="about-main">
                <div class="about-menu"></div>
                <div class="about-menu-details"></div>
            </div>
        </div>
        <script src="assets/js/about.js"></script>
    </body>

    </html>
