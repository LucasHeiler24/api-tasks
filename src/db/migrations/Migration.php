<?php
namespace src\db\migrations;

use src\db\connection\Connection;

class Migration extends Connection{
    public function init(string $query){
        $conn = $this->getConnection();
        $conn->query($query);
    }

    public function users(){
        $conn = $this->getConnection();
        $users = require __DIR__ . "/mocks/users.php";
        foreach($users as $user)
            $conn->query("INSERT INTO users (full_name, email, password, active) VALUES ('{$user['full_name']}', '{$user['email']}', '{$user['password']}', false)");
    }

    public function tasks(){
        $conn = $this->getConnection();
        $tasks = require __DIR__ . "/mocks/tasks.php";
        foreach($tasks as $task)
            $conn->query("INSERT INTO tasks (description, date, is_done, user_id) VALUES ('{$task['description']}', '{$task['date']}', '{$task['is_done']}', {$task['user_id']})");  
    }

}