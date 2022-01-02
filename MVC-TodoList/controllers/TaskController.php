<?php

namespace app\controllers;

use app\Database;
use app\Router;
use app\models\Task;
use DateTime;

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
        date_default_timezone_set('Asia/Dhaka');
        $errors = [];
        $sucess = [];
        $taskData = [
            'id' => '',
            'Task_Title' => '',
            'Task_Description' => '',
            'Task_start_time' => date("Y-m-d H:i:s"),
            'Task_end_time' => date("Y-m-d H:i:s")
        ];
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $taskData['Task_Title'] = $_POST['title'];
            $taskData['Task_Description'] = $_POST['description'];
            $taskData['Task_start_time'] = $_POST['start_time'];
            $taskData['Task_end_time'] = $_POST['end_time'];
            $task = new Task();
            $task->load($taskData);
            $errors = $task->save();
            if (empty($errors)) {
                $sucess = ["Task created sucessfully"];
                $taskData['Task_Title'] = '';
                $taskData['Task_Description'] = '';
                $taskData['Task_start_time'] = date("Y-m-d H:i:s");
                $taskData['Task_end_time'] = date("Y-m-d H:i:s");
            }
        }

        $router->RenderView('/tasks/CreateTask', [
            'taskData' => $taskData,
            'errors' => $errors,
            'sucess' => $sucess
        ]);
    }
    public static function update(Router $router)
    {
        $errors = [];
        $sucess = false;
        $id = $_GET["id"] ?? null;
        if (!$id) {
            header('Location: /tasks');
            exit;
        }
        $taskData = Database::getInstance()->getTaskByID($id);
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $taskData['id'] = $_POST['id'];
            $taskData['Task_Title'] = $_POST['title'];
            $taskData['Task_Description'] = $_POST['description'];
            $taskData['Task_start_time'] = $_POST['start_time'];
            $taskData['Task_end_time'] = $_POST['end_time'];
            $task = new Task();
            $task->load($taskData);
            $errors = $task->save();
            if (empty($errors)) {
                $sucess = ["Task updated sucessfully"];
            }
        }
        $router->RenderView('/tasks/UpdateTask', [
            'taskData' => $taskData,
            'errors' => $errors,
            'sucess' => $sucess
        ]);
    }
    public static function delete(Router $router)
    {
        $id =  $_POST["id"] ?? null;
        if (!$id) {
            header('Location: /tasks');
            exit;
        }
        $router->db->deleteTask($id);
        header('Location: /tasks');
    }
}
