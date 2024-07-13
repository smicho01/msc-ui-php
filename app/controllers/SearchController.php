<?php
include_once("fns_question.php");
include_once("fns_utils.php");

$VIEW = isset($VIEW) ? $VIEW : 'index';
require_login();
switch ($VIEW) {
    case 'index':
        if (isset($_POST['searchTerm'])) {
            $_SESSION['searchTerm'] = $_POST['searchTerm'];
            $searchTerm = $_POST["searchTerm"];
        } else if (isset($_SESSION['searchTerm']) && $_SESSION['searchTerm'] != null) {
            $searchTerm = $_SESSION['searchTerm'];
        } else {
            header("Location: index.php");
        }
        $displayResults = 5; // how many first results to display
        $foundUsers = UserService::user_get_by_username_like($searchTerm);
        $foundUsersCount = count($foundUsers);
        $foundQuestions = QuestionService::get_by_title_like($searchTerm);
        $foundQuestionsCount = count($foundQuestions);
        break;


    case 'all':
        $searchTerm = isset($_GET['term']) ? $_GET['term'] : $_SESSION['searchTerm'];
        $entity = isset($_GET['entity']) ? $_GET['entity'] : 'question';

        switch ($entity) {
            case 'question':
                $foundQuestions = QuestionService::get_by_title_like($searchTerm);
                $foundQuestionsCount = count($foundQuestions);
                break;

            case 'users':
                $foundUsers = UserService::user_get_by_username_like($searchTerm);
                $foundUsersCount = count($foundUsers);
                break;
        }

        break;

    default:

        break;
}