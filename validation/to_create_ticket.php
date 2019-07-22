<?php
session_start();
    $title = filter_var(trim($_POST['title']),FILTER_SANITIZE_STRING);
    $id = $_GET['id'];
    include '_connect.php';
    $stmt = $dbh->prepare("INSERT INTO tickets (title, creator_id, type, project_id, status, description, assigned) VALUES (:title, :creator_id, :type, :project_id, :status, :description, :assigned);");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':creator_id', $_SESSION["user_obj"]->id);
    $stmt->bindParam(':type', $_POST["type"]);
    $stmt->bindParam(':project_id', $id);
    $stmt->bindParam(':status', $_POST["status"]);
    $stmt->bindParam(':description', $_POST["description"]);
    $stmt->bindParam(':assigned', $_POST["assigned"]);
    $stmt->execute();
header("Location: /project.php?id=$id");
?>
