<?php

require_once "../../dbAcess.php";

$id = $_POST["id"] ?? null;

if ($id === null) {
    header('Location:index.php');
    exit;
}

$delete_statment = $pdo->prepare("delete from task_tbl where id = :id");
$delete_statment->bindValue(':id', $id);
$delete_statment->execute();
header('Location:index.php');
