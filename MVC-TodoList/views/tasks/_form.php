<?php if (!empty($errors)) : ?>
    <?php foreach ($errors as $error) : ?>
        <div class="alert alert-danger">
            <?php echo $error ?>
        </div>
    <?php endforeach ?>
<?php endif ?>
<?php if (!empty($sucess)) : ?>
    <div class="alert alert-success">
        <?php echo $sucess[0] ?>
    </div>
<?php endif ?>

<form action="" method="post">
    <div class="mb-3">
        <label class="form-label">Task Title</label>
        <input type="text" class="form-control" name="title" value="<?php echo $taskData['Task_Title']; ?>">
    </div>
    <div class="mb-3">
        <label for="taskDesc" class="form-label">Task Description</label>
        <textarea type="text" class="form-control" id="taskDesc" name="description"><?php echo $taskData['Task_Description']; ?></textarea>
    </div>
    <div class="mb-3 form-time">
        <label class="form-time-label" for="startTime">Select a start time : </label>
        <input type="time" class="form-time-input" id="startTime" name="start_time" value="<?php echo  date('H:i', strtotime($taskData['Task_start_time'])); ?>">
    </div>
    <div class="mb-3 form-time">
        <label class="form-time-label" for="endTime">Select an end time : </label>
        <input type="time" class="form-time-input" id="endTime" name="end_time" value="<?php echo date('H:i', strtotime($taskData['Task_end_time'])); ?>">
    </div>
    <form action="" style="display:inline-block" method="post">
        <input type="hidden" name="id" value="<?php echo $taskData["id"];
                                                ?>">
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>


</form>