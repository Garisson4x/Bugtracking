<?php
session_start();
    $user = 'root';
    $password = '';
    $dbh = new PDO('mysql:host=localhost;dbname=BugTracking',$user,$password);
    $id = $_GET['id'];
    $stmt = $dbh->prepare("DELETE FROM projects WHERE id = :id;");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
header('Location: /projects.php');
?>
