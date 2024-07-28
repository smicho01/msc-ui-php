$(document).ready(function () {
    // Logout user
    $('.btnLogout').on('click', function (e) {
        $.post(
            "/php_js/login.php",
            {
                urlcommand: 'logout'
            }
        )
            .done(function (data) {
                document.cookie = "accesstoken=";
                window.location = "index.php"
            })
            .fail(function (data) {
                console.log('Fail when: user logout');
            });

    });

    /* Update user token and questions */
    $.ajax({
        url: "/php_js/user.php",
        method: "POST",
        data: {
            urlcommand: 'updateTokenAndQuestions'
        },
        success: function (data) {
            let parsedData = JSON.parse(data)

            if(parsedData['answersSize']) {
                $('.span-answers-size').text(parsedData['answersSize']);
            }
            if(parsedData['questionsSize']) {
                $('.span-questions-size').text(parsedData['questionsSize']);
            }
            if(parsedData['tokens']) {
                $('.span-tokens-count').text(parsedData['tokens'])
            }
        },
        error: function (data) {
            console.log('Fail when updating user token and questions');
        }
    });


    $('.reload-tokens').on('click', function(e){

        const arrowReloadIcon = '<i class="fa-solid fa-arrow-rotate-right"></i>';
        $('.span-answers-size').html(arrowReloadIcon)
        $('.span-questions-size').html(arrowReloadIcon)
        $('.span-tokens-count').html(arrowReloadIcon)

        $.ajax({
            url: "/php_js/user.php",
            method: "POST",
            data: {
                urlcommand: 'reloadUserDetails',
                updateTokens: true,
            },
            success: function (data) {
                let parsedData = JSON.parse(data)

                if(parsedData['answersSize'] >= 0) {
                    $('.span-answers-size').text(parsedData['answersSize']);
                }
                if(parsedData['questionsSize'] >= 0) {
                    $('.span-questions-size').text(parsedData['questionsSize']);
                }
                if(parsedData['tokens'] >= 0) {
                    $('.span-tokens-count').text(parsedData['tokens'])
                }
            },
            error: function (data) {
                console.log('Fail when updating user token and questions');
            }
        });
    })

});
