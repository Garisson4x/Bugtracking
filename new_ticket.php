<?php
include 'validation/_session.php';
include 'validation/head.php';
?>
    <body>
        <div class="meeting">
            <p class="glav">Новый тикет</p>
            <form action="validation/to_create_ticket.php?id=<?=$_GET['id']?>" method="post" enctype="multipart/form-data">
                <input type="text" name="title" required placeholder="Введите название" /><br/>
                <select type="text" name="type" required>
                    <option disabled>Выберите тип</option>
                    <option>bug</option>
                    <option>task</option>
                </select>
                <select type="text" name="status" required>
                    <option disabled>Выберите статус</option>
                    <option>new</option>
                    <option>in progress</option>
                    <option>testing</option>
                    <option>done</option>
                </select>
                <?php
                    include 'validation/_connect.php';
                    $stmt = $dbh->prepare("SELECT * from users");
                    $stmt->execute();
                ?>
                <select type="text" name="assigned" required>
                    <option disabled>Выберите человека</option>
                    <?php while($users = $stmt->fetchObject()): ?>
                    <option value="<?=$users->id?>"><?=$users->login?></option>
                    <?php endwhile ?>
                </select>

                <p>Комментарий</p>
                    <textarea type="text" name="description" cols="33" rows="6"></textarea>
                <p>Прикрепить файл</p>
                    <input name="file" type="file">
                <div>
                    <button class="enter" type="submit">Добавить</button>
                </div>
            </form>
        </div>
    </body>
</html>
