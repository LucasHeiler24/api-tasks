<?php
namespace src\class;

class Response {

    public static function response(array $message = [], int $status){
        http_response_code($status);
        if($status != 204)
            echo json_encode($message);
    }

}