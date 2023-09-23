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
    <div id="wrapper">
        <div id="main">
            <div class="inner">
                <header id="header">
                    <div id="container01" class="container columns">
                        <div class="wrapper">
                            <div class="inner">
                                <div>
                                    <p id="text01">
                                    <u>todo.365</a></u>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="container02" class="container columns">
                        <div class="wrapper">
                            <div class="inner">
                                <div>
                                    <h1 id="text05">⠀ ͏͏͏͏͏͏ ͏͏͏͏͏͏ ͏͏͏͏͏͏ ͏͏͏͏͏͏</h1>
                                    
                                    <h1 id="text22">⠀ ͏͏͏͏͏͏ ͏͏͏͏͏͏ ͏͏͏͏͏͏ ͏͏͏͏͏͏</h1>
                                </div>
                                <div>
                                    <h1 id="text16">
                                        Pia 
                                        <em>! ♥</em>
                                    </h1>
                                    <h2 id="text10">
                                        <span class="p">
                                            <strong>
                                                <em>she/her</em>
                                                <br/>
                                            </strong>
                                             A time schedule created by my awesome boyfriend!
                                            <br/>
                                            <a href="https://pyurhost.com">My boyfriends website.</a>
                                            <br/>
                                            <br/>
                                        </span>
                                    </h2>
                                    <h1 id="text18">⠀ ͏͏͏͏͏͏ ͏͏͏͏͏͏ ͏͏͏͏͏͏ ͏͏͏͏͏͏</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="container08" class="container columns">
                        <div class="wrapper">
                            <div class="inner">
                                <div>
                                    <p id="text23">
                                        <a href=""></a>
                                    </p>
                                </div>
                                <div>
                                    <p id="text24">
                                        <a href=""></a>
                                    </p>
                                </div>
                                <div>
                                    <p id="text25">
                                        <a href=""></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                <section id="home-section">
                    <div id="container03" class="container columns">
                        <div class="wrapper">
                            <div class="inner">
                                <div>
                                </div>
                                <div>
                                    <h1 id="text21">⠀ ͏͏͏͏͏͏ ͏͏͏͏͏͏ ͏͏͏͏͏͏ ͏͏͏͏͏͏</h1>
                                    <h1 id="text15">
                                        <span class="p">
                                            <mark>
                                                ⠀⠀⠀
                                                <strong>to do:</strong>
                                                ⠀⠀⠀
                                            </mark>
                                            <br/>
                                             <form method="POST" action="index.php">
                                             <input type="text" name="task" class="task input">
                                             <button type="submit" name="submit">Add Task</button>
                                            </form>  
                                            <?php
                                            require_once 'db.php';
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
                                        </span>
                                    </h1>
                                    <h1 id="text04">
                                        <span class="p">
                                            <mark>
                                                ⠀⠀⠀
                                                <strong>done:</strong>
                                                ⠀⠀⠀
                                            </mark>
                                            <br/>
                                            <?php
                                            require_once 'db.php';
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
?>
                                        </span>
                                    </h1>
                                    <h1 id="text19">⠀ ͏͏͏͏͏͏ ͏͏͏͏͏͏ ͏͏͏͏͏͏ ͏͏͏͏͏͏</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <footer id="footer">
                    <div id="container07" class="container default">
                        <div class="wrapper">
                            <div class="inner">
                                <h1 id="text06">
                                    <?php
                                            require_once 'db.php';
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
                                    ?>
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
                                            ?>
                                </h1>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
</body>
</html>