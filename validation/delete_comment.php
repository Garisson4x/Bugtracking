<?php
session_start();
    include '_connect.php';
    $id = $_GET['id'];
    $ticket_id = $_GET['ticket_id'];
    $stmt = $dbh->prepare("DELETE FROM comments WHERE id = :id;");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
header("Location: /ticket.php?id=$ticket_id");
?>
