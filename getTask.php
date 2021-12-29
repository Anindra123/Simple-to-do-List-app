<?php
function getAllTask($pdo)
{
    $statement = $pdo->prepare("select * from task_tbl");
    $statement->execute();
    $pdo = null;
    $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $tasks;
}

function getTaskByID($pdo, $id)
{
    $statement = $pdo->prepare("select * from task_tbl where id = :id");
    $statement->bindValue(':id', $id);
    $statement->execute();
    $pdo = null;
    $task = $statement->fetch(PDO::FETCH_ASSOC);
    if (!$task) {
        return [];
    } else {
        return $task;
    }
}
