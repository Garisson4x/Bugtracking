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
                $stmt = $dbh->prepare("SELECT projects.id, projects.title, users.login as creator
                                       FROM projects
                                       INNER JOIN users ON projects.creator_id = users.id
                                       WHERE projects.id = :id;");
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                while($project = $stmt->fetchObject()):
                $project_id = $project->id;
                $_SESSION['project_id'] = $project_id
                ?>
                    <p>Id: <?= $project->id ?></p>
                    <p>Name: <?= $project->title ?></p>
                    <p>Creator: <?= $project->creator ?></p>
                <?php endwhile ?>
                <h2>tickets</h2>
                <table>
                    <?php
                        include 'validation/_connect.php';
                        $stmt = $dbh->prepare("SELECT tickets.id, tickets.project_id, tickets.title, tickets.file_name, tickets.type,
                                                      tickets.status, tickets.assigned_id, tickets.description, tickets.file, users.login as creator
                                               FROM tickets
                                               INNER JOIN users ON tickets.creator_id = users.id
                                               WHERE tickets.project_id = :project_id;");
                        $stmt->bindParam(':project_id', $project_id);
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
                    <?php while($ticket = $stmt->fetchObject()): ?>
                    <tr>
                        <td><?= $ticket->id ?></td>
                        <td><?= $ticket->type ?></td>
                        <td><?= $ticket->title ?></td>
                        <td><?= $ticket->status ?></td>
                        <td><?= $ticket->creator ?></td>
                        <td><?= $ticket->assigned_id ?></td>
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
                <a href="new_ticket.php?id=<?=$project_id?>">Создать тикет</a>
                </div>
        </main>
    </body>
</html>
