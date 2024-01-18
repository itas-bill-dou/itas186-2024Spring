# Lab 02: Event Form and Form Processing

## Prepare the lab

1. In php82.local root directory, create a folder `lab02`.
2. Copy `eventformhandler.php` and `eventform.php` from this directory into `lab02` folder.

All tasks you can find by searching "todo:"

## eventform.php

3. Add action in form tag.
action should point to `eventformhandler.php`
4. Add name attribute for each inputs including text input and checkbox.
5. Convert the `Clear` button to be form reset button.
6. Make sure the `Create` button is a form submission button.

## eventformhandler.php

7. Receive form all inputs via superglobal variable `$_POST`.
8. Make sure the start date is not greater than end date, otherwise, print an error message and a link to let user back to form page to refill.
9. Once collecting all form data, display them in a HTML card.

## Testing

http://php82.local:9000/lab02/eventform.php

## Submission

Please upload the finished `eventformhandler.php` and `eventform.php` files in portal lab2.
