<?php
$pdo = require_once 'database.php';

$message = '';

// 1. Grab the task id from URL and ensure the id is not empty
$taskId = isset($_GET['id']) ? $_GET['id'] : '';

if (empty($taskId)) {
    $message = 'Task ID is missing. <a href="index.php">Go back</a>';
} else {
    // 2. Locate the task by id and delete it from task-list.txt file
    // Prepare SQL delete statement
    $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = :id");

    // Bind parameter
    $stmt->bindParam(':id', $taskId, PDO::PARAM_INT);

    // Execute the statement
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // 3. Print a successful message and a link to let user back to index page
        $message = 'Task ID#' . htmlspecialchars($taskId) . ' has been successfully deleted. <a href="index.php">Go back</a>';
    } else {
        $message = 'Failed to open task list for updating. <a href="index.php">Go back</a>';
    }
}

echo $message;
