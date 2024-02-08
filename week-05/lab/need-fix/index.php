<?php

/* 
Lab Objective
1. Through this lab to learn how to locate a task and update it.
2. Learn how to delete a task.

Grading
Total: 90'
*/

// Create a flag variable to check if tasks is empty. Assuming it is empty for now.
$isTasksEmpty = true;

if (file_exists("./task-list.txt")) {
  $tasks_string = file_get_contents('./task-list.txt');
  $raw_tasks = explode(PHP_EOL, trim($tasks_string));

  $normalizedTasks = [];

  // Only loop non-empty raw tasks
  if (!empty($raw_tasks)) {
    // Mark it to false now that raw tasks are not empty
    $isTasksEmpty = false;

    // Normalize all tasks
    foreach ($raw_tasks as $task) {
      list($id, $content, $status) = explode('|', $task, 3);
      $normalizedTasks[] = array(
        "id" => $id,
        "content" => $content,
        "status" => $status
      );
    }
  }
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
      1. Add 2 buttons/anchors named "Edit" and "Delete" on right side of "not done" tasks. (3')
      tip: If you want to use icon/svg instead of text, go to https://lucide.dev/icons/ or https://heroicons.com/
      2. Align the button to right side. (2')
      3. Once clicking any edit button, the user should be redirected to editForm.php page along with the task information (content and status). (10')
      tip: 
      4. When deleting a task, submit the task id to doDelete.php, like http://php82.local:9000/doDelete.php?id=xxxxxx
      For deleting handling, go to doDelete.php to see coding tasks.
      Leverage each task id; Use URL query parameters - https://www.semrush.com/blog/url-parameters/#what-are-url-parameters to pass the ID for editing form.
      
      Find next coding task (task 2) in editForm.php
      */
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
            if ($task['status'] == $status) {
              $liClass = $color;
              $editClass = '';
              if ($status === 'done') {
                $liClass .= ' line-through';
                $editClass = ' hidden';
              }
              echo '<li data-id=' . $task['id'] . ' class="my-2 ' . $liClass . '">' . htmlspecialchars($task['content']) . ' 
              <a id="del" href="doDelete.php?id=' . $task['id'] . '" class="float-right"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x-square"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><path d="m15 9-6 6"/><path d="m9 9 6 6"/></svg></a>
              <a id="edit" href="editForm.php?id=' . $task['id'] /*. '&content=' . $task['content'] . '&status=' . $task['status']*/ . '" class="float-right' . $editClass . '"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4Z"/></svg></a>
              </li>';
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