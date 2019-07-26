<?php
include 'validation/_session.php';
include 'validation/head.php';
?>
    <body>
        <div class="meeting">
            <p class="glav">Переименовать проект</p>
            <form action="validation/edit.php?id=<?=$_GET['id']?>" method="post">
                <input type="text" name="title" required placeholder="Новое название" /><br/>
                <div>
                    <button class="enter" type="submit">Изменить</button>
                </div>
            </form>
        </div>
    </body>
</html>
