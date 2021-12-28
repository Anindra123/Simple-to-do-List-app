<?php
include("dbAcess.php");
include("getTask.php");
?>


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
    $id = $_GET["id"] ?? null;

    if ($id === null) {
        header("Location:index.php");
    }
    $task = getTaskByID($pdo, $id);
    $s_dateTime = strtotime($task["Task_start_time"]);
    $e_dateTime = strtotime($task["Task_end_time"]);
    $s_time = strftime('%r', $s_dateTime);
    $e_time = strftime('%r', $e_dateTime);
    // echo $task["Task_Title"];
    // exit;
    ?>

    <?php
    $errors = [];
    $title = $task["Task_Title"];
    $description = $task["Task_Description"];
    $start_time = $s_time;
    $end_time = $e_time;
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

            header("Location:index.php");
        }
    }


    ?>
    <h3>Update task</h3>
    <?php if (count($errors) !== 0) : ?>
        <?php foreach ($errors as $error) : ?>
            <div class="alert alert-danger">
                <?php echo $error ?>
            </div>
        <?php endforeach ?>
    <?php endif ?>
    <form action="createTask.php" method="post">
        <div class="mb-3">
            <label class="form-label">Task Title</label>
            <input type="text" class="form-control" name="title" value=<?php print $title; ?>>
        </div>
        <div class="mb-3">
            <label for="taskDesc" class="form-label">Task Description</label>
            <textarea type="text" class="form-control" id="taskDesc" name="description"><?php echo $description; ?></textarea>
        </div>
        <div class="mb-3 form-time">
            <label class="form-time-label" for="startTime">Select a start time : </label>
            <input type="time" class="form-time-input" id="startTime" name="start_time" value=<?php echo $start_time; ?>>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Default</span>
            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?php echo $title ?>">
        </div>
        <div class="mb-3 form-time">
            <label class="form-time-label" for="endTime">Select an end time : </label>
            <input type="time" class="form-time-input" id="endTime" name="end_time" value=<?php echo $end_time; ?>>
        </div>
        <button type="submit" class="btn btn-primary">Update Task</button>
    </form>
</body>

</html>