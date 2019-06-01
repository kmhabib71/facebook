$(document).ready(function () {
    $('.emojionearea-editor').keyup(function (e) {
        if (e.keyCode == 13) {
            alert('Its input');
            console.log('its cool')

        }
    });
    $('textarea#msgInput').keyup(function (e) {
        if (e.keyCode == 13) {
            alert('Its input');
            console.log('its cool')

        }
    });
    $('.emojionearea .emojionearea-editor').keyup(function (e) {
        if (e.keyCode == 13) {
            alert('Its input');
            console.log('its cool')

        }
    });


})
