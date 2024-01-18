<?php

// 70'

// Finish the form input name and buttons in eventform.php 25'

// Determine if displaying card; One true to display card
$validation = true;

// Error message
$msg = "";

// Title input
if (isset($_POST["title"]) && !empty($_POST["title"])) {
  $title = htmlspecialchars($_POST["title"]);
} else {
  $validation = false;
}

// todo: Features input 5‘

// todo: Start input 5’

// todo: End input 5‘ 

// todo: Description 5’

// todo: Check if the end date is greater than start date 5‘ 
// if no, set $validation to false and populate $msg with error message. Also let user be back to form page. 10'

// todo: create a simple HTML card to hold form submission data. 10‘


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Event Submission result</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-300">
  <div class="flex min-h-screen items-center justify-center">
    <div class="relative flex w-full max-w-[48rem] flex-row rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
      <?php if ($validation) { ?>
        <div class="relative m-0 w-2/5 shrink-0 overflow-hidden rounded-xl rounded-r-none bg-white bg-clip-border text-gray-700">
          <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=1471&amp;q=80" alt="image" class="h-full w-full object-cover" />
        </div>
        <div class="p-6 flex-1">
          <h4 class="mb-2 block font-sans text-2xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
            <?php
            echo $title;
            ?>
          </h4>
          <p class="mb-8 block font-sans text-base font-normal leading-relaxed text-gray-700 antialiased">
            <!-- todo: Print event description here -->
          </p>

          <div class="flex justify-between w-full">
            <!-- todo: Fill start and end dates below -->
            <span>Start: [start date]</span>
            <span>End: [end date]</span>
          </div>

          <div>
            <!-- todo: use foreach to print the submitted features -->
          </div>

        </div>
      <?php } else { ?>

        <div class="text-xl p-8">
          something wrong <br>
          <!-- todo: add an anchor to link the form page -->
        </div>

      <?php } ?>
    </div>
  </div>
</body>

</html>