<?php 

$descriptions = ['Ir pra academia', 'Ir nadar', 'Comprar um carro', 'Ficar no shape', 'Estudar PHP', 'Estudar JavaScript', 'Estudar C', 'Estudar Java', 'Ficar bonito'];
$dates = [new DateTime('2026-04-10'), new DateTime('2026-04-09'), new DateTime('2026-03-24'), new DateTime('2026-02-21'), new DateTime('2026-02-04'), new DateTime('2026-01-29')];

$tasks = [];

for($i=0; $i<20; $i++){
    $tasks[] = 
    [
        'description' => $descriptions[array_rand($descriptions)],
        'date' => $dates[array_rand($dates)]->format('Y-m-d'),
        'is_done' => 'pending',
        'user_id' => rand(1, 20)
    ];
}

return $tasks;