<?php
session_start();
    include '_connect.php';
    $id = $_GET['id'];
    $project_id = $_SESSION['project_id'];
    $stmt = $dbh->prepare("DELETE FROM tickets WHERE id = :id;");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
header("Location: /project.php?id=$project_id");
?>
