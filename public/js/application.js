$(function () {

    if ($('#javascript-ajax-button').length !== 0) {
        $('#javascript-ajax-button').on('click', function () {
            $.ajax("/songs/stats").done(function (result) {
                $('#javascript-ajax-result-box').html(result)
            }).fail(function () {
            }).always(function () {
            })
        })
    }
})
