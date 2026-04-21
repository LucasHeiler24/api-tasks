<?php 
namespace src\models;

use PDO;
use PDOException;
use src\class\Response;
use src\db\connection\Connection;

class Tasks extends Connection{
    protected function getAll(int $id){
        try{
            $conn = $this->getConnection();
            $prepare = $conn->prepare("SELECT * FROM tasks WHERE user_id = :id");
            $prepare->execute([
                ':id' => $id
            ]);
            return $prepare->fetchAll(PDO::FETCH_OBJ);
        }
        catch(PDOException $e){
            Response::response(['message' => 'Error internal!'], 500);
            exit;
        }
    }

    protected function postTask(array $task){
        try{
            $conn = $this->getConnection();
            $prepare = $conn->prepare("INSERT INTO tasks (description, date, is_done, user_id) VALUES (:description, :date, :is_done, :user_id)");
            $prepare->execute([
                ':description' => $task['description'],
                ':date' => $task['date'],
                ':is_done' => $task['is_done'],
                ':user_id' => $task['user_id']
            ]);
            return $prepare->rowCount() > 0 ? true : false;
        }
        catch(PDOException $e){
            Response::response(['message' => 'Error internal!'], 500);
            exit;
        }
    }

    protected function putTask(int $id, array $task){
        try{
            $conn = $this->getConnection();
            $prepare = $conn->prepare("UPDATE tasks SET description = :description, date = :date, is_done = :is_done WHERE id = :id");
            $prepare->execute([
                ':description' => $task['description'],
                ':date' => $task['date'],
                ':is_done' => $task['is_done'],
                ':id' => $id
            ]);
            return $prepare->rowCount() > 0 ? true : false;
        }
        catch(PDOException $e){
            Response::response(['message' => 'Error internal!'], 500);
            exit;
        }
    }

    protected function deleteTask(int $id){
        try{
            $conn = $this->getConnection();
            $prepare = $conn->prepare("DELETE FROM tasks WHERE id = :id");
            $prepare->execute([
                ':id' => $id
            ]);
        }
        catch(PDOException $e){
            Response::response(['message' => 'Error internal!'], 500);
            exit;
        }
    }
}