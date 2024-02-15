<?php

$message = '';
$taskContent = '';
$taskStatus = '';
$taskId = '';

/* 
task 2 (35' total):
1. Grab the task id from URL (3') - Completed
2. Locate the task based on the Id and parse out its content and status. (12') - Completed
3. Ensure the content and status are set and not empty (i.e. null, empty string are not allowed). (3') - Completed within validation
4. Ensure the status is valid (should either be "new" or "in progress") (3') - Completed within validation
 ,any other status should stop the rest form rendering (3') - Implemented with the exit command
 and display an error message: "Bad Task Status!" and provide a link to let user be back to index page. (4') - Completed
5. Populate current task content into content input (3') - Completed
6. Set the status selection to be current task status. (4') - Completed
*/

// Task 1: Grab the task id from URL
$taskId = isset($_GET['id']) ? $_GET['id'] : '';

if (!$taskId) {
    // Part of Task 4: Display error message and link
    echo "<p class='text-red-500'>No task ID provided.</p>";
    echo "<a href='index.php' class='text-blue-500'>Go back to task list</a>";
    exit; 
}

if (file_exists("./task-list.txt")) {
    $tasksString = file_get_contents('./task-list.txt');
    $rawTasks = explode(PHP_EOL, trim($tasksString));
    
    $found = false;
    foreach ($rawTasks as $task) {
        list($id, $content, $status) = explode('|', $task);
        if ($id === $taskId) {
            // Task 2: Locate the task based on the Id and parse out its content and status
            $taskContent = $content;
            $taskStatus = $status;
            $found = true;
            break; 
        }
    }

    if (!$found) {
        // If the task is not found, display an error message and link
        echo "<p class='text-red-500'>Task not found.</p>";
        echo "<a href='index.php' class='text-blue-500'>Go back to task list</a>";
        exit;
    }

    // Task 3 & 4: Validate content and status
    if (empty($taskContent) || empty($taskStatus) || !in_array($taskStatus, ['new', 'in progress'])) {
        // Part of Task 4: Display error message for invalid status or missing information
        echo "<p class='text-red-500'>Bad Task Status or missing information!</p>";
        echo "<a href='index.php' class='text-blue-500'>Go back to task list</a>";
        exit;
    }
} else {
    // File not found error handling
    echo "<p class='text-red-500'>The task file does not exist.</p>";
    echo "<a href='index.php' class='text-blue-500'>Go back to task list</a>";
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Task List - Editing Form</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
  <div class="max-w-[600px] mx-auto mt-10 bg-white shadow p-4 rounded">
    <div class="flex justify-between">
      <h1 class="text-xl font-bold">Editing a task</h1>
      <a href="index.php" class="text-blue-500">Back</a>
    </div>
    <!-- Task form starts here -->
    <form class="flex flex-col gap-y-4 my-4" action="doUpdate.php" method="POST">
      <!-- Task 5: Populate current task content into content input -->
      <input name="task" type="text" value="<?= htmlspecialchars($taskContent); ?>" class="border border-gray-400 px-3 py-2 flex-1 rounded" />
      <!-- Task 6: Set the status selection to be current task status -->
      <select name="status" class="py-2 px-3 border border-gray-400 rounded">
        <option value="new" <?= $taskStatus === 'new' ? 'selected' : ''; ?>>New</option>
        <option value="in progress" <?= $taskStatus === 'in progress' ? 'selected' : ''; ?>>In Progress</option>
      </select>
      <input type="hidden" name="id" value="<?= $taskId; ?>" />
      <input type="submit" value="Update" class="bg-green-500 text-white px-3 py-2 border rounded hover:bg-green-600 cursor-pointer" />
    </form>
  </div>
</body>
</html>
