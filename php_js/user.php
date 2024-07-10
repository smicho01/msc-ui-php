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
            // Get all user friends
            $allMainUserFriends = UserService::user_get_all_friends($_SESSION['user']['id']);
            $_SESSION['user']['friends'] = $allMainUserFriends;
            echo json_encode($response);
            break;

        case 'acceptFriendRequest':
            $requestingUserId = $_SESSION['user']['id'];
            $requestedUserId = $_POST['userId'];
            $response = UserService::user_accept_friend_request($requestingUserId, $requestedUserId);
            // Get all user friends
            $allMainUserFriends = UserService::user_get_all_friends($_SESSION['user']['id']);
            $_SESSION['user']['friends'] = $allMainUserFriends;

            echo json_encode($response);
            break;

        case 'friendsPageReload':
            $friendRequestsReceived = UserService::user_get_friend_request_received($_SESSION['user']['id']);
            $friendRequestsSent = UserService::user_get_friend_request_sent($_SESSION['user']['id']);
            $allMainUserFriends = UserService::user_get_all_friends($_SESSION['user']['id']);
            $_SESSION['user']['friends'] = $allMainUserFriends;
            echo json_encode($allMainUserFriends);
            break;

    }
}

