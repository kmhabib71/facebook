$(document).ready(function () {
    $(document).on('keyup', 'input#main-search', function () {
        var searchText = $(this).val();
        if (searchText == '') {
            $(".search-result").empty()
        } else {
            $.post('http://localhost/facebook/core/ajax/search.php', {
                searchText: searchText
            }, function (data) {
                if (data == '') {
                    alert('Search person nei')
                } else {
                    $(".search-result").html(data);
                }

            });
        }

    });
})
