<?php
session_start();
    $title = filter_var(trim($_POST['title']),FILTER_SANITIZE_STRING);
    $id = $_GET['id'];
    $project_id = $_SESSION['project_id'];
    include '_connect.php';
    $stmt = $dbh->prepare("UPDATE tickets SET title = :title, creator_id = :creator_id, type = :type, project_id = :project_id, status = :status, description = :description, assigned_id = :assigned WHERE id = :id;");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':creator_id', $_SESSION["user_obj"]->id);
    $stmt->bindParam(':type', $_POST["type"]);
    $stmt->bindParam(':project_id', $project_id);
    $stmt->bindParam(':status', $_POST["status"]);
    $stmt->bindParam(':description', $_POST["description"]);
    $stmt->bindParam(':assigned', $_POST["assigned"]);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
header("Location: /project.php?id=$project_id");
?>
