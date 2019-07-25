<?php
include 'validation/_session.php';
include 'validation/head.php';
?>
    <body>
        <?php include 'validation/header.php' ?>
        <main>
            <div class="list">
                <h1>The details</h1>
                    <?php
                    include 'validation/_connect.php';
                    $id = $_GET['id'];
                    $stmt = $dbh->prepare("SELECT tickets.id, tickets.project_id, tickets.title, tickets.type,
                                                  tickets.status, tickets.assigned_id, tickets.description, tickets.file, users.login as creator
                                           FROM tickets
                                           INNER JOIN users ON tickets.creator_id = users.id
                                           WHERE tickets.id = :id;");
                    $stmt->bindParam(':id', $id);
                    $stmt->execute();
                    while($ticket = $stmt->fetchObject()):
                    $ticket_id = $ticket->id
                    ?>
                        <p>id: <?= $ticket->id ?></p>
                        <p>Type: <?= $ticket->type ?></p>
                        <p>Title: <?= $ticket->title ?></p>
                        <p>Status: <?= $ticket->status ?></p>
                        <p>Creator: <?= $ticket->creator ?></p>
                        <p>Assigned: <?= $ticket->assigned_id ?></p>
                        <p>Description: <?= $ticket->description ?></p>
                        <p>File: <?= $ticket->file ?></p>
                    <?php endwhile ?>
                    <?php
                    $stmt = $dbh->prepare("SELECT relation.ticket_id, tags.word FROM relation
                                           INNER JOIN tags ON relation.tag_id = tags.id
                                           WHERE relation.ticket_id = :id;");
                    $stmt->bindParam(':id', $id);
                    $stmt->execute();
                    ?>
                    <?php while($tag = $stmt->fetchObject()):?>
                    <?=$tag->word?>
                    <?php endwhile ?>
                    <?php
                    $stmt = $dbh->prepare("SELECT * FROM tags re
                                           INNER JOIN users ON comments.creator_id = users.id
                                           WHERE comments.ticket_id = :id;");
                    $stmt->bindParam(':id', $id);
                    $stmt->execute();
                    ?>
                    <form action="validation/add_tags.php?id=<?=$id?>" method="post">
                        <label for="tags">Tags</label>
                        <input type="text" name="tags" id="tags">
                        <button type="submit">Добавить тег</button>
                    </form>
                <h4>Комментарии</h4>
                    <?php
                    $stmt = $dbh->prepare("SELECT comments.id, comments.context, users.login as creator
                                           FROM comments
                                           INNER JOIN users ON comments.creator_id = users.id
                                           WHERE comments.ticket_id = :id;");
                    $stmt->bindParam(':id', $id);
                    $stmt->execute();
                    while($comment = $stmt->fetchObject()):
                    ?>
                    <p>user: <?= $comment->creator ?></p>
                    <p> <?= $comment->context ?></p>
                    <a href="validation/delete_comment.php?id=<?=$comment->id?>&ticket_id=<?=$ticket_id?>">Удалить комментарий</a>
                    <?php endwhile ?>
                    <form action="validation/new_comment.php?id=<?=$id?>" method="post">
                        <h5>Новый комментарий</h5>
                        <textarea type="text" name="comment" cols="50" rows="6"></textarea></br>
                    <button type="submit">Добавить комментарий</button>
                    </form>
