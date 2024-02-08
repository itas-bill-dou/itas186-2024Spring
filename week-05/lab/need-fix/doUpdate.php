<?php

// create a var to store any messages
$messages = '';

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

$validStatuses = ['new', 'in progress', 'done'];

if (isset($_POST["task"]) && !empty($_POST["task"])) {
    $task = htmlspecialchars($_POST["task"]);
} else {
    $validation = false;
    $message .= "Task Missing<br>";
}

if (isset($_POST["status"]) && !empty($_POST["status"])) {
    $status = htmlspecialchars($_POST["status"]);
} else {
    $validation = false;
    $message .= "Status Missing<br>";
}

if (isset($_POST["id"]) && !empty($_POST["id"])) {
    $id_post = htmlspecialchars($_POST["id"]);
} else {
    $validation = false;
    $message .= "ID Missing<br>";
}

$normalizedTasks = [];
if (file_exists("./task-list.txt")) {
    $tasks_string = file_get_contents('./task-list.txt');
    $raw_tasks = explode(PHP_EOL, trim($tasks_string));

    // Only loop non-empty raw tasks
    if (!empty($raw_tasks)) {

        // Normalize all tasks
        foreach ($raw_tasks as $raw_task) {
            list($id, $content, $status) = explode('|', $raw_task, 3);
            $normalizedTasks[] = array(
                "id" => $id,
                "content" => $content,
                "status" => $status
            );
        }
    } else {
        $validation = false;
        $message .= "Empty Task List, Can't Update";
    }
}

$updated_raw_tasks = [];
foreach ($normalizedTasks as $normalizedTask) {
    if ($normalizedTask['id'] == $id_post) {
        $normalizedTask['content'] = $task;
        $normalizedTask['status'] = $status;
    }
    $updated_raw_tasks[] = implode('|', $normalizedTask);
}

if (!file_put_contents('task-list.txt', PHP_EOL . implode("\n", $updated_raw_tasks)) != false) {
    $message .= "File Error";
    exit;
} else {
    header('Location: index.php');
    exit;
}
