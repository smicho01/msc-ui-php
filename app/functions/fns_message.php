<?php
include_once 'fns_curl.php';


class MessageService
{
    public static function message_set_all_messages_read_from_to($fromId, $toId) {
        $data = [];
        $uri = USER_SERVICE_URI . "/message/updatereadall/" . $fromId . "/" . $toId;
        return curl_put($uri, $data, "Bearer " . $_SESSION['token']);
    }

    public static function message_send($fromId, $toId, $message) {
        $data = [
            "fromId" => trim($fromId),
            "toId" => trim($toId),
            "content" => trim($message)
        ];

        return curl_post(USER_SERVICE_URI . "/message", $data, "Bearer " . $_SESSION['token']);
    }
}