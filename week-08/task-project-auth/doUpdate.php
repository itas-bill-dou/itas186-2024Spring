<?php
$pdo = require_once 'database.php';

$messages = '';


// 1. Validate a task id is submitted
$taskId = isset($_POST['id']) ? $_POST['id'] : null;
$taskContent = isset($_POST['task']) ? trim($_POST['task']) : '';
$taskStatus = isset($_POST['status']) ? $_POST['status'] : '';

// 2. Validate the submitted task content and status
if (empty($taskId) || empty($taskContent) || !in_array($taskStatus, ['new', 'in progress', 'done'])) {
    // 3. Display an error message if conditions are not fulfilled
    $messages = 'Bad Task Submitted';
    echo "<p>$messages</p>";
    echo "<a href='editForm.php?id=$taskId'>Go back to the editing form</a>";
    exit;
}


// Prepare SQL update statement
$stmt = $pdo->prepare("UPDATE tasks SET description = :description, status = :status WHERE id = :id");

// Bind parameters
$stmt->bindParam(':description', $taskContent);
$stmt->bindParam(':status', $taskStatus);
$stmt->bindParam(':id', $taskId, PDO::PARAM_INT);

$stmt->execute();

if ($stmt->rowCount() > 0) {
    $messages = "The task #$taskId is successfully updated!";
    echo "<p>$messages</p>";
    echo "<a href='index.php'>Go to index page</a>";
} else {
    echo "No task was updated. Please check if the task ID exists.";
}
