<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION["user"])) {
    header('Location: /index.html');
}
?>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Create</title>
        <link rel="stylesheet/less" type="text/css" href="styles/style.less" />
        <script src="js/less.min.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="meeting">
            <h3>Новый проект</h3>
            <form action="validation-form/to_create.php" method="post">
                <input type="text" name="title" required placeholder="Введите название" /><br/>
                <button type="submit">Добавить</button><br/>
            </form>
        </div>
    </body>
</html>
