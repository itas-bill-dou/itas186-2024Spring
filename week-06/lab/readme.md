# Lab 06: PHP Task List Connects with MySQL

## Submission and deadline

No formal submission required. Please demonstrate your completed work to me directly.

## Part 1: Setup

This lab builds upon the foundation established in Lab 04. The finished code is in `task-project-crud` in the week-06 folder.

### Steps

- Locate the `docker-compose.yml` file within this folder and move it to the root directory of your `php82.local` project.
- Replace the contents of your `Dockerfile` with the updated version provided.
- Remove any existing Docker containers related to `php82.local` to ensure a clean environment.
- Navigate to the project's root directory in your terminal and execute `docker-compose up -d`. You should observe the creation and start-up of 3 containers without any issues.

### Verification

Ensure the following:

- The page at http://php82.local:9000/lab05/ operates as expected without any issues.

- Navigating to http://php82.local:9002/ displays the PHPMyAdmin login screen.

      - Server: mysql
      - Username: root
      - Password: Leave this field empty

  Successful login should present you with the default PHPMyAdmin dashboard, similar to the one shown here.

- Confirm that the MySQL service is operational by accessing the MySQL container's terminal via Docker Desktop and entering:

```bash
mysql
```

This command should transition you to the MySQL CLI, allowing database interactions. Use exit; to leave the CLI mode.

## Part 2: MySQL Commands Practice (Creating the tasks Table)

This section guides you through creating a `php82-local` database and a `tasks` table within it.

### Step 1: Access MySQL Server

Access the MySQL server through the MySQL container's terminal in Docker Desktop:

```bash
mysql -u root
```

### Step 2: Create the Database

Execute the following command to create the `php82-local` database:

```sql
CREATE DATABASE `php82-local`;
```

### Step 3: Select the Database

Switch to your newly created database:

```sql
USE `php82-local`;
```

### Step 4: Create the `tasks` Table

Within the `php82-local` database, execute the command below to create a `tasks` table:

```sql
CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description TEXT,
    status VARCHAR(50)
);
```

This table includes:

- `id`: An auto-incrementing primary key.
- `description`: A text column for task descriptions.
- `status`: A column to indicate the task's status (e.g., new, done, in progress).

Note that the ending double quotation after each command.

### Step 5: Insert Data

Insert sample data into the `tasks` table. For example:

```sql
INSERT INTO tasks (description, status) VALUES ('Invent a teleportation device.', 'new');
```

You will get a message immediately once it is operated properly.

All tasks:

```
Invent a teleportation device.|new
Teach cats to speak fluent English.|new
Find the lost city of Atlantis.|done
Write a novel in an alien language.|in progress
Create a time machine and attend a dinosaur party.|new
```

Repeat for each task, adjusting the values accordingly. For inserting multiple tasks at once, consult this guide - https://www.mysqltutorial.org/mysql-basics/mysql-insert-multiple-rows/

### Step 6: Verify Data Insertion

Confirm the insertion by executing:

```sql
SELECT * FROM tasks;
```

This command displays all records within the tasks table.

### Step 7: Exit MySQL

To leave the MySQL CLI:

```sql
exit;
```

## Part 3: Integrating MySQL with the Task Project

Transition from using a text file to a MySQL database for task management.

- Complete Parts 1 and 2 before starting this section.
- Create a `lab06` folder, copying all files from `task-project-crud` into it.
- Ensure http://php82.local:9000/lab06 is accessible and functioning correctly.
- Create `database.php` in `lab06` with the following contents:

```php
<?php
$host = "mysql";
$dbname = 'php82-local';
$username = "root";
$password = "";

$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

try {
  $pdo = new PDO($dsn, $username, $password);

  if ($pdo) {
    echo "Connected to the $dbname database successfully!";
  }

  return $pdo;
} catch (PDOException $e) {
  echo $e->getMessage();
}
```

- Usage.
  To use this database connection in other PHP files, include `database.php` at the beginning of each file. For example, create `test.php` in `lab06` to fetch and display tasks:

```php
<?php
$pdo = require_once 'database.php';

try {
    // Prepare a SELECT statement
    $sql = "SELECT * FROM tasks";
    $stmt = $pdo->prepare($sql);

    // Execute the statement
    $stmt->execute();

    // Fetch all rows from the executed statement
    $tasks = $stmt->fetchAll();

    // Iterate over each row and do something with the data
    foreach ($tasks as $task) {
        echo "Task ID: " . $task['id'] . "<br>";
        echo "Description: " . $task['description'] . "<br>";
        echo "Status: " . $task['status'] . "<br><br>";
    }
} catch (\PDOException $e) {
    // Handle any errors
    echo "Error: " . $e->getMessage();
}
?>
```

You should be able to see 5 tasks printed.

- Replace all text file I/O operations in your project with corresponding database operations using PDO.

## Grading

Demonstrate the completion of all parts to receive full credit.

Total: 100'
