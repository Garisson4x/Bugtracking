<?php
include 'validation/_session.php';
include 'validation/head.php';
?>
    <body>
        <div class="container">
        <?php include 'validation/header.php' ?>
            <main>
                <div class="list">
                    <h1>Assigned task</h1>
                    <table>
                        <?php
                            include 'validation/_connect.php';
                            $id = $_GET['id'];
                            $stmt = $dbh->prepare("SELECT tickets.id, tickets.project_id, tickets.title, tickets.file_name, tickets.type, tickets.assigned_id,
                                                          tickets.status, users_as.login as assigned, tickets.description, tickets.file, users.login as creator
                                                   FROM tickets
                                                   INNER JOIN users ON tickets.creator_id = users.id
                                                   INNER JOIN users AS users_as ON tickets.assigned_id = users_as.id
                                                   WHERE tickets.assigned_id = :id
                                                   ORDER BY updated_at DESC;");
                            $stmt->bindParam(':id', $id);
                            $stmt->execute();
                        ?>
                        <tr>
                            <td>Id</td>
                            <td>Type</td>
                            <td>Title</td>
                            <td>Status</td>
                            <td>Creator</td>
                            <td>Assigned</td>
                            <td>Description</td>
                            <td>File</td>
                            <td>Action</td>
                        </tr>
                        <?php while($ticket = $stmt->fetchObject()):?>
                        <tr>
                            <td><?= $ticket->id ?></td>
                            <td><?= $ticket->type ?></td>
                            <td><?= $ticket->title ?></td>
                            <td><?= $ticket->status ?></td>
                            <td><?= $ticket->creator ?></td>
                            <td><?= $ticket->assigned ?></a></td>
                            <td><?= $ticket->description ?></td>
                            <td><a href="<?= $ticket->file ?>"><?= $ticket->file_name ?></a></td>
                            <td>
                                <a href="ticket.php?id=<?= $ticket->id ?>">Show</a>
                                <a href="edit_ticket.php?id=<?= $ticket->id ?>">Edit</a>
                                <a href="validation/delete_ticket.php?id=<?= $ticket->id ?>">Delete</a>
                            </td>
                        </tr>
                        <?php endwhile ?>
                    </table></br>
                </div>
            </main>
        </div>
    </body>
</html>
