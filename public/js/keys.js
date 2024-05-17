$(document).ready(function () {

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

    $('#btn-get-key').on('click', function (e) {
        $.post("/php_js/wallet.php", { urlcommand: 'getkeys' })
            .done(function (data) {
                console.log(data)
                let dataJson = JSON.parse(data);
                const puk = dataJson['publicKey'];
                const prk =  dataJson['privateKey'];
                $('#prk').val(prk);
                $('#puk').val(puk);
            })
            .fail(function (data) {
                console.log('Fail when: user logout');
            });
    })
});