<?php include_once "dbAcess.php" ?>

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
    <?php
    $errors = [];
    $sucess = [];
    $title = '';
    $description = '';
    $start_time = '';
    $end_time = '';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = $_POST["title"];
        $description = $_POST["description"];
        $start_time = $_POST["start_time"];
        $end_time = $_POST["end_time"];
        $sel_start_time = $start_time;
        $sel_end_time = $end_time;
        if (empty($title)) {
            array_push($errors, "Title cannot be empty");
        }
        if (empty($description)) {
            array_push($errors, "Description cannot be empty");
        }
        if (empty($start_time)) {
            array_push($errors, "Please select a start time");
        } else {
            $sel_start_time = date("Y-m-d H:i:s", strtotime($_POST["start_time"]));
        }
        if (empty($end_time)) {
            array_push($errors, "Please select an end time");
        } else {
            $sel_end_time = date("Y-m-d H:i:s", strtotime($_POST["end_time"]));
        }
        if (strtotime($_POST["start_time"]) >= strtotime($_POST["end_time"])) {
            array_push($errors, "Start time is greater or equal to end time");
        }
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
    <form action="createTask.php" method="post">
        <div class="mb-3">
            <label for="taskTitle" class="form-label">Task Title</label>
            <input type="text" class="form-control" id="taskTitle" name="title" value="<?php echo $title ?>">
        </div>
        <div class="mb-3">
            <label for="taskDesc" class="form-label">Task Description</label>
            <textarea type="text" class="form-control" id="taskDesc" name="description"><?php echo $description ?></textarea>
        </div>
        <div class="mb-3 form-time">
            <label class="form-time-label" for="startTime">Select a start time : </label>
            <input type="time" class="form-date-input" id="startTime" name="start_time" value="<?php echo $start_time ?>">
        </div>
        <div class="mb-3 form-time">
            <label class="form-time-label" for="endTime">Select an end time : </label>
            <input type="time" class="form-time-input" id="endTime" name="end_time" value="<?php echo $end_time ?>">
        </div>
        <button type="submit" class="btn btn-primary">Create Task</button>
    </form>
</body>

</html>