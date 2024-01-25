<?php

/*
task 3 (5' total): 
Receive form submission
*/

/* 
task 4 (11' total): 
Submission validation: 
1.The task content is required and must not be empty. (3')
2.Status is required and must be one of new, in progress or done. (3')
3.Redirect the user back to the task creation page if neither condition is met. (3')
otherwise, store the task and status into a variable $newTask which is an associate array (2')
*/

/*
task 5 (10' total):
Convert $newTask into string and append it as a single line at the end of task-list.txt (10')
for example, if current text file contents are:

  Invent a teleportation device.|new
  Teach cats to speak fluent English.|done
  Find the lost city of Atlantis.|done

Once you append the new task, let's say the new task is "new task here." and its status is new:
The new content of task list will be:

  Invent a teleportation device.|new
  Teach cats to speak fluent English.|done
  Find the lost city of Atlantis.|done
  new task here.|new

tip: fwrite
*/

// task 6 (4' total): Once done, redirect user to index.php