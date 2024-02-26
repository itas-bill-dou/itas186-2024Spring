<?php

session_start();

$pdo = require_once 'database.php';

$validStatuses = ['new', 'in progress', 'done'];

/*
Receive form submission only as POST is not empty
*/
if (!empty($_POST)) {
  $task = !empty(trim($_POST['task'])) ? trim($_POST['task']) : '';
  $status = !empty(trim($_POST['status'])) ? trim($_POST['status']) :  '';

  if (!in_array($status, $validStatuses)) {
    // Set up the flash message with message
    $_SESSION['message'] = 'Your operation was successful.';
    header('Location: createForm.html');
    exit;
  }

  try {
    // store the task and status into a variable $newTask which is an associate array
    $stmt = $pdo->prepare("INSERT INTO tasks (description, status) VALUES (:description, :status)");
    $stmt->bindParam(':description', $task);
    $stmt->bindParam(':status', $status);

    $stmt->execute();

    header('Location: index.php');
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
  }
} else {
  header('Location: createForm.html');
  exit;
}
