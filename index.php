<?php include "dbAcess.php" ?>
<?php include "getTask.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/styles.css">
    <title>To-Do List</title>
</head>

<body>
    <?php
    $tasks = getAllTask($pdo);
    ?>
    <h3>TO-DO List Application</h3>
    <br>
    <p>
        <a href="createTask.php" class="btn btn-success">Create New Task</a>
    </p>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Task Title</th>
                <th scope="col">Task Description</th>
                <th scope="col">Start Time</th>
                <th scope="col">End Time</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tasks as $i => $task) : ?>
                <tr>
                    <th scope="row"><?php echo $i + 1 ?></th>
                    <td><?php echo $task["Task_Title"] ?></td>
                    <td><?php echo $task["Task_Description"] ?></td>
                    <td><?php echo date('g:i A', strtotime($task["Task_start_time"])); ?></td>
                    <td><?php echo date('g:i A', strtotime($task["Task_end_time"])); ?></td>
                    <td>
                        <a href="updateTask.php?id=<?php echo $task["id"]; ?>" class="btn btn-outline-primary btn-sm">Edit</a>
                        <form action="deleteTask.php" style="display:inline-block" method="post">
                            <input type="hidden" name="id" value=<?php echo $task["id"]; ?>>
                            <button type="submit" class="btn btn-outline-success btn-sm">Complete</button>
                        </form>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php

    ?>

</body>

</html>