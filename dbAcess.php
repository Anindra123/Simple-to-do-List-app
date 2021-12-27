<?php

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=todolist_db', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$statement = $pdo->prepare("select * from task_tbl");
$statement->execute();
$tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
