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
                    $stmt = $dbh->prepare("SELECT tickets.id, tickets.project_id, tickets.title, tickets.file_name,
                                                  tickets.creator_id, tickets.type, tickets.assigned_id, tickets.status,
                                                  users_as.login as assigned, tickets.description, tickets.file, users.login as creator
                                           FROM tickets
                                           INNER JOIN users ON tickets.creator_id = users.id
                                           INNER JOIN users AS users_as ON tickets.assigned_id = users_as.id
                                           WHERE tickets.id = :id;");
                    $stmt->bindParam(':id', $id);
                    $stmt->execute();
                    while($ticket = $stmt->fetchObject()):
                    $ticket_id = $ticket->id;
                    $creator_id = $ticket->creator_id;
                    ?>
                        <p>id: <?= $ticket->id ?></p>
                        <p>Type: <?= $ticket->type ?></p>
                        <p>Title: <?= $ticket->title ?></p>
                        <p>Status: <?= $ticket->status ?></p>
                        <p>Creator: <?= $ticket->creator ?></p>
                        <p>Assigned: <?= $ticket->assigned ?></p>
                        <p>Description: <?= $ticket->description ?></p>
                        <p>File: <a href="/validation/<?= $ticket->file ?>"><?= $ticket->file_name ?></a></p>
                    <?php endwhile ?>
                    <?php
                    $stmt = $dbh->prepare("SELECT relation.ticket_id, tags.word, tags.id FROM relation
                                           INNER JOIN tags ON relation.tag_id = tags.id
                                           WHERE relation.ticket_id = :id;");
                    $stmt->bindParam(':id', $id);
                    $stmt->execute();
                    ?>
                    <?php while($tag = $stmt->fetchObject()): ?>
                    <a href="relation.php?id=<?= $tag->id ?>"><?=$tag->word?></a>
                        <?php if (is_allowed($creator_id)): ?>
                            <a href="validation/delete_tags.php?id=<?=$tag->id?>&ticket_id=<?=$ticket_id?>">&#10006;</a>
                        <?php endif ?>
                    <?php endwhile ?>
                    <?php if (is_allowed($creator_id)): ?>
                        <form action="validation/add_tags.php?id=<?=$id?>" method="post">
                            <label for="tags">Tags</label>
                            <input class="tegs" type="text" name="tags" id="tags">
                            <button type="submit">Добавить теги</button>
                        </form>
                    <?php endif ?>
                <h4>Комментарии</h4>
                    <?php
                    $stmt = $dbh->prepare("SELECT comments.id, comments.context, comments.creator_id, users.login as creator
                                           FROM comments
                                           INNER JOIN users ON comments.creator_id = users.id
                                           WHERE comments.ticket_id = :id
                                           ORDER BY updated_at DESC;");
                    $stmt->bindParam(':id', $id);
                    $stmt->execute();
                    while($comment = $stmt->fetchObject()):
                    ?>
                    <p>User: <?= $comment->creator ?></p>
                    <p> <?= $comment->context ?></p>
                        <?php if (is_allowed($comment->creator_id)): ?>
                            <a href="validation/delete_comment.php?id=<?=$comment->id?>&ticket_id=<?=$ticket_id?>">Удалить комментарий</a>
                        <?php endif ?>
                    <?php endwhile ?>
                    <form action="validation/new_comment.php?id=<?=$id?>" method="post">
                        <h5>Новый комментарий</h5>
                        <textarea class="comment" type="text" name="comment" cols="50" rows="6"></textarea></br>
                    <button type="submit">Добавить комментарий</button>
                    </form>
