const getGeneratedUsernamesList = () => {
    var host = window.location.protocol + "//" + window.location.host;
    $.post(
        host + "/php_js/user.php",
        { urlcommand: 'generateusernames' }
    )
        .done(function (data) {
            let d = JSON.parse(data);
        })
        .fail(function (data) {
            console.log('jQuery post FAIL: getGeneratedUsernamesList()');
        })
}

$(document).ready(function () {
    //getGeneratedUsernamesList();
});