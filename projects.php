<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION["user"])) {
    header('Location: /index.html');
}
?>
<html lang="en" dir="ltr">
    <head>
        <link rel="stylesheet/less" type="text/css" href="styles/style.less" />
        <script src="js/less.min.js" type="text/javascript"></script>
        <meta charset="utf-8">
        <title>Bugtracking</title>
    </head>
    <body>
        <div class="container">
            <header>
                <div class="logo">
                    <h1>Bugtracking</h1>
                </div>
                <div class="quit">
                    <?php
                    echo $_SESSION["user"];
                    ?>
                    <a href='validation-form/quit.php'> Выйти </a>
                </div>
            </header>
            <main>
                <div class="list">
                    <h1>Projects</h1>
                    <table>
                        <?php
                            $user = 'root';
                            $password = '';
                            $dbh = new PDO('mysql:host=localhost;dbname=BugTracking',$user,$password);
                            $stmt = $dbh->prepare("SELECT * from projects;");
                            $stmt->execute();
                        ?>
                        <tr>
                            <td>Id</td>
                            <td>Title</td>
                            <td>Creater</td>
                            <td>Action</td>
                        </tr>
                        <?php
                        while($row = $stmt->fetchObject()){
                        $id = $row->id;
                        echo '<tr>';
                            echo '<td>' .$row->id. '</td>';
                            echo '<td>' .$row->title. '</td>';
                            echo '<td>' .$row->created. '</td>';
                            echo '<td>
                                    <a href="project.php?id='.$id.'">Show</a>
                                    <a href="edit_project.php?id='.$id.'">Edit</a>
                                    <a href="validation-form/delete.php?id='.$id.'">Delete</a>
                                  </td>';
                        echo '</tr>';
                        }
                        ?>
                    </table></br>
                    <a href="new_project.php">Создать проект</a>
                </div>
            </main>
        </div>
    </body>
</html>
