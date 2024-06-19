$(document).ready(function () {

    const minimalAnswerLength = 100;

    // Hide form
    $('#btn-close-form').on('click', function(event) {
        event.preventDefault();
        $('#form_answer_field').val('');
        $('#answer-error').text('')
        $('#answer-form-wrapper').hide();
    });

    // Show form
    $('#add-answer-button').on('click', function(event) {
        event.preventDefault();
        $('#form_answer_field').val('');
        $('#answer-error').text('')
        $('#answer-form-wrapper').show();

    });

    $('#btn-submit-question').on('click', function(event) {
        event.preventDefault();
        $('#answer-error').text('')

        // Fill in form with correct data from session
        $.post("/php_js/question.php", { urlCommand: 'getAnswerSessionData' })
                .done(function (data) {
                    let parsedResponse = JSON.parse(data)
                    $('#user_id').val(parsedResponse['userId']);
                    $('#question_id').val(parsedResponse['questionId']);
                });

        // Prepare answer txt
        let answerText = $('#form_answer_field').val();
        const answerSanitized = sanitize(answerText);
        if(answerSanitized.length > minimalAnswerLength) {
            console.log("Sending answer ...")
            $(this).prop("disabled", true);
            $(this).text("Sending ...");
            setTimeout(function (){
                $.post("/php_js/question.php", {
                    urlCommand: 'insertAnswer',
                    content: answerText,
                    userId: $('#question_id').val(),
                    questionId: $('#question_id').val()
                }).done(function (data) {
                    let parsedResponse = JSON.parse(data)
                    console.log(parsedResponse)

                    $('#add-answer-button').removeClass('btn-primary').addClass('btn-success').text("Answer submitted");

                });

                // Enable btn and hide form
                $('#btn-submit-question').prop("disabled", false);
                $('#btn-submit-question').text("Submit answer");
                $('#answer-form-wrapper').hide();

            }, 1000);
        } else {
            $('#answer-error').text(`Minimal number of characters for answer is: ${minimalAnswerLength}`);
        }


        setTimeout(function(){
            $('#add-answer-button').removeClass('btn-success').addClass('btn-primary').text("Add answer");
        }, 3000)
    });

});

/**
 * Represents the variable "text" which holds a string value.
 *
 * @type {string}
 */
function sanitize(text) {
    return text
        .replace(/\\/g, '\\\\')
        .replace(/\$/g, '\\$')
        .replace(/'/g, "\\'")
        .replace(/"/g, '\\"');
}