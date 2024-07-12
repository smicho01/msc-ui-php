<?php
include_once('../init.php');
include_once 'fns_module_college.php';

if (isset($_POST['urlcommand'])) {
    $UrlCommand = $_POST['urlcommand'];

    switch ($UrlCommand) {

        case 'getUserCollegeModules':
            // Get user college modules saved in the session
            $collegeModules = isset($_SESSION['user']['college_modules']) ? $_SESSION['user']['college_modules'] : [];
            echo json_encode($collegeModules);
            break;

        case 'sendFriendRequest':
            $requestingUserId = $_SESSION['user']['id'];
            $requestedUserId = $_POST['userId'];
            $response = UserService::user_send_friend_request($requestingUserId, $requestedUserId);
            fetchUserFriendData();
            echo json_encode($response);
            break;

        case 'acceptFriendRequest':
            $requestingUserId = $_SESSION['user']['id'];
            $requestedUserId = $_POST['userId'];
            $response = UserService::user_accept_friend_request($requestingUserId, $requestedUserId);
            fetchUserFriendData();
            echo json_encode($response);
            break;

        case 'deleteFriendRequest':
            $requestingUserId = $_SESSION['user']['id'];
            $requestedUserId = $_POST['userId'];
            $response = UserService::user_delete_friend_request($requestingUserId, $requestedUserId);
            fetchUserFriendData();
            echo json_encode($response);
            break;

        case 'friendsPageReload':
            fetchUserFriendData();
            echo json_encode($_SESSION['user']['friends']);
            break;


        case 'updateTokenAndQuestions':
            if (isset($_SESSION['user'])) {
                reloadUserTokensToSession();

                if (!isset($_SESSION['user']['user_data_rewritten']) || !$_SESSION['user']['user_data_rewritten']) {
                    reloadUserQuestionsAnswersToSession();
                    echo json_encode([
                        "questionsSize" => $_SESSION['user']['questions-size'],
                        "answersSize" => $_SESSION['user']['answers-size'],
                        "tokens" => $_SESSION['user']['tokens']
                    ]);
                    exit();
                }
            }
            echo json_encode(["status" => 'ok']);
            break;

        case 'reloadUserDetails':
            if (isset($_SESSION['user'])) {
                reloadUserTokensToSession();
                reloadUserQuestionsAnswersToSession();

                echo json_encode([
                    "questionsSize" => $_SESSION['user']['questions-size'],
                    "answersSize" => $_SESSION['user']['answers-size'],
                    "tokens" => $_SESSION['user']['tokens']
                ]);
                exit();
            }
            echo json_encode(["status" => 'ok']);
            break;




    }
}

function fetchUserFriendData() {
    $userId = $_SESSION['user']['id'];
    $allMainUserFriends = UserService::user_get_all_friends($userId);
    $_SESSION['user']['friends'] = $allMainUserFriends;
    $friendRequestsReceived = UserService::user_get_friend_request_received($userId);
    $friendRequestsSent = UserService::user_get_friend_request_sent($userId);
    $_SESSION['user']['request-sent'] = $friendRequestsSent;
    $_SESSION['user']['request-received'] = $friendRequestsReceived;
}

function reloadUserQuestionsAnswersToSession() {
    $_SESSION['user']['questions-size'] = 0;
    $_SESSION['user']['questions'] = [];
    $userQuestions = UserService::user_get_questions_short($_SESSION['user']['id']);
    if (!is_null($userQuestions) && !empty($userQuestions)) {
        $_SESSION['user']['questions-size'] = count($userQuestions);
        $_SESSION['user']['questions'] = $userQuestions;
    }

    $_SESSION['user']['answers-size'] = 0;
    $userAnswers = UserService::user_get_answers($_SESSION['user']['id']);
    if ($userAnswers) {
        $_SESSION['user']['answers-size'] = count($userAnswers);
        $_SESSION['user']['answers'] = $userAnswers;
    }
}

function reloadUserTokensToSession(){
    $user = UserService::getUser("id", $_SESSION['user']['id']);
    $_SESSION['user']['tokens'] = $user['tokens'];
}