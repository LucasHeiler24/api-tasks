<?php
namespace src\controllers;

use src\class\Response;
use src\class\Validation;
use src\models\RefreshToken;
use src\models\User as UserModel;

class User extends UserModel {

    public function signup(){
        $data = json_decode(file_get_contents('php://input'), true);
        if(isEmpty($data)){
            Response::response(['message' => 'Please, insert the fields correctly!'], 400);
            exit;
        }
        $clean = Validation::cleanInputs($data);
        $errors = Validation::signup($clean);
        if(count($errors)){
            Response::response($errors, 400);
            exit;
        }
        $this->postSignup($clean);
        Response::response(['message' => 'User created with success!'], 201);
    }
    
    public function signin(){
        $data = json_decode(file_get_contents('php://input'), true);
        if(isEmpty($data)){
            Response::response(['message' => 'Please, insert the fields correctly!'], 400);
            exit;
        }
        $clean = Validation::cleanInputs($data);
        $user = $this->postSigin($clean);
        $token = (new RefreshToken)->refresh($user);
        Response::response(['token' => $token], 200);
    }
}