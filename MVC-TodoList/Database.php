<?php

namespace app;

use PDO;
use app\models\Task;

class Database
{
    private ?PDO $pdo;
    private static Database $db_instance;
    private function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;port=3306;dbname=todolist_db', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function getAllTask()
    {
        $statement = $this->pdo->prepare("select * from task_tbl");
        $statement->execute();
        $this->pdo = null;
        $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $tasks;
    }
    public function createTask(Task $task)
    {
        $insert_statement = $this->pdo->prepare("insert into task_tbl (task_title,task_description,task_start_time,
            task_end_time) values(:title,:description,:start_time,:end_time)
            ");
        $insert_statement->bindValue(':title', $task->title);
        $insert_statement->bindValue(':description', $task->description);
        $insert_statement->bindValue(':start_time', $task->start_time);
        $insert_statement->bindValue(':end_time', $task->end_time);
        $insert_statement->execute();
        $this->pdo = null;
    }
    public function deleteTask(int $id)
    {
        $delete_statment = $this->pdo->prepare("delete from task_tbl where id = :id");
        $delete_statment->bindValue(':id', $id);
        $delete_statment->execute();
        $this->pdo = null;
    }
    function getTaskByID($id)
    {
        $statement = $this->pdo->prepare("select * from task_tbl where id = :id");
        $statement->bindValue(':id', $id);
        $statement->execute();
        $this->pdo = null;
        $task = $statement->fetch(PDO::FETCH_ASSOC);
        return $task;
    }
    public function UpdateTask(Task $task)
    {
        $update_statment = $this->pdo->prepare("update task_tbl 
                set task_title = :title,task_description = :description,
                task_start_time = :start_time,task_end_time = :end_time
                where id = :id
            ");
        $update_statment->bindValue(':title', $task->title);
        $update_statment->bindValue(':description', $task->description);
        $update_statment->bindValue(':start_time', $task->start_time);
        $update_statment->bindValue(':end_time', $task->end_time);
        $update_statment->bindValue(':id', $task->id);
        $update_statment->execute();
        $this->pdo = null;
    }
    public static function getInstance()
    {
        if (!isset(self::$db_instance)) {
            self::$db_instance = new Database();
        }
        return self::$db_instance;
    }
}
