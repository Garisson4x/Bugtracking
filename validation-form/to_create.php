<?php
session_start();
    $title = filter_var(trim($_POST['title']),FILTER_SANITIZE_STRING);
    $user = 'root';
    $password = '';
    $dbh = new PDO('mysql:host=localhost;dbname=BugTracking',$user,$password);
    $stmt = $dbh->prepare("INSERT INTO projects (title, created) VALUES (:title, :created);");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':created', $_SESSION["user"]);
    $stmt->execute();
header('Location: /projects.php');
?>
