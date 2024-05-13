function set_php_session_token(jwtToken) {
    // var host = window.location.protocol + "//" + window.location.host;
    //
    // $.ajax({
    //     type: 'POST',
    //     url: host + "/php_js/login.php",
    //     data: {
    //         urlcommand: 'setSessionToken',
    //         token: jwtToken
    //     },
    //     cache: false
    // }).done(function(data) {
    //
    // }).fail(function(error){
    //
    // });
}

function login_user(uName, uPass, forma) {
    // $.ajax({
    //     url: 'http://sever3d.synology.me:7080/auth/realms/academichain/protocol/openid-connect/token',
    //     type: 'POST',
    //     data: {
    //         username: uName,
    //         password: uPass,
    //         grant_type: 'password',
    //         client_id: 'academichain_ui'
    //     },
    //     headers: {
    //         'Content-Type': 'application/x-www-form-urlencoded'
    //     },
    //     dataType: 'json',
    //
    // }). done (function (data) {
    //     if (data.access_token != null) {
    //         document.cookie = "accesstoken=" + data.access_token;
    //         set_php_session_token(data.access_token);
    //     } else {
    //         console.log('Missing JWT Token');
    //     }
    //     $(forma).unbind('submit').submit(); // send form
    // })
    //     .fail(function (data) {
    //     const err = data.responseJSON.error_description
    //     alert(err);
    //     return false;
    // });
}


$(document).ready(function () {
    $('#loginform').submit(function (env) {
        // console.log("Form submitted");
        // env.preventDefault();
        // const forma = this;
        // const uName = $('#editUsername').val();
        // const uPass = $('#editPassword').val();
        // if (uName == '' || uPass == '') {
        //     alert('Username and password are required');
        //     return false;
        // }
        // login_user(uName, uPass, forma);
    });

    // Logout user
    $('.btnLogout').on('click', function () {
        console.log('Logout');
        $.post(
            "/php_js/login.php",
            {
                urlcommand: 'logout'
            }
        )
            .done(function (data) {
                console.log('User log out');
                document.cookie = "accesstoken=";
                window.location = "index.php"
            })
            .fail(function (data) {
                console.log('Fail when: user logout');
            });

    });

});