<?php
session_start();
    include '_connect.php';
    $id = $_GET['id'];
    $stmt = $dbh->prepare("DELETE FROM projects WHERE id = :id;");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
header('Location: /projects.php');
?>
