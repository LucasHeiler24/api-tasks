<?php
namespace src\models;

use DateTime;
use PDOException;
use src\class\Jwt;
use src\class\Response;
use src\db\connection\Connection;

class RefreshToken extends Connection{

    private function createRefresh(object $user, string $token){
        try{
            $conn = $this->getConnection();
            $prepare = $conn->prepare("INSERT INTO refresh_token (token, user_id) VALUES (:token, :user_id)");
            $prepare->execute([
                ':token' => $token,
                ':user_id' => $user->id
            ]);
            return $token;
        }
        catch(PDOException $e){
            Response::response(['message' => 'Error internal'], 500);
        }
    }

    public function refresh(object $user){
        try{
            $conn = $this->getConnection();
            $refresh = $conn->query("SELECT id, token FROM refresh_token WHERE user_id = $user->id");
            $refresh = $refresh->fetchObject();
            if (!$refresh) 
                return $this->createRefresh($user, Jwt::encode($user, 'login'));
            if(Jwt::decode($refresh->token))
               return $refresh->token; 
            $refreshToken = Jwt::encode($user, 'refresh');
            $prepare = $conn->prepare("UPDATE refresh_token SET token = :refresh WHERE id = :id");
            $prepare->execute([
                ':refresh' => $refreshToken,
                ':id' => $refresh->id
            ]);
            return $refreshToken;
        }
        catch(PDOException $e){
            Response::response(['message' => 'Error internal'], 500);
            exit;
        }
    }

}