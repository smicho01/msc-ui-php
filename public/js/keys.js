$(document).ready(function () {

    // Get user wallet keys
    // PHP script will get encrypted values and decrypts it locally
    $('#btn-get-key').on('click', function (e) {
        $.post("/php_js/wallet.php", { urlcommand: 'getkeys' })
            .done(function (data) {
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