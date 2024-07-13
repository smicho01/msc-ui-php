<?php
include_once 'fns_curl.php';

class NlpService {

    public static function validate_question($title, $body) {
        $url = NLP_SERVICE_URI . "/validate/question";
        $data = [
            'title' => $title,
            'body' => $body
        ];
        return curl_post_nlp($url, $data);
    }
}