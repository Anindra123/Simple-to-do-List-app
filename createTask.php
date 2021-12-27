<?php include "dbAcess.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/styles.css">
    <title>Create New Task</title>
</head>

<body>
    <h3>Create new task</h3>
    <form action="createTask.php" method="post">
        <div class="mb-3">
            <label for="taskTitle" class="form-label">Task Title</label>
            <input type="text" class="form-control" id="taskTitle" name="title">
        </div>
        <div class="mb-3">
            <label for="taskDesc" class="form-label">Task Description</label>
            <textarea type="text" class="form-control" id="taskDesc" name="description"></textarea>
        </div>
        <div class="mb-3 form-time">
            <label class="form-time-label" for="startTime">Select a start time : </label>
            <input type="time" class="form-date-input" id="startTime" name="start_time">
        </div>
        <div class="mb-3 form-time">
            <label class="form-time-label" for="endTime">Select an end time : </label>
            <input type="time" class="form-time-input" id="endTime" name="end_time">
        </div>
        <button type="submit" class="btn btn-primary">Create Task</button>
    </form>
    <?php
    $title = $_POST["title"];
    $description = $_POST["description"];
    $start_time = date("Y-m-d H:i:s", strtotime($_POST["start_time"]));
    $end_time = date("Y-m-d H:i:s", strtotime($_POST["end_time"]));
    echo '<pre>';
    echo $start_time;
    echo $end_time;
    echo '</pre>';
    // $pdo->
    ?>
</body>

</html>