<?php
include 'validation/_session.php';
include 'validation/head.php';
?>
    <body>
        <div class="meeting">
            <h3>Переименовать проект</h3>
            <form action="validation/edit.php?id=<?=$_GET['id']?>" method="post">
                <input type="text" name="title" required placeholder="Новое название" /><br/>
                <button type="submit">Изменить</button><br/>
            </form>
        </div>
    </body>
</html>
