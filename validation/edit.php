<?php
session_start();
    $title = filter_var(trim($_POST['title']),FILTER_SANITIZE_STRING);
    include '_connect.php';
    $id = $_GET['id'];
    $stmt = $dbh->prepare("UPDATE projects SET title = :title WHERE id = :id;");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
header('Location: /projects.php');
?>
