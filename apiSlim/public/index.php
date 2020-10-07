<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

require_once __DIR__ . '/../vendor/autoload.php';

// # include DB connection file
include __DIR__ . '/../NotORM.php';

$pdo    = new PDO("mysql:host=localhost;dbname=riseup_api", "root", "");
$db     = new NotORM($pdo);

//To Debug
$config = [
    'settings' => [
        'displayErrorDetails' => true 
    ],
];

$app = new \Slim\App($config);

// # include Arts route
require_once __DIR__ . '/../routes/users.php';


$app->run();