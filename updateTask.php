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
    <title>Update Task</title>
</head>

<body>
    <?php
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
    ?>

    <?php
    $u_errors = [];
    $title = '';
    $description = '';
    $start_time = '';
    $end_time = '';
    if (count($task) !==  0) {
        $title = $task["Task_Title"];
        $description = $task["Task_Description"];
        $s_dateTime = strtotime($task["Task_start_time"]);
        $e_dateTime = strtotime($task["Task_end_time"]);
        $s_time = strftime('%r', $s_dateTime);
        $e_time = strftime('%r', $e_dateTime);
        $start_time = $s_time;
        $end_time = $e_time;
    }
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $title = $_POST["u_title"];
        $description = $_POST["u_description"];
        $start_time = $_POST["u_start_time"];
        $end_time = $_POST["u_end_time"];
        $sel_start_time = $start_time;
        $sel_end_time = $end_time;
        if (empty($title)) {
            array_push($u_errors, "Title cannot be empty");
        }
        if (empty($description)) {
            array_push($u_errors, "Description cannot be empty");
        }
        if (empty($start_time)) {
            array_push($u_errors, "Please select a start time");
        } else {
            $sel_start_time = date("Y-m-d H:i:s", strtotime($_POST["u_start_time"]));
        }
        if (empty($end_time)) {
            array_push($u_errors, "Please select an end time");
        } else {
            $sel_end_time = date("Y-m-d H:i:s", strtotime($_POST["u_end_time"]));
        }
        if (strtotime($_POST["u_start_time"]) >= strtotime($_POST["u_end_time"])) {
            array_push($u_errors, "Start time is greater or equal to end time");
        }
        if (count($u_errors) === 0) {
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
    <p>
        <a href='index.php' class="btn btn-secondary">Go Back</a>
    </p>
    <h3>Update task</h3>
    <?php if (count($u_errors) !== 0) : ?>
        <?php foreach ($u_errors as $error) : ?>
            <div class="alert alert-danger">
                <?php echo $error ?>
            </div>
        <?php endforeach ?>
    <?php endif ?>

    <form action="updateTask.php" method="post">
        <div class="mb-3">
            <label class="form-label">Task Title</label>
            <input type="text" class="form-control" name="u_title" value="<?php print $title; ?>">
        </div>
        <div class="mb-3">
            <label for="taskDesc" class="form-label">Task Description</label>
            <textarea type="text" class="form-control" id="taskDesc" name="u_description"><?php echo $description; ?></textarea>
        </div>
        <div class="mb-3 form-time">
            <label class="form-time-label" for="startTime">Select a start time : </label>
            <input type="time" class="form-time-input" id="startTime" name="u_start_time" value=<?php echo $start_time; ?>>
        </div>
        <div class="mb-3 form-time">
            <label class="form-time-label" for="endTime">Select an end time : </label>
            <input type="time" class="form-time-input" id="endTime" name="u_end_time" value=<?php echo $end_time; ?>>
        </div>
        <form action="updateTask.php" style="display:inline-block" method="post">
            <input type="hidden" name="id" value="<?php echo $task["id"]; ?>">
            <button type="submit" class="btn btn-primary">Update Task</button>
        </form>

    </form>
</body>

</html>