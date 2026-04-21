<?php
$firstNames = ['Lucas', 'Ana', 'Bruno', 'Carla', 'Diego', 'Elena', 'Fabio', 'Gabi', 'Hugo', 'Iris'];
$lastNames = ['Heiler', 'Silva', 'Santos', 'Oliveira', 'Costa', 'Pereira', 'Rodrigues', 'Almeida', 'Lopes', 'Maia'];

$users = [];
for($i = 0; $i < 20; $i++){
    $firstName = $firstNames[array_rand($firstNames)];
    $lastName = $lastNames[array_rand($firstNames)];

    $users[] = [
        'full_name' => "{$firstName} {$lastName}",
        'email' => "{$firstName}{$lastName}@gmail.com",
        'password' => password_hash('password', PASSWORD_DEFAULT),
    ];
}

return $users;