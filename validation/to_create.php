<?php
session_start();
    $title = filter_var(trim($_POST['title']),FILTER_SANITIZE_STRING);
    include '_connect.php';
    $stmt = $dbh->prepare("INSERT INTO projects (title, creator_id) VALUES (:title, :creator_id);");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':creator_id', $_SESSION["user_obj"]->id);
    $stmt->execute();
header('Location: /projects.php');
?>
