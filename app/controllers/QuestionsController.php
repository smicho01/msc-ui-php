<?php
include_once 'fns_curl.php';
include_once 'fns_module_college.php';
include_once 'fns_question.php';
include_once 'fns_flash.php';

$VIEW = isset($VIEW) ? $VIEW : 'index';

$QUESTION_SERVICE = new QuestionService();

switch ($VIEW) {
    case 'index':

        break;

    case 'add':
        require_login ();
        $jsfilesExternal = [
            'https://cdn.jsdelivr.net/npm/jquery-validation@1.20.0/dist/jquery.validate.min.js',
            'https://unpkg.com/compromise@13.11.0/builds/compromise.min.js'
        ];
        $jsfiles = ['question']; // will add corresponding *.js files from `/public/js` dir

        // Get college modules
        // $ALL_MODULES = module_get_all(); // get all modules

        $USER_COLLEGE_MODULES = modules_get_by_college_id($_SESSION['user']['collegeId']);

        break;

    case 'process':
        require_login ();
        // check from where the request came , it should be 'index.php?c=questions&v=add' ; if not then it may be fraudulent behaviour
        $haystack = $_SERVER['HTTP_REFERER'];
        $needle = "index.php?c=questions&v=add"; // request should come from that address only !
        if (strpos($haystack, $needle) == false) {
            //echo "The string '$needle' was not found in the string '$haystack'.";
            insertDbLogData('ERROR', $CONTROLLER."::".$VIEW, 'incorrect referrer', 'incorrect referrer: ' . $haystack);
            $_SESSION['errorMessage'] = "Incorrect reference";
            header("Location: index.php?c=error"); // bad request ; skip processing
        }

        /* Insert question */
        $question = new Question();
        $question->fromPostData($_POST);

        $insertResult  = $QUESTION_SERVICE->insertQuestion($question);

        if($insertResult['status_code'] == 201) {
            new FlashMessage('Question added successfully. The status is: PENDING', 'success');
        } else {
            new FlashMessage('Unable to add the question. Please try again later.', 'danger');
        }

        $FLASH = false; // toggle FLASH as this will remove flash message form the session for next page

        header("Location: index.php?c=user&v=questions");
        break;

    case 'show':
        $jsfiles = ['question_details'];
        $isLoggedInUserQuestion = false;
        $questionId = $_GET['id'];
        $question = $QUESTION_SERVICE->getQuestionById($questionId);
        // Check if question belongs to logged-in user to use different question details HTML template etc.
        if(isset($_SESSION['user']['id'])) {
            $isLoggedInUserQuestion = $QUESTION_SERVICE->isUserQuestion($_SESSION['user']['id'], $question);
        }

        // Add selected question ID to session data to have easy access in Answer form and avoid malicious behaviour
        $_SESSION['currentQuestionId'] = $question['id'];

        break;

    default:
        // code...
        break;
}