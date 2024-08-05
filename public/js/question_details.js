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
        // Submit answer if it has a min length
        if(answerSanitized.length > minimalAnswerLength) {
            console.log("Sending answer ...")
            $(this).prop("disabled", true);
            $(this).text("Sending ...");
            setTimeout(function (){
                $.post("/php_js/question.php", {
                    urlCommand: 'insertAnswer',
                    content: answerText,
                    userId: $('#user_id').val(),
                    questionId: $('#question_id').val()
                }).done(function (data) {
                    const parsedResponse = JSON.parse(data)
                    //console.log(parsedResponse)
                    const responseStatusCode =  parsedResponse['status_code']
                    switch (responseStatusCode) {
                        case '201':
                            $('#add-answer-button').removeClass('btn-primary').addClass('btn-success').text("Answer submitted with status PENDING.");
                            break;

                        default:
                            console.log('Add answer response code: ',responseStatusCode )
                            $('#add-answer-button').removeClass('btn-primary').addClass('btn-danger').text("Couldn't add answer");
                    }


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
            $('#add-answer-button').removeClass('btn-success').removeClass('btn-danger').addClass('btn-primary').text("Add answer");
        }, 3000)
    });



    /* SELECTING BEST ANSWER */
    var modalWindow = null;
    let bestAnswerId = null;
    $('.ikonka-select-best').on('click', function(event) {
        modalWindow = new bootstrap.Modal(document.getElementById('selectBestModal'), {
            keyboard: false
        })
        bestAnswerId = $(this).attr("data-id")
        modalWindow.show()
    })

    $('#select-bes-answer-btn').on('click', function(event){
        $.post("/php_js/question.php", { urlCommand: 'selectBestAnswer', answerId: bestAnswerId })
            .done(function (data) {
                let parsedResponse = JSON.parse(data)
                const responseCode = parsedResponse.status_code;

                // Code 409 (CONFLICT) will be treated as malicious behaviour
                if(responseCode == 409) {
                    $('#add-answer-button').removeClass('btn-primary').addClass('btn-danger').text("Malicious behaviour reported. DO NOT SELECT BEST ANSWER AGAIN !!");
                    modalWindow.hide();
                } else {
                    modalWindow.hide()
                    location.reload();
                }
            });
    })

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