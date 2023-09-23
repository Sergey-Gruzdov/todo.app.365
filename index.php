<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>todo.365</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1"/>
    <link href="https://fonts.googleapis.com/css?display=swap&family=Shrikhand:400,400italic" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">
</head>
<body>
    
<form method="POST" action="index.php">
                                             <input type="text" name="task" class="task input">
                                             <button type="submit" name="submit">Add Task</button>
                                            </form> 
<?php
                                            require_once 'db.php';
                                            if(isset($_POST['task']))
                                            $task = $_POST["task"];
                                            {
                                                if(empty($task))
                                                {
                                                $emptytask = "Please enter a proper task.";
                                            }
                                                else {
                                                $sql = "INSERT INTO todos (todos, users_id) VALUES (:task, 1)";
                                                $stmt = $pdo->prepare($sql);
                                                $stmt->bindParam(':task', $task, PDO::PARAM_STR);
                                                $stmt->execute();
                                                echo "<meta http-equiv='refresh' content='0'>";
                                            }
                                            }
                                            if (isset($_POST['delete_task'])) {
                                                $task_id_del = $_POST['task_id_del'];
                                                $delete = "DELETE FROM `todos` WHERE `todos`.`id` = $task_id_del;";
                                                $data = $pdo->query($delete)->fetchAll(PDO::FETCH_BOTH);
                                                echo "<meta http-equiv='refresh' content='0'>";
                                            }

                                            if (isset($_POST['task_done'])) {
                                                $task_id_done = $_POST['task_id_done'];
                                                $change = "UPDATE `todos` SET `status` = b'1' WHERE `todos`.`id` = $task_id_done;";
                                                $data = $pdo->query($change)->fetchAll(PDO::FETCH_BOTH);
                                                echo "<meta http-equiv='refresh' content='0;url=https://time.hubs365it.com/pic.php'>";
                                            }

                                            try {
                                                $query = "SELECT * FROM modt ORDER BY RAND() LIMIT 1";
                                                $stmt = $pdo->query($query);
                                            
                                                $modts = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                            
                                                foreach ($modts as $modt) {
                                                    echo "motivational quote: " . $modt['message'] . "<br>";
                                                }
                                            } catch (PDOException $e) {
                                                die("Error: " . $e->getMessage());
                                            }

                                            $query = "select * from todos where status = 1";
                                            $data = $pdo->query($query)->fetchAll(PDO::FETCH_BOTH);

                                            echo "
                                            <div><table class=\"demoTable\">
                                            <thead>
                                            <tr>
                                            <th>Task ID</th>
                                            <th>Task</th>
                                            <th>actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            ";

                                            foreach($data as $row){
                                            echo "
                                            <tr>
                                            <td>{$row['id']}</td>
                                            <td>{$row['todos']}</td>
                                            <td>
                                            <form method='POST' action='index.php'>
                                            <input type='hidden' name='task_id_del' value='{$row['id']}' />
                                            <button type='submit' name='delete_task'>delete</button>
                                            </form>
                                            </td>
                                            </tr>
                                            ";
                                            }
                                            echo "</tbody></table></div>";

                                            $query = "select * from todos where status = 0";
                                            $data = $pdo->query($query)->fetchAll(PDO::FETCH_BOTH);
                                            echo "
                                            <div>
                                            <table class=\"demoTable\">
                                            <thead>
                                            <tr>
                                            <th>Task ID</th>
                                            <th>Task</th>
                                            <th>actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            ";

                                            foreach($data as $row){
                                            echo "
                                            <tr>
                                            <td>{$row['id']}</td>
                                            <td>{$row['todos']}</td>
                                            <td>
                                            <form method='POST' action='index.php'>
                                            <input type='hidden' name='task_id_del' value='{$row['id']}' />
                                            <button type='submit' name='delete_task'>delete</button>
                                            </form>

                                            <form method='POST' action='index.php'>
                                            <input type='hidden' name='task_id_done' value='{$row['id']}' />
                                            <button type='submit' name='task_done'>done</button>
                                            </form>
                                            </td>
                                            </tr>
                                            ";
                                            }
                                            echo "
                                            </tbody>
                                            </table>
                                            </div>
                                            ";
                                            ?>
</body>
</html>