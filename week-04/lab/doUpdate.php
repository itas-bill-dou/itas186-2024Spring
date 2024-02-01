<?php

// create a var to store any messages
$messages = '';

/* 
task 3 (40' total):
1. Validate a task is is submitted because you will use this id to locate the task to update. (3')
1. Similar as doCreate.php, validate the submitted task content and status, ensure content is required and not empty; the status must be valid (one of 3 statuses) (5')
2. If above conditions are not fulfilled, display an error message "Bad Task Submitted" and provide a link to let user click to go back to the editing form page. (4')
3. If all is good, locate the task based on the id in step 1 and update its content and status. Keep Id as is (25')
tip: Loop each task and find the matched one then update it.
4. Once updated successfully, display a successful message "The task #xxxxxxx is successfully updated!", that "xxxxxx" is the task Id and provide a link to go to index page. (3')

Check the task you just updated and see if the content or status is updated.
*/