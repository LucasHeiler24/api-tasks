<?php
namespace src\class;

use DateTime;
use Exception;
use Firebase\JWT\JWT as FirebaseJWT;
use Firebase\JWT\Key;

class Jwt {
    public static function encode(object $data, string $type){
        $now = new DateTime();
        $payload = [
            'id' => $data->id,
            'full_name' => $data->full_name,
            'iat' => $now->getTimestamp(),
            'exp' => $now->modify($type == 'refresh' ? $_ENV['REFRESH_TOKEN'] : $_ENV['EXPIRATION_TOKEN'])->getTimestamp()
        ];
        return FirebaseJWT::encode($payload, $_ENV['SECRET_TOKEN'], 'HS256');
    }

    public static function decode(string $token){
        try{
            return FirebaseJWT::decode($token, new Key($_ENV['SECRET_TOKEN'], 'HS256'));
        }
        catch(Exception $e){
            Response::response(['message' => 'User anauthorized'], 401);
            exit;
        }
    }

}