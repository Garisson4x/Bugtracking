<?php
session_start();
    $title = filter_var(trim($_POST['title']),FILTER_SANITIZE_STRING);
    $user = 'root';
    $password = '';
    $dbh = new PDO('mysql:host=localhost;dbname=BugTracking',$user,$password);
    $id = $_GET['id'];
    $stmt = $dbh->prepare("UPDATE projects SET title = :title WHERE id = :id;");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
header('Location: /projects.php');
?>
