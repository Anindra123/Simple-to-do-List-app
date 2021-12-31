<?php
require_once __DIR__ . '../../vendor/autoload.php';

use app\Router;
use app\controllers\TaskController;

$router = new Router();

$router->get('/', [TaskController::class, 'index']);
$router->get('/tasks', [TaskController::class, 'index']);
$router->get('/tasks/createTask', [TaskController::class, 'create']);
$router->post('/tasks/createTask', [TaskController::class, 'create']);
$router->post('/tasks/deleteTask', [TaskController::class, 'delete']);
$router->get('/tasks/updateTask', [TaskController::class, 'update']);
$router->post('/tasks/updateTask', [TaskController::class, 'update']);

$router->resolve();
