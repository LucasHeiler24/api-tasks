<?php 
namespace src\models;

use PDOException;
use src\class\Response;
use src\db\connection\Connection;

class User extends Connection{
    protected function postSignup(array $data){
        try{
            $conn = $this->getConnection();
            $prepare = $conn->prepare("INSERT INTO users (full_name, email, password, active) VALUES (:full_name, :email, :password, false)");
            $prepare->execute([
                ':full_name' => $data['full_name'],
                ':email' => $data['email'],
                ':password' => password_hash($data['password'], PASSWORD_DEFAULT),
            ]);
            return $prepare->rowCount() > 0 ? true : false;
        }
        catch(PDOException $e){
            Response::response(['message' => 'Error internal!'], 500);
            exit;
        }
    }
    
    protected function postSigin(array $data){
        try{
            $conn = $this->getConnection();
            $prepare = $conn->prepare("SELECT * FROM users WHERE email = :email");
            $prepare->execute([':email' => $data['email']]);
            
            $user = $prepare->fetchObject();
            if (!$user || !password_verify($data['password'], $user->password)){
                Response::response(['message' => 'User anauthorized!'], 401);
                exit;
            }

            $conn->query("UPDATE users SET active = true WHERE id = {$user->id}");
            unset($user->password, $user->active, $user->email);
            return $user;
        }
        catch(PDOException $e){
            Response::response(['message' => 'Error internal!'], 500);
            exit;
        }
    }

}
