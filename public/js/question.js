$(document).ready(function () {

    let userCollegeModules = [];

    /* Get user college modules */
    $.post("/php_js/user.php", { urlcommand: 'getUserCollegeModules'})
        .done(function (data) {
            userCollegeModules = JSON.parse(data)
            autocomplete(document.getElementById("form_question_module"), userCollegeModules);
        })
        .fail(function (data) {
            console.log('Fail when getting user modules');
        });


    /* Add custom validation method to check if entered text is a valid English text. */
    $.validator.addMethod("isValidEnglishText", function (value) {
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

    // VALIDATE FORM
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
            },
            form_question_module: {
                required: true,
                minlength: 2
            },
            sel_mod: {
                required:true,
                minlength:200
            }
        },
        messages: {
            form_question_title: {
                required: 'Please enter your question title. It is required'
            },
            form_question_problem: {
                required: 'Please, specify your problem. It should contain as much information as possible.'
            },
            form_question_module: {
                required: "Please start typing module name to select it from the list"
            }
        },
        submitHandler: function (form) {
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

            // ADD custom title and text validation with use of NLP service
            let questionTitle = $('#form_question_title').val();
            let questionBody = $('textarea#form_question_problem').val();
            $.post("/php_js/question.php", {
                urlCommand: 'validateQuestionWithNLP',
                title: questionTitle,
                body: questionBody
            }).done(function (data) {
                let parsedData = JSON.parse(data)
                let response = JSON.parse(parsedData['body'])

                let modalWindow = null;
                let isValidTitleAndBody = true;
                if(!response['valid_english_body'] || !response['valid_english_title'] ||
                    response['toxicity_score_body'] > 0.35 || response['toxicity_score_title'] > 0.35 ) {
                    isValidTitleAndBody = false;
                    modalWindow = new bootstrap.Modal(document.getElementById('validateQuestionModal'), {
                        keyboard: false
                    })
                    modalWindow.show()
                } else {
                    form.submit(); // Last point of validation. Submit form.
                }
                }).fail(function (xhr, status, error) {
                console.log("validateQuestionWithNLP error ... : ")
            });
            return false;
            // Submit form if no errors
            //form.submit();
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


// AUTOCOMPLETE
function autocomplete(inp, arr) {
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/
    var currentFocus;
    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function(e) {
        var a, b, i, val = this.value;
        /*close any already open lists of autocompleted values*/
        closeAllLists();
        if (!val) { return false;}
        currentFocus = -1;
        /*create a DIV element that will contain the items (values):*/
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        /*append the DIV element as a child of the autocomplete container:*/
        this.parentNode.appendChild(a);
        /*for each item in the array...*/
        for (i = 0; i < arr.length; i++) {

            /*check if the item starts with the same letters as the text field value:*/
            if (arr[i].name.substr(0, val.length).toUpperCase() === val.toUpperCase()) {
                /*create a DIV element for each matching element:*/
                b = document.createElement("DIV");
                /*make the matching letters bold:*/
                b.innerHTML = "<strong>" + arr[i].name.substr(0, val.length) + "</strong>";
                b.innerHTML += arr[i].name.substr(val.length);
                /*insert a input field that will hold the current array item's value:*/
                b.innerHTML += "<input type='hidden' value='" + arr[i].name + "'>";
                document.getElementById("selected_module").innerHTML = "<input type='hidden' id='sel_mod' name='sel_mod' value='" + arr[i].id + "'>";
                /*execute a function when someone clicks on the item value (DIV element):*/
                b.addEventListener("click", function(e) {
                    /*insert the value for the autocomplete text field:*/
                    inp.value = this.getElementsByTagName("input")[0].value;
                    /*close the list of autocompleted values,
                    (or any other open lists of autocompleted values:*/
                    closeAllLists();
                });
                a.appendChild(b);
            }
        }
    });
    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function(e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
            /*If the arrow DOWN key is pressed,
            increase the currentFocus variable:*/
            currentFocus++;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 38) { //up
            /*If the arrow UP key is pressed,
            decrease the currentFocus variable:*/
            currentFocus--;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 13) {
            /*If the ENTER key is pressed, prevent the form from being submitted,*/
            e.preventDefault();
            if (currentFocus > -1) {
                /*and simulate a click on the "active" item:*/
                if (x) x[currentFocus].click();
            }
        }
    });
    function addActive(x) {
        /*a function to classify an item as "active":*/
        if (!x) return false;
        /*start by removing the "active" class on all items:*/
        removeActive(x);
        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);
        /*add class "autocomplete-active":*/
        x[currentFocus].classList.add("autocomplete-active");
    }
    function removeActive(x) {
        /*a function to remove the "active" class from all autocomplete items:*/
        for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
        }
    }
    function closeAllLists(elmnt) {
        /*close all autocomplete lists in the document,
        except the one passed as an argument:*/
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) {
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }
    /*execute a function when someone clicks in the document:*/
    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
}
