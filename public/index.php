<?php
require dirname(__DIR__, 1) . "/vendor/autoload.php";
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(dirname(__DIR__, 1) . "/");
$dotenv->load();

init();
