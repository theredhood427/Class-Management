<?php

use Dotenv\Dotenv as Env;

$env = Env::createImmutable(DIR . '/../'); // move up
$env->load();

$host = $_ENV['DB_HOST'];
$database = $_ENV['DB_DATABASE'];
$user = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];