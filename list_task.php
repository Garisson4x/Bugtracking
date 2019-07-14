<!DOCTYPE html>
<?php
session_start();
if (isset($_SESSION["user"])) {
    } else {
        header('Location: /index.html');
    }
?>
<html lang="en" dir="ltr">
    <head>
        <link rel="stylesheet/less" type="text/css" href="styles/style.less" />
        <script src="js/less.min.js" type="text/javascript"></script>
        <meta charset="utf-8">
        <title>Bugtracking</title>
    </head>
    <body>
        <header class="pageheader">
            <h1>Bugtracking</h1>
            <?php
            session_start();
            echo $_SESSION["user"];
            echo "<a href='validation-form/quit.php'> Выйти </a>";
            ?>
        </header>
        <div class="list">
            <h1>Task list</h1>
            <p><a href="task.html"> Task1</a></p>
            </div>
    </body>
</html>
