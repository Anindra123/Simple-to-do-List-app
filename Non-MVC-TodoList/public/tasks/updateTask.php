<?php
require_once "../../dbAcess.php";
include_once "../../getTask.php";
$title = "Update Task";
include_once "../../views/partials/header.php";

$id = $_GET["id"] ?? null;
$task = [];
if (!$id && $_SERVER["REQUEST_METHOD"] === "GET") {
    header("Location:index.php");
    exit;
} else {
    $task = getTaskByID($pdo, $id);
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];
    $task = getTaskByID($pdo, $id);
}
$errors = [];
$title = '';
$description = '';
$start_time = '';
$end_time = '';
if (count($task) !==  0) {
    $title = $task["Task_Title"];
    $description = $task["Task_Description"];
    $s_dateTime = strtotime($task["Task_start_time"]);
    $e_dateTime = strtotime($task["Task_end_time"]);
    $start_time = date('H:i', $s_dateTime);
    $end_time = date('H:i', $e_dateTime);
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require "task_validation.php";
    if (count($errors) === 0) {
        $update_statment = $pdo->prepare("update task_tbl 
                set task_title = :title,task_description = :description,
                task_start_time = :start_time,task_end_time = :end_time
                where id = :id
            ");
        $update_statment->bindValue(':title', $title);
        $update_statment->bindValue(':description', $description);
        $update_statment->bindValue(':start_time', $sel_start_time);
        $update_statment->bindValue(':end_time', $sel_end_time);
        $update_statment->bindValue(':id', $id);
        $update_statment->execute();
        header("Location:index.php");
        exit;
    }
}
?>

<body>

    <p>
        <a href='index.php' class="btn btn-secondary">Go Back</a>
    </p>
    <h3>Update task</h3>
    <?php if (count($errors) !== 0) : ?>
        <?php foreach ($errors as $error) : ?>
            <div class="alert alert-danger">
                <?php echo $error ?>
            </div>
        <?php endforeach ?>
    <?php endif ?>

    <?php require_once "../../views/tasks/form.php"; ?>

</body>

</html>