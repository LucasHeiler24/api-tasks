<?php 

return 
[
    'get' => [
        '/tasks' => 'Tasks@all:auth',  
        '/tasks/[0-9]+' => 'Tasks@unique:auth',  
    ],
    'post' => 
    [
        '/signup' => 'User@signup',
        '/signin' => 'User@signin',
        '/tasks' => 'Tasks@create:auth'
    ],
    'put' => 
    [
        '/user/[0-9]+' => 'User@update:auth',
        '/tasks/[0-9]+' => 'Tasks@update:auth',
    ],
    'delete' => 
    [
        '/user/[0-9]+' => 'User@delete:auth',
        '/tasks/[0-9]+' => 'Tasks@delete:auth'
    ]
];