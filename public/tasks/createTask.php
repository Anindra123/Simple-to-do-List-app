<?php require_once "../../dbAcess.php";
$title = "Create Task";
include_once "../../views/partials/header.php";


$errors = [];
$sucess = [];
$title = '';
$description = '';
$start_time = '';
$end_time = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "task_validation.php";
    if (count($errors) === 0) {
        $insert_statement = $pdo->prepare("insert into task_tbl (task_title,task_description,task_start_time,
            task_end_time) values(:title,:description,:start_time,:end_time)
            ");
        $insert_statement->bindValue(':title', $title);
        $insert_statement->bindValue(':description', $description);
        $insert_statement->bindValue(':start_time', $sel_start_time);
        $insert_statement->bindValue(':end_time', $sel_end_time);
        $insert_statement->execute();
        $pdo = null;
        array_push($sucess, "Task added sucessfully");
        $title = '';
        $description = '';
        $end_time = '';
        $start_time = '';
    }
}

?>


<body>
    <?php


    ?>
    <p>
        <a href='index.php' class="btn btn-secondary">Go Back</a>
    </p>
    <h3>Create new task</h3>
    <?php if (count($errors) !== 0) : ?>
        <?php foreach ($errors as $error) : ?>
            <div class="alert alert-danger">
                <?php echo $error ?>
            </div>
        <?php endforeach ?>
    <?php endif ?>
    <?php if (count($sucess) !== 0) : ?>
        <div class="alert alert-success">
            Task created sucessfully
        </div>
    <?php endif ?>
    <?php require_once "../../views/tasks/form.php"; ?>
</body>

</html>