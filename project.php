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
                <h1>The details</h1>
                <?php
                $user = 'root';
                $password = '';
                $dbh = new PDO('mysql:host=localhost;dbname=BugTracking',$user,$password);
                $id=$_GET['id'];
                $stmt = $dbh->prepare("SELECT * FROM projects WHERE id= :id;");
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                while($row = $stmt->fetchObject()){
                    echo '<p>name: ' .$row->title. '</p>';
                    echo '<p>creater: ' .$row->created. '</p>';
                }
                ?>
                <h2>tickets</h2>
                </div>
        </main>
    </body>
</html>
