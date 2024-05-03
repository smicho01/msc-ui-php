function set_php_session_token(jwtToken) {
    var host = window.location.protocol + "//" + window.location.host;
    $.post(
        host + "/php_js/login.php",
        {
            urlcommand: 'setSessionToken',
            token: jwtToken
        }
    )
        .done(function(data){
            console.log('Attempt to set PHP Session Token: ' + data);
        })
        .fail(function(data){
            console.log('some fail with jQuery post');
        })
        .always(function() {

        });
}

function login_user(uName, uPass, forma) {
    $.ajax({
            url: 'http://sever3d.synology.me:7080/auth/realms/academichain/protocol/openid-connect/token',
            type: 'POST',
            data: {
                username : uName,
                password : uPass,
                grant_type : 'password',
                client_id : 'academichain_ui'
            },
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            dataType: 'json',
            success: function (data) {
                console.info(data);
                if(data.access_token != null) {
                    document.cookie = "accesstoken=" + data.access_token;
                    //console.log(data.access_token);
                    set_php_session_token(data.access_token);
                }
                else
                    console.log('Missing JWT Token');
                $(forma).unbind('submit').submit();

            },
            error: function(data) {
                //console.log(data);
                //console.log(data.statusText);
                const err = data.responseJSON.error_description
                alert(err);
                return false;
            }
        });
}


$(document).ready(function() {
    $('#loginform').submit(function(env) {
        const forma = this;
        env.preventDefault();
        
        const uName = $('#editUsername').val();
        const uPass = $('#editPassword').val();
        
        if(uName == '' || uPass == '') {
            alert('Username and password are required');
            return false;
        }

        login_user(uName, uPass, forma);
    });

    // Logout user
    $('.btnLogout').on('click', function() {
        $.post(
                "/php_js/login.php",
                {
                    urlcommand: 'logout'
                }
                )
                .done(function(data){
                    console.log('User log out');
                    window.location = "index.php"
                })
                .fail(function(data){
                    console.log('Fail when: user logout');
                });

    });

});