<?php
include 'validation/_session.php';
include 'validation/head.php';
include 'validation/_connect.php';
?>
    <body>
        <div class="meeting">
            <p class="glav">Изменить тикет</p>
            <form action="validation/to_edit_ticket.php?id=<?=$_GET['id']?>" method="post" enctype="multipart/form-data">
                <?php
                $id = $_GET['id'];
                $stmt = $dbh->prepare("SELECT * from tickets where id = :id");
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $ticket = $stmt->fetchObject();
                ?>
                <input type="text" name="title" required value="<?=$ticket->title?>" /><br/>
                <select type="text" name="type" required>
                    <option disabled>Выберите тип</option>
                    <option <?php if ($ticket->type == 'bug'): ?>selected="true"<?php endif; ?>>bug</option>
                    <option <?php if ($ticket->type == 'task'): ?>selected="true"<?php endif; ?>>task</option>
                </select></br>
                <select type="text" name="status" required>
                    <option disabled>Выберите статус</option>
                    <option <?php if ($ticket->status == 'new'): ?>selected="true"<?php endif; ?>>new</option>
                    <option <?php if ($ticket->status == 'in progress'): ?>selected="true"<?php endif; ?>>in progress</option>
                    <option <?php if ($ticket->status == 'testing'): ?>selected="true"<?php endif; ?>>testing</option>
                    <option <?php if ($ticket->status == 'done'): ?>selected="true"<?php endif; ?>>done</option>
                </select>
                <?php
                    $stmt = $dbh->prepare("SELECT * from users");
                    $stmt->execute();
                ?>
                <select type="text" name="assigned" required>
                    <option disabled>Выберите человека</option>
                    <?php while($users = $stmt->fetchObject()): ?>
                    <option value="<?=$users->id?>"><?=$users->login?></option>
                    <?php endwhile ?>
                </select>

                <p>Описание</p>
                    <textarea type="text" name="description" cols="33" rows="6" ><?=$ticket->description?></textarea>
                <p>Прикрепить файл</p>
                    <input name="file" type="file">
                <button type="submit">Изменить</button><br/>
            </form>
        </div>
    </body>
</html>
