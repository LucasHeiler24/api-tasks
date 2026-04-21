<?php 
namespace src\controllers;

use src\class\Response;
use src\class\Validation;
use src\models\Tasks as TasksModel;

class Tasks extends TasksModel {

    public function all(array $variables=[]){
        $data = $this->getAll($variables[0]->id) ?? [];
        Response::response($data, 200);
    }

    public function create(){
        $data = json_decode(file_get_contents('php://input'), true);
        if(isEmpty($data)){
            Response::response(['message' => 'Please, insert the fields correctly!'], 400);
            exit;
        }
        $clean = Validation::cleanInputs($data);
        $errors = Validation::task($clean);
        if(count($errors) > 0){
            Response::response($errors, 400);
            exit;
        }
        $this->postTask($data);
        Response::response(['message' => 'Task created with success!'], 201);
    }
    
    public function update(array $variables=[]){
        $data = json_decode(file_get_contents('php://input'), true);
        if(isEmpty($data)){
            Response::response(['message' => 'Please, insert the fields correctly!'], 400);
            exit;
        }
        $clean = Validation::cleanInputs($data);
        $errors = Validation::task($clean);
        if(count($errors) > 0){
            Response::response($errors, 400);
            exit;
        }
        $this->putTask((int) $variables[0], $data);
        Response::response([], 204);
    }
    
    public function delete(array $variables=[]){
        $this->deleteTask((int) $variables[0]);
        Response::response([], 204);
    }
}