$(document).ready(function () {

    $('#btn-add-friend').on('click', function (event) {
        const userId = $(this).attr('data-ui');
        sendFriendRequest(userId);
    });

    $('#btn-remove-friend').on('click', function (event) {
        const userVisibleName = $(this).attr('data-user');
        console.log("Removing connection with:", userVisibleName)
    });


    /** Accept Friend Request btn click */
    $('.btn-accept-friend-request').on('click', function (event) {
        const userId = $(this).attr('data-id');
        console.log("Accept req from user:", userId)
    });

    /** Cancel Friend Request btn click */
    $('.btn-cancel-friend-request').on('click', function (event) {
        const userId = $(this).attr('data-id');
        console.log("Cancel req to user:", userId)
    });


});

function sendFriendRequest(userId) {
    $.post("/php_js/user.php", {urlcommand: 'sendFriendRequest', userId: userId})
        .done(function (data) {
            let parsedData = JSON.parse(data)
            if (parsedData['body'] == 'true') {
                $("#btn-add-friend").removeClass("btn-primary").addClass("btn-warning").html("<i class=\"fa-solid fa-user-check\"></i> Request sent");
            }

        }).fail(function (data) {
        console.log("fail: ", JSON.parse(data))
    })
}
