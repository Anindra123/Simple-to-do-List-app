<?php

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
if (!empty($start_time) && !empty($end_time) && strtotime($_POST["start_time"]) >= strtotime($_POST["end_time"])) {
    array_push($errors, "Start time is greater or equal to end time");
}
