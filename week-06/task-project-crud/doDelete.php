<?php

$message = '';

/**
 * task 4 (10' total):
 * 
 * 1. Grab the task id from URL and ensure the id is not empty. (2')
 * tip: think about how you get the id when updating a task.
 * 2. Locate the task by id and delete it from task-list.txt file. (6')
 * tip: You know how to find it by id in doUpdate page, same way. the difference is this one is to delete instead of updating. 
 * 3. Print a successful message and a link to let user back to index page. (2')
 */

 // 1. Grab the task id from URL and ensure the id is not empty
$taskId = isset($_GET['id']) ? $_GET['id'] : '';

if (empty($taskId)) {
    $message = 'Task ID is missing. <a href="index.php">Go back</a>';
} else {
    // 2. Locate the task by id and delete it from task-list.txt file
    if (file_exists("./task-list.txt")) {
        $tasksString = file_get_contents('./task-list.txt');
        $tasks = explode(PHP_EOL, trim($tasksString));
        $updatedTasks = [];

        foreach ($tasks as $task) {
            list($id, $content, $status) = explode('|', $task, 3);
            if ($id != $taskId) {
                $updatedTasks[] = $task; // Keep the task if ID does not match
            }
        }

        // Save the updated (with task removed) tasks back to the file
        file_put_contents('./task-list.txt', implode(PHP_EOL, $updatedTasks));

        // 3. Print a successful message and a link to let user back to index page
        $message = 'Task ID#' . htmlspecialchars($taskId) . ' has been successfully deleted. <a href="index.php">Go back</a>';
    } else {
        $message = 'Failed to open task list for updating. <a href="index.php">Go back</a>';
    }
}

echo $message;

?>