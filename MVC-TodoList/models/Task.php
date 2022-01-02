<?php

namespace app\models;

use app\Database;

class Task
{
    public ?string $id = null;
    public ?string $title = null;
    public ?string $description = null;
    public ?string $start_time = null;
    public ?string $end_time = null;

    public function load($data)
    {
        $this->id =  $data['id'] ?? null;
        $this->title = $data['Task_Title'];
        $this->description = $data['Task_Description'];
        $this->start_time = $data['Task_start_time'];
        $this->end_time = $data['Task_end_time'];
    }
    public function save()
    {
        $errors = [];
        if (empty($this->title)) {
            array_push($errors, "Title cannot be empty");
        }
        if (empty($this->description)) {
            array_push($errors, "Description cannot be empty");
        }
        if (empty($this->start_time)) {
            array_push($errors, "Please select a start time");
        } else {
            $this->start_time = date("Y-m-d H:i:s", strtotime($this->start_time));
        }
        if (empty($this->end_time)) {
            array_push($errors, "Please select an end time");
        } else {
            $this->end_time = date("Y-m-d H:i:s", strtotime($this->end_time));
        }
        if (!empty($this->start_time) && !empty($this->end_time) && strtotime($this->start_time) >= strtotime($this->end_time)) {
            array_push($errors, "Start time is greater or equal to end time");
        }
        $db = Database::getInstance();
        if (empty($errors)) {
            if ($this->id) {
                $db->updateTask($this);
            } else {
                $db->createTask($this);
            }
        }
        return $errors;
    }
}
