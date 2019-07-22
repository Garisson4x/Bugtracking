<?php
include 'validation/_session.php';
include 'validation/head.php';
?>
    <body>
        <div class="meeting">
            <h3>Новый проект</h3>
            <form action="validation/to_create.php" method="post">
                <input type="text" name="title" required placeholder="Введите название" /><br/>
                <button type="submit">Добавить</button><br/>
            </form>
        </div>
    </body>
</html>
