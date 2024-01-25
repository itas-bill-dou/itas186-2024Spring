<?php

/* 
task 1 (25' total): 
1.Fetch all tasks (content and status) from todo-list.txt and store the results into a variable ($tasks_string) which should be String type. (5')
2.Convert string to an array $raw_tasks, each line will be an element. (10')

for example:

  array(
    Invent a teleportation device.|new,
    Teach cats to speak fluent English.|new,
    Find the lost city of Atlantis.|done,
    Write a novel in an alien language.|in progress,
    Create a time machine and attend a dinosaur party.|done
  )
3. Convert step 2 array to following format and assign it to $normalizedTasks (10'):
  array(
    array(
      "content" => "Invent a teleportation device.",
      "status" => "new"
    ),
    array(
      "content" => "Teach cats to speak fluent English.",
      "status" => "new"
    ),
    ...,
    ...
  )
tips: 
fopen or file_get_contents to get contents.
use explode to convert a string to array.
*/

$normalizedTasks = [];

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
          task 2 (35' total): 
          Loop tasks and check each's status and place it into corresponding fieldset by status
          1. The new task color is with text-green-500. (10')
          2. The in progress task color is with text-blue-500. (10')
          3. The done task color is with text-gray-300 and line-through effect. (10')

          When reading task-todo file and its content is empty, print a message "No Task Found". (5')
          */
      ?>
      <!-- 
        <fieldset class="border border-green-500 p-4 rounded text-green-500">
        <legend class="font-bold">New</legend>
          <ul class="list-disc list-outside mx-4">
            <li class="my-2">Invent a teleportation device.</li>
            <li class="my-2">Teach cats to speak fluent English.</li>
          </ul>
        </fieldset>

        <fieldset class="border border-blue-500 p-4 rounded text-blue-500">
          <legend class="font-bold">In Progress</legend>
          <ul class="list-disc list-outside mx-4">
            <li class="my-2">Write a novel in an alien language.</li>
          </ul>
        </fieldset>

        <fieldset class="border border-gray-300 p-4 rounded text-gray-300">
          <legend class="font-bold">Done</legend>
          <ul class="list-disc list-outside mx-4">
            <li class="my-2 line-through">Find the lost city of Atlantis.</li>
            <li class="my-2 line-through">
              Create a time machine and attend a dinosaur party.
            </li>
          </ul>
        </fieldset>
        -->
      <div>
        <h4>This page demo (remove me when you start the lab)</h4>
        <img src="./task-index.png" alt="">
      </div>
    </div>
  </div>
</body>

</html>