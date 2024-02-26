<?php
$host = "mysql";
$dbname = 'php82-local'; // your database name
$username = "root";
$password = "";

$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

try {
  $pdo = new PDO($dsn, $username, $password);

  // if ($pdo) {
  //   echo "Connected to the $dbname database successfully!";
  // }

  return $pdo;
} catch (PDOException $e) {
  echo $e->getMessage();
}
