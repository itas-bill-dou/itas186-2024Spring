<?php

/* 
Lab Objective
1. Through this lab to learn how to locate a task and update it.
2. Learn how to delete a task.

Grading
Total: 90'
*/

// Create a flag variable to check if tasks are empty. Assuming it is empty for now.
$isTasksEmpty = true;

$pdo = require_once 'database.php';

// Create a flag variable to check if tasks are empty. Assuming it is empty for now.
$isTasksEmpty = true;

// Prepare a SELECT statement
$sql = "SELECT * FROM tasks";
$stmt = $pdo->prepare($sql);

// Execute the statement
$stmt->execute();

// Fetch all rows from the executed statement
$normalizedTasks = $stmt->fetchAll();

if (count($normalizedTasks) > 0) {
    $isTasksEmpty = false;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Task List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="max-w-[600px] mx-auto mt-10 bg-white shadow p-4 rounded">
        <div class="flex justify-between">
            <h1 class="text-xl font-bold">PHP Task List</h1>
            <a href="createForm.html" class="text-blue-500">Create</a>
        </div>

        <div class="my-4">
            <?php
            /* 
            task 1 (15' total):
            1. Add 2 buttons/anchors named "Edit" and "Delete" on the right side of "not done" tasks. (3')
            tip: If you want to use an icon/svg instead of text, go to https://lucide.dev/icons/ or https://heroicons.com/
            2. Align the button to the right side. (2')
            3. Once clicking any edit button, the user should be redirected to editForm.php page along with the task information (content and status). (10')
            tip: 
            4. When deleting a task, submit the task id to doDelete.php, like http://php82.local:9000/doDelete.php?id=xxxxxx
            For deleting handling, go to doDelete.php to see coding tasks.
            Leverage each task id; Use URL query parameters - https://www.semrush.com/blog/url-parameters/#what-are-url-parameters to pass the ID for editing form.
            
            Find next coding task (task 2) in editForm.php
            */

            //1. Add 2 buttons/anchors named "Edit" and "Delete" on the right side of "not done" tasks. 
            if ($isTasksEmpty) {
                echo "The task file may not exist, or no tasks were found.";
            } else {
                $statusColors = [
                    'new' => 'green-500',
                    'in progress' => 'blue-500',
                    'done' => 'gray-300'
                ];

                foreach ($statusColors as $status => $color) {
                    echo '<fieldset class="border border-' . $color . ' p-4 rounded text-' . $color . '">';
                    echo '<legend class="font-bold">' . ucfirst($status) . '</legend>';
                    echo '<ul class="list-disc list-outside mx-4">';

                    foreach ($normalizedTasks as $task) {
                        $normalizedTaskStatus = strtolower(trim($task['status']));
                        $normalizedStatus = strtolower($status);

                        if ($normalizedTaskStatus === $normalizedStatus) {
                            echo '<li class="my-2 flex justify-between items-center text-' . $color . '">';
                            echo htmlspecialchars($task['description']);

                            if (trim(strtolower($task['status'])) !== 'done') {
                                // 2. Align the button to the right side.
                                echo '<div class="flex items-center">';
                                // 3. Once clicking any edit button, the user should be redirected to editForm.php page along with the task information (content and status).
                                $editUrl = "editForm.php?id={$task['id']}";
                                $deleteUrl = "doDelete.php?id={$task['id']}";
                                
                                echo '<a href="' . $editUrl . '" class="mr-2">' .
                                     '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>' .
                                     '</a>';
                                //4. When deleting a task, submit the task id to doDelete.php, like http://php82.local:9000/doDelete.php?id=xxxxxx
                                echo '<a href="' . $deleteUrl . '">' .
                                     '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>' .
                                     '</a>';
                                echo '</div>'; 
                            }

                            echo '</li>';
                        }
                    }

                    echo '</ul>';
                    echo '</fieldset>';
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
