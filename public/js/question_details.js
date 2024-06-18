$(document).ready(function () {


    $('#add-answer-button').on('click', function(event) {
        event.preventDefault();
        $('#answer-form-wrapper').show();
    });

    $('#btn-submit-question').on('click', function(event) {
        event.preventDefault();
        console.log('answer clicked');

        $(this).prop("disabled", true);

        // Fill in form with correct data from session
        $.post("/php_js/question.php", { urlCommand: 'getAnswerSessionData' })
                .done(function (data) {
                    let parsedResponse = JSON.parse(data)
                    $('#user_id').val(parsedResponse['userId']);
                    $('#question_id').val(parsedResponse['questionId']);
                });

        setTimeout(function (){
            $.post("/php_js/question.php", {
                urlCommand: 'insertAnswer',
                answerText: 'Ala ma kotka',
                userId: $('#question_id').val(),
                questionId: $('#question_id').val()
            }).done(function (data) {
                let parsedResponse = JSON.parse(data)
                console.log(parsedResponse)
            });

            // Eanble btn
            $('#btn-submit-question').prop("disabled", false);
        }, 1000);




    });

});