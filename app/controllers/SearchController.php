<?php
include_once("fns_question.php");
include_once("fns_utils.php");

$VIEW = isset($VIEW) ? $VIEW : 'index';
require_login();
switch ($VIEW) {
    case 'index':
        // Store search term and if search only within user college in teh Session
        $_SESSION['search']['searchTerm'] = '';
        $_SESSION['search']['onlyCollege'] = false;
        $onlyCollege = isset($_POST['onlyCollege']) ? true : false;
        if($onlyCollege) {
            $_SESSION['search']['onlyCollege'] = true;
        }

        if (isset($_POST['searchTerm']) && $_POST['searchTerm'] != null) {
            // Sanitize and validate search input
            $input = $_POST['searchTerm'];
            $sanitizedInput = sanitize_input($input);
            $sanitizedInput = sanitize_tags($sanitizedInput);
            try {
                $validatedInput = validate_input($sanitizedInput);
            } catch (Exception $e) {
            }
            $searchTerm = $validatedInput;
            $_SESSION['search']['searchTerm'] = $searchTerm;
        } else {
            header("Location: index.php");
        }
        $displayResults = 5; // how many first results to display
        $allFoundUsers = UserService::user_get_by_username_like($searchTerm, $onlyCollege);
        $foundUsers = [];
        foreach ($allFoundUsers as $user) {
            if($user['id'] != $_SESSION['user']['id']) {
                array_push($foundUsers, $user);
            }
        }
        $foundUsersCount = $foundUsers != null ? count($foundUsers) : 0;

        $foundQuestions = QuestionService::get_by_title_like($searchTerm, $onlyCollege);
        $foundQuestionsCount = $foundQuestions != null ? count($foundQuestions) : 0;
        break;


    case 'all':
        $searchTerm = isset($_GET['term']) ? $_GET['term'] : $_SESSION['search']['searchTerm'];
        $entity = isset($_GET['entity']) ? $_GET['entity'] : 'question';
        $onlyCollege = isset($_SESSION['search']['onlyCollege']) ? $_SESSION['search']['onlyCollege'] : false;

        switch ($entity) {
            case 'question':
                $foundQuestions = QuestionService::get_by_title_like($searchTerm, $onlyCollege);
                $foundQuestionsCount = count($foundQuestions);
                break;

            case 'users':
                $foundUsers = UserService::user_get_by_username_like($searchTerm, $onlyCollege);
                $foundUsersCount = count($foundUsers);
                break;
        }

        break;

    default:

        break;
}

function sanitize_input($input) {
    // Remove any unwanted characters (e.g., non-alphanumeric, non-space characters)
    $input = preg_replace('/[^a-zA-Z0-9\s]/', '', $input);
    $input = trim($input);
    return $input;
}

function validate_input($input) {
    // Validate the input (e.g., check if it's not empty after sanitization)
    if (empty($input)) {
        throw new Exception('Invalid input. Please provide a valid search term.');
    }
    return $input;
}

function sanitize_tags($input) {
    // Remove PHP and HTML tags
    $input = strip_tags($input);
    // Convert special characters to HTML entities to prevent XSS attacks
    $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    $input = filter_var($input, FILTER_SANITIZE_FULL_SPECIAL_CHARS); // Safer option
    return $input;
}