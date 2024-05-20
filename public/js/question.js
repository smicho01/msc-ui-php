$(document).ready(function() {
    $('#form-ask-question').validate({
        rules: {
            form_question_title: {
                required: true,
                minlength: 3
            },
            form_question_problem: {
                required: true,
                minlength: 10
            }
        },
        messages: {
            form_question_title: {
                required: 'Please enter your question title. It is required'
            },
            form_question_problem: {
                required: 'Please, specify your problem. It should contain as much information as possible.'
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    })
});