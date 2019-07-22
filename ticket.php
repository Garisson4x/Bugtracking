<?php
include 'validation/_session.php';
include 'validation/head.php';
?>
    <body>
        <?= include 'validation/header.php' ?>
        <main>
            <div class="list">
                <h1>The details</h1>
                    <?php
                    include 'validation/_connect.php';
                    $id = $_GET['id'];
                    $stmt = $dbh->prepare("SELECT tickets.id, tickets.project_id, tickets.title, tickets.type,
                                                  tickets.status, tickets.assigned, tickets.description, users.login as creator
                                           FROM tickets
                                           INNER JOIN users ON tickets.creator_id = users.id
                                           WHERE tickets.id = :id;");
                    $stmt->bindParam(':id', $id);
                    $stmt->execute();
                    while($ticket = $stmt->fetchObject()):
                    ?>
                        <p>id: <?= $ticket->id ?></p>
                        <p>Type: <?= $ticket->type ?></p>
                        <p>Title: <?= $ticket->title ?></p>
                        <p>Status: <?= $ticket->status ?></p>
                        <p>Creator: <?= $ticket->creator ?></p>
                        <p>Assigned: <?= $ticket->assigned ?></p>
                        <p>Description: <?= $ticket->description ?></p>
                        <p>File: <?= $ticket->file ?></p>
                    <?php endwhile ?>
                <h4>Комментарии</h4>
                    <?php
                    include 'validation/_connect.php';
                    $stmt = $dbh->prepare("SELECT comments.context, users.login as creator
                                           FROM comments
                                           INNER JOIN users ON comments.creator_id = users.id
                                           WHERE comments.ticket_id = :id;");
                    $stmt->bindParam(':id', $id);
                    $stmt->execute();
                    while($comment = $stmt->fetchObject()):
                    ?>
                    <p>user: <?= $comment->creator ?></p>
                    <p> <?= $comment->context ?></p>
                    <?php endwhile ?>
                    <form action="validation/new_comment.php?id=<?=$id?>" method="post">
                        <h5>Новый комментарий</h5>
                        <textarea type="text" name="comment" cols="50" rows="6"></textarea></br>
                    <button type="submit">Добавить комментарий</button>
