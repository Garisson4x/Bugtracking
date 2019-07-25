<?php
include 'validation/_session.php';
include 'validation/head.php';
?>
    <body>
        <div class="container">
        <?php include 'validation/header.php' ?>
            <main>
                <div class="list">
                    <h1>Projects</h1>
                    <table>
                        <?php
                            include 'validation/_connect.php';
                            $stmt = $dbh->prepare("SELECT projects.id, projects.title, users.login as creator
                                                   FROM projects
                                                   INNER JOIN users ON projects.creator_id = users.id;");
                            $stmt->execute();
                        ?>
                        <tr>
                            <td>Id</td>
                            <td>Title</td>
                            <td>Creater</td>
                            <td>Action</td>
                        </tr>
                        <?php while($project = $stmt->fetchObject()): ?>
                        <tr>
                            <td><?= $project->id ?></td>
                            <td><?= $project->title ?></td>
                            <td><?= $project->creator ?></td>
                            <td>
                                <a href="project.php?id=<?= $project->id ?>">Show</a>
                                <a href="edit_project.php?id=<?= $project->id ?>">Edit</a>
                                <a href="validation/delete.php?id=<?= $project->id ?>">Delete</a>
                            </td>
                        </tr>
                        <?php endwhile ?>
                    </table></br>
                    <a href="new_project.php">Создать проект</a>
                </div>
            </main>
        </div>
    </body>
</html>
