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
        <div class="container">
            <header>
                <div class="logo">
                    <h1>Bugtracking</h1>
                </div>
                <div class="quit">
                    <?php
                    session_start();
                    echo $_SESSION["user"];
                    echo "<a href='validation-form/quit.php'> Выйти </a>";
                    ?>
                </div>
            </header>
            <main>
                <div class="list">
                    <h1>Task list</h1>
                    <p><a href="task.php"> Task1</a></p>
                </div>
            </main>
        </div>
    </body>
</html>
