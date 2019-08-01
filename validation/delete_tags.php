<?php
session_start();
    include '_connect.php';
    $id = $_GET['id'];
    $ticket_id = $_GET['ticket_id'];
    $stmt = $dbh->prepare("DELETE FROM relation WHERE tag_id = :id AND ticket_id = :ticket_id;");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':ticket_id', $ticket_id);
    $stmt->execute();
header("Location: /ticket.php?id=$ticket_id");
?>
