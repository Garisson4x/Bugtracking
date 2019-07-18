<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION["user"])) {
    header('Location: /index.html');
}
$id = $_GET['id'];
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
            <h3>Переименовать проект</h3>
            <form action="validation-form/edit.php?id=<?=$id?>" method="post">
                <input type="text" name="title" required placeholder="Новое название" /><br/>
                <button type="submit">Изменить</button><br/>
            </form>
        </div>
    </body>
</html>
