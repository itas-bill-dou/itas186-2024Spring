<?php
session_start();
$pdo = require_once 'database.php';

$message = '';

// 1. Grab the task id from URL and ensure the id is not empty
$taskId = isset($_GET['id']) ? $_GET['id'] : '';

if (empty($taskId)) {
    $_SESSION['message'] = 'Task ID is missing.';
    header('Location: index.php');
    exit;
} else {
    // 2. Locate the task by id and delete it from task-list.txt file
    // Prepare SQL delete statement
    $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = :id");

    // Bind parameter
    $stmt->bindParam(':id', $taskId, PDO::PARAM_INT);

    // Execute the statement
    $stmt->execute();

    $_SESSION['message'] = 'Delete Successfully';
    header('Location: index.php');
    exit;
}

echo $message;
