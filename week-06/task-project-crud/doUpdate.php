<?php

$messages = '';
$file = './task-list.txt';

/* 
task 3 (40' total):
1. Validate a task is is submitted because you will use this id to locate the task to update. (3')
2. Similar as doCreate.php, validate the submitted task content and status, ensure content is required and not empty; the status must be valid (one of 3 statuses) (5')
3. If above conditions are not fulfilled, display an error message "Bad Task Submitted" and provide a link to let user click to go back to the editing form page. (4')
4. If all is good, locate the task based on the id in step 1 and update its content and status. Keep Id as is (25')
tip: Loop each task and find the matched one then update it.
5. Once updated successfully, display a successful message "The task #xxxxxxx is successfully updated!", that "xxxxxx" is the task Id and provide a link to go to index page. (3')

Check the task you just updated and see if the content or status is updated.

Find next task (task 4) in doDelete.php
*/


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

// Read the current list of tasks
if (file_exists($file)) {
    $tasks = file_get_contents($file);
    $tasksArray = explode(PHP_EOL, trim($tasks));
    $updatedTasks = [];

    foreach ($tasksArray as $task) {
        list($id, $content, $status) = explode('|', $task);

        // 4. Locate the task by id and update its content and status
        if ($id === $taskId) {
            $content = $taskContent;
            $status = $taskStatus;
        }
        
        $updatedTasks[] = implode('|', [$id, $content, $status]);
    }

    // Write the updated tasks back to the file
    file_put_contents($file, implode(PHP_EOL, $updatedTasks));

    // 5. Display a successful message
    $messages = "The task #$taskId is successfully updated!";
    echo "<p>$messages</p>";
    echo "<a href='index.php'>Go to index page</a>";
} else {
    echo "<p>Task file not found.</p>";
}

?>
