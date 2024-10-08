<?php
include_once 'fns_curl.php';
include_once 'fns_flash.php';
include_once 'fns_utils.php';
include_once 'fns_user.php';
include_once 'fns_message.php';

$VIEW = isset($VIEW) ? $VIEW : 'index';
require_login();
switch ($VIEW) {
    case 'updatedata':
        // Attach js files to the footer
        //$jsfiles = ['users'];
        $foundUserResponse = rest_call('GET',
            USER_SERVICE_URI . "/generatenames?count=80", $data = false, 'application/json',
            "Bearer " . $_SESSION['token']);
        $generatedUserNames = json_decode($foundUserResponse['body'], true);
        break;

    case 'walletkeys':
        $jsfiles = ['keys'];
        break;

    case 'questions':
        $questions = UserService::user_get_questions_short($_SESSION['user']['id']);
        break;

    case 'transactions':
        $foundUser = UserService::getUser('id', $_SESSION['user']['id']);
        $_SESSION['user']['tokens'] = $foundUser['tokens'];

        $allUserTransactions = UserService::get_user_transactions($_SESSION['user']['id']);
        $userTransactions = [];
        if ($allUserTransactions != false || count($allUserTransactions) > 0) {
            foreach ($allUserTransactions as $transaction) {
                $currentTransaction = create_transaction_array_entry($transaction);
                array_push($userTransactions, $currentTransaction);
            }
        }
        break;


    case 'show':
        $jsfiles = ['user','message'];
        if (isset($_GET['un']) && $_GET['un'] != '') {
            $username = $_GET['un'];
            $foundUser = UserService::getUser('visibleusername', $username);

        } else {
            header("Location: index.php");
        }

        $friendRequestsReceived = UserService::user_get_friend_request_received($_SESSION['user']['id']);
        $friendRequestsSent = UserService::user_get_friend_request_sent($_SESSION['user']['id']);
        $_SESSION['user']['request-sent'] = $friendRequestsSent;
        $_SESSION['user']['request-received'] = $friendRequestsReceived;

        // Check if displayed user is already a friend.
        $isFriendWithDisplayedUser = false;
        foreach ($_SESSION['user']['friends'] as $friend) {
            if ($friend['id'] == $foundUser['id']) {
                $isFriendWithDisplayedUser = true;
            }
        }

        $friendRequestSentToUser = false;
        foreach ($_SESSION['user']['request-sent'] as $request) {
            if ($foundUser['id'] == $request['id']) {
                $friendRequestSentToUser = true;
            }
        }

        $userQuestions =  UserService::user_get_questions_short($foundUser['id']);

        break;

    case 'friends':
        $jsfiles = ['user'];
        $friends = UserService::user_get_all_friends($_SESSION['user']['id']);
        $friendRequestsReceived = UserService::user_get_friend_request_received($_SESSION['user']['id']);
        $friendRequestsSent = UserService::user_get_friend_request_sent($_SESSION['user']['id']);
        $_SESSION['user']['request-sent'] = $friendRequestsSent;
        $_SESSION['user']['request-received'] = $friendRequestsReceived;

        break;

    case 'messages':
        $jsfiles = ['message'];
        $messages = UserService::user_get_all_messages($_SESSION['user']['id']);
        if($messages != null && count($messages) > 0) {
            if(isset($_GET['with']) && $_GET['with'] != '') {
                $selectedMessage = $messages[$_GET['with']];
            } else {
                $selectedMessage = reset($messages); // Get 1st messages list
            }

            MessageService::message_set_all_messages_read_from_to($selectedMessage['user']['id'], $_SESSION['user']['id']);
        }

        break;

    default:
        // code...
        break;
}

function create_transaction_array_entry($transaction)
{
    $datetime = new DateTime($transaction['timestamp']);
    $output = [
        'id' => $transaction['id'],
        'amount' => $transaction['amount'],
        'event' => map_event_type_to_readable_string($transaction['eventType']),
        'date' => $datetime->format('Y-m-d / H:i:s'),
        'type' => $transaction['inout']
    ];
    return $output;
}

function map_event_type_to_readable_string($type)
{
    switch ($type) {
        case 'EVENT_BEST_ANSWER':
            return 'Best Answer';
        case 'EVENT_ITEM_PURCHASE':
            return 'Item Purchase';
        case 'EVENT_ONE_TO_ONE':
            return 'One To One';
        default:
            return 'Unknown Transaction';
    }
}
