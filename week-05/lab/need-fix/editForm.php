<?php

$message = '';

/* 
task 2 (35' total):
1. Grab the task id from URL (3')
tip: $_GET or $_REQUEST, what is their difference? Read http://www.shodor.org/~kevink/phpTutorial/nileshc_getreqpost.php
2. Locate the task based on the Id and parse out its content and status. (12')
3. Ensure the content and status are set and not empty (i.e. null, empty string are not allowed). (3')
4. Ensure the status is valid (should either be "new" or "in progress") (3')
 ,any other status should stop the rest form rendering (3')
 and display an error message: "Bad Task Status!" and provide a link to let user be back to index page. (4')
5. Populate current task content into content input (3')
6. Set the status selection to be current task status. (4')

Now you can edit current task.

Find next task (task 3) in doUpdate.php
*/

$id_url = $_GET['id'];

// Copied from create form.html
$validStatuses = ['new', 'in progress'];
$isTasksEmpty = true;

if (file_exists("./task-list.txt")) {
  $tasks_string = file_get_contents('./task-list.txt');
  $raw_tasks = explode(PHP_EOL, trim($tasks_string));
  $task = array('status' => "bad");

  // Only loop non-empty raw tasks
  if (!empty($raw_tasks)) {
    // Mark it to false now that raw tasks are not empty
    $isTasksEmpty = false;

    // Normalize all tasks
    foreach ($raw_tasks as $raw_task) {
      list($id, $content, $status) = explode('|', $raw_task, 3);
      if ($id_url == $id) {
        $task = array(
          "id" => $id,
          "content" => $content,
          "status" => $status
        );
      }
    }
  }
}

$invalid_task = $isTasksEmpty;
if (!in_array($task['status'], $validStatuses)) {
  $invalid_task = true;
} else if (empty($task['content'])) {
  $invalid_task = true;
}

$new_selected = "";
$in_progress_selected = "";
switch ($task['status']) {
  case 'new':
    $new_selected = 'selected';
    break;

  case 'in progress':
    $in_progress_selected = 'selected';
    break;
  default:
    break;
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
    <?php if ($invalid_task) { ?>
      <p>The task file may not exist, bad task status, the task is empty, or no tasks were found.</p>
    <?php } else { ?>
      <form class="flex gap-x-1 my-4" action="doUpdate.php" method="POST">
        <input name="task" type="text" class="border border-gray-400 px-3 py-2 flex-1 rounded" placeholder="Learn PHP ..." autofocus value="<?php echo $task['content']; ?>" />
        <select class="py-2 px-3 border border-gray-400 rounded" name="status">
          <option value="new" <?php echo $new_selected; ?>>New</option>
          <option value="in progress" <?php echo $in_progress_selected; ?>>In Progress</option>
          <option value="done">Done</option>
        </select>
        <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
        <input type="submit" value="Update" class="bg-green-500 text-white px-2 border rounded hover:bg-transparent hover:text-green-500 hover:border-green-500" />
      </form>
    <?php } ?>
  </div>
</body>

</html>