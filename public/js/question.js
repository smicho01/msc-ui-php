$(document).ready(function () {

    // Add custom validation method to check if entered text is a valid English text.
    $.validator.addMethod("isValidEnglishText", function (value, element, params) {
        // Parse the sentence with Compromise
        const doc = nlp(value);
        // Check for the presence of a subject (noun) and a predicate (verb)
        const hasNoun = doc.nouns().length > 0;
        const hasVerb = doc.verbs().length > 0;
        // Additional checks can be added here (e.g., sentence length, specific word patterns, etc.)
        const hasSubject = doc.match('#Noun').length > 0;
        const hasPredicate = doc.match('#Verb').length > 0;
        // Validate the sentence based on the checks
        return hasSubject && hasPredicate;
    }, "Must be valid English text");

    $('#form-ask-question').validate({
        rules: {
            form_question_title: {
                required: true,
                minlength: 30,
                isValidEnglishText: true
            },
            form_question_problem: {
                required: true,
                minlength: 10,
                isValidEnglishText: true
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
        submitHandler: function (form) {

            // Final validation that was hard to impl. with $.validator
            // Relates mostly to dynamic or 'outside-form' elements
            let otherErrors = []
            // Validate min number of question tags
            let count = $('input[type="hidden"][name="tags[]"]').length;
            if(count < 2) {
               otherErrors.push("Min 2 tags required")
            }

            // If any error , then do display alert and do not submit form
            if (otherErrors.length > 0) {
                // Display the other errors
                otherErrors.forEach(function (error) {
                    let alertHtml = $('<div>').addClass('alert alert-danger').text(error);
                    $('#form-errors').html(alertHtml);
                });
                // Prevent form submission
                return false;
            }

            // Submit form if no errors
            form.submit();
        }
    })


    /*
        Creates tags each time user press coma or space within #form_question_tags_input
     */
    $('#form_question_tags_input').on('keydown', function (e) {
        // Check if the comma key (key code 188) or space bar [188] was pressed
        if (e.keyCode === 32 || e.keyCode === 188) {
            // Get the value of the input field
            let currentValue = $(this).val().trim();
            currentValue = currentValue.replace(/^,|,$/g, '');
            // If the current value is not empty, add it to the tags string
            if (currentValue !== '') {
                // Call the function to add tags to the form
                addTag(currentValue, 'form-ask-question'); // Actual function to add tag
                // Clear the input field
                $(this).val('');
            }
            $(this).val('');
        }
    });

    /*
        Remove tag by clicking on tag
     */
    $('#tagsContainer').on('click', '.tag', function () {
        const tag = $(this).attr('data-tag');
        // Remove the hidden input element with the same value
        $('input[type="hidden"][value="' + tag + '"]').remove();
        // Remove the tag element
        $(this).remove();
        // Hide the limit message if the number of tags is less than 5
        if ($('input[name="tags[]"]').length < 5) {
            $('#limitMessage').hide();
        }
    });

});

/*
    Simple sentence validation function
    It validates if given phrase is a valid English phrase
 */
function validateSentence(sentence) {
    // Parse the sentence with Compromise
    const doc = nlp(sentence);
    // Check for the presence of a subject (noun) and a predicate (verb)
    const hasNoun = doc.nouns().length > 0;
    const hasVerb = doc.verbs().length > 0;
    // Additional checks can be added here (e.g., sentence length, specific word patterns, etc.)
    const hasSubject = doc.match('#Noun').length > 0;
    const hasPredicate = doc.match('#Verb').length > 0;
    // Validate the sentence based on the checks
    return hasSubject && hasPredicate;
}

/*
    Add tags to a form as hidden field and also display selected tags to UI
    so that they can be removed by clicking on them
 */
function addTag(tag, formId) {
    // Check if the number of existing tags is less than 5
    if ($('input[name="tags[]"]').length >= 5) {
        $('#limitMessage').show();
        return;
    }
    $('#limitMessage').hide();
    // Create a hidden input element
    const hiddenInput = $('<input>').attr({
        type: 'hidden',
        name: 'tags[]',
        value: tag.trim()
    });
    // Append the hidden input element to the form
    $('#' + formId).append(hiddenInput);
    // Create a tag element
    const tagElement = $('<span>').addClass('tag badge rounded-pill bg-primary').text(tag.trim()).attr('data-tag', tag.trim());
    // Append the tag element to the tags container
    $('#tagsContainer').append(tagElement);
}

