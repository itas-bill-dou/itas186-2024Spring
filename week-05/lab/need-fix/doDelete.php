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

if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $id_post = htmlspecialchars($_GET["id"]);
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
        unset($normalizedTask);
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
