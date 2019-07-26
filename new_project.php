<?php
include 'validation/_session.php';
include 'validation/head.php';
?>
    <body>
        <div class="meeting">
            <p class="glav">Новый проект</p>
            <form action="validation/to_create.php" method="post">
                <input type="text" name="title" required placeholder="Введите название" /><br/>
            <div>
                <button class="enter" type="submit">Добавить</button>
            </div>
            </form>
        </div>
    </body>
</html>
