<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <link rel="stylesheet/less" type="text/css" href="styles/style.less" />
        <script src="js/less.min.js" type="text/javascript"></script>
        <meta charset="utf-8">
        <title>Bugtracking</title>
    </head>
    <body>
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
                <h1>The details</h1>
                </div>
        </main>
    </body>
</html>
