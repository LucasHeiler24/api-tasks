<?php

use src\class\Router;
use src\db\migrations\Migration;

function getPath(){
    return $_SERVER['REQUEST_URI'];
}

function getMethod(){
    return strtolower($_SERVER['REQUEST_METHOD']);
}

function getRoutes(){
    $routes = require __DIR__ . DIRECTORY_SEPARATOR . "../routes/route.php";
    return $routes[getMethod()];
}

function run(){
    $migration = new Migration;
    $migration->init("CREATE TABLE IF NOT EXISTS users (
        id SERIAL PRIMARY KEY,
        full_name TEXT NOT NULL,
        email TEXT NOT NULL,
        password TEXT NOT NULL,
        active BOOLEAN NOT NULL
    )");
    $migration->init("CREATE TABLE IF NOT EXISTS tasks (
        id SERIAL PRIMARY KEY,
        description TEXT NOT NULL,
        date DATE NOT NULL,
        is_done varchar(10) NOT NULL,
        user_id INT,
        FOREIGN KEY (user_id) REFERENCES users(id)
    )");
    $migration->init("CREATE TABLE IF NOT EXISTS refresh_token (
        id SERIAL PRIMARY KEY,
        token VARCHAR(500) NOT NULL,
        user_id INT,
        FOREIGN KEY (user_id) REFERENCES users(id)
    )");
    $migration->users();
    $migration->tasks();
}

function init(){
    try{
        $router = new Router;
        $router->route();
    }
    catch(Throwable $th){
        var_dump($th->getMessage());
    }
}

function isEmpty(array $data){
    foreach($data as $content){
        if(empty($content))
            return true;
    }
    return false;
}

function validateDate($date, $format = 'Y-m-d H:i:s'){
    $validDate = DateTime::createFromFormat($format, $date);
    return $validDate && $validDate->format($format) == $date;
}