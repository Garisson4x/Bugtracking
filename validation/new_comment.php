<?php
session_start();
    $id = $_GET['id'];
    include '_connect.php';
    $stmt = $dbh->prepare("INSERT INTO comments (context, creator_id, ticket_id) VALUES (:comment, :creator_id, :ticket_id);");
    $stmt->bindParam(':comment', $_POST["comment"]);
    $stmt->bindParam(':creator_id', $_SESSION["user_obj"]->id);
    $stmt->bindParam(':ticket_id', $id);
    $stmt->execute();
header("Location: /ticket.php?id=$id");
?>
