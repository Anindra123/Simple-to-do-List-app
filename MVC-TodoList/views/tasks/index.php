<h1>To-do List App</h1>

<?php
// echo '<pre>';
// var_dump($tasks);
// echo '</pre>';
?>

<br>
<p>
    <a href="/tasks/createTask" class="btn btn-success">Create New Task</a>
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
                    <a href="/tasks/updateTask?id=<?php echo $task["id"]; ?>" class="btn btn-outline-primary btn-sm">Edit</a>
                    <form action="/tasks/deleteTask" style="display:inline-block" method="post">
                        <input type="hidden" name="id" value="<?php echo $task["id"]; ?>">
                        <button type="submit" class="btn btn-outline-success btn-sm">Complete</button>
                    </form>
                </td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>