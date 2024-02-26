<?php

session_start();

function setMessage($message)
{
  $_SESSION['message'] = $message;
}

function clearMessage()
{
  unset($_SESSION['message']);
}

function showMessage($type = "info")
{
  session_start(); // Ensure session is started if not already

  switch ($type) {
    case 'success':
      $bgClass = 'bg-green-100';
      $textClass = 'text-green-700'; // Corrected class prefix from bg to text
      break;
    case 'error':
      $bgClass = 'bg-red-100';
      $textClass = 'text-red-700'; // Corrected class prefix from bg to text
      break;

    default:
      $bgClass = 'bg-blue-100';
      $textClass = 'text-blue-700'; // Corrected class prefix from bg to text
      break;
  }

  if (isset($_SESSION['message'])) {
    $safeMessage = htmlspecialchars($_SESSION['message'], ENT_QUOTES, 'UTF-8');

    // Correctly embedding PHP variables within the Heredoc syntax
    echo <<<HTML
    <div class="$textClass $bgClass px-4 py-3 leading-normal text-center rounded-lg" role="alert">
      $safeMessage
    </div>
    HTML;

    unset($_SESSION['message']);
  }
}
