<?php

$validStatuses = ['new', 'in progress', 'done'];

/*
Receive form submission only as POST is not empty
*/
if (!empty($_POST)) {
  $task = trim($_POST['task'] ?? '');
  $status = trim($_POST['status'] ?? '');


  // Submission validation: 
  // 1.The task content is required and must not be empty.
  // 2.Status is required and must be one of new, in progress or done.
  // 3.Redirect the user back to the task creation page if neither condition is met. 
  if (empty($task) || empty($status) || !in_array($status, $validStatuses)) {
    header('Location: createForm.html');
    exit;
  }

  // store the task and status into a variable $newTask which is an associate array
  $newTask = [
    "id" => uniqid(),
    "content" => $task,
    "status" => $status
  ];

  // Find next available key value

  // append it as a single line at the end of task-list.txt
  $taskLine = implode("|", $newTask);
  if (!file_put_contents('task-list.txt', $taskLine, FILE_APPEND) != false) {
    echo "Something wrong.";
    exit;
  } else {
    header('Location: index.php');
    exit;
  }
} else {
  header('Location: createForm.html');
  exit;
}
