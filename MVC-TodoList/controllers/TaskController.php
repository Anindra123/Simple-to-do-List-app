<?php

namespace app\controllers;

use app\Router;
use app\models\Task;

class TaskController
{
    public static function index(Router $router)
    {
        $tasks = $router->db->getAllTask();

        $router->RenderView('/tasks/index', [
            'tasks' => $tasks
        ]);
    }
    public static function create(Router $router)
    {
        $errors = [];
        $sucess = false;
        $taskData = [
            'title' => '',
            'description' => '',
            'start_time' => '',
            'end_time' => ''
        ];
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $taskData['title'] = $_POST['title'];
            $taskData['description'] = $_POST['description'];
            $taskData['start_time'] = $_POST['start_time'];
            $taskData['end_time'] = $_POST['end_time'];
            $task = new Task();
            $task->load($taskData);
            $errors = $task->save();
            if (empty($errors)) {
                $sucess = true;
                $taskData['title'] = '';
                $taskData['description'] = '';
                $taskData['start_time'] = '';
                $taskData['end_time'] = '';
            }
        }

        $router->RenderView('/tasks/CreateTask', [
            'taskData' => $taskData,
            'errors' => $errors,
            'sucess' => $sucess
        ]);
    }
    public static function update()
    {
        echo "Update Task";
    }
    public static function delete()
    {
        echo "Delete Task";
    }
}
