$(document).ready(function () {

    $('#btn-add-friend').on('click', function (event) {
        const userId = $(this).attr('data-ui');
        sendFriendRequest(userId);
    });

    $('#btn-remove-friend').on('click', function (event) {
        const userVisibleName = $(this).attr('data-user');
        console.log("Removing connection with:", userVisibleName)
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
