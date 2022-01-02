<form action="" method="post">
    <div class="mb-3">
        <label class="form-label">Task Title</label>
        <input type="text" class="form-control" name="title" value="<?php print $title; ?>">
    </div>
    <div class="mb-3">
        <label for="taskDesc" class="form-label">Task Description</label>
        <textarea type="text" class="form-control" id="taskDesc" name="description"><?php echo $description; ?></textarea>
    </div>
    <div class="mb-3 form-time">
        <label class="form-time-label" for="startTime">Select a start time : </label>
        <input type="time" class="form-time-input" id="startTime" name="start_time" value="<?php echo $start_time; ?>">
    </div>
    <div class="mb-3 form-time">
        <label class="form-time-label" for="endTime">Select an end time : </label>
        <input type="time" class="form-time-input" id="endTime" name="end_time" value="<?php echo $end_time; ?>">
    </div>
    <form action="" style="display:inline-block" method="post">
        <input type="hidden" name="id" value="<?php echo $task["id"]; ?>">
        <button type="submit" class="btn btn-primary">Update Task</button>
    </form>
</form>