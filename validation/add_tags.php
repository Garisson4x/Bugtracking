<?php
session_start();
    $id = $_GET['id'];
    $tags = explode(",", $_POST['tags']);
    include '_connect.php';
    for ($i = 0; $i < count($tags); $i++) {
        $stmt = $dbh->prepare("SELECT id FROM tags WHERE word = :tags");
        $stmt->bindParam(':tags', trim($tags[$i]));
        $stmt->execute();

            if (!($tag = $stmt->fetchObject())){
            $stmt = $dbh->prepare("INSERT INTO tags (word) VALUES (:tags);");
            $stmt->bindParam(':tags', trim($tags[$i]));
            $stmt->execute();
            $tag_id = $dbh->lastInsertId();
            } else {
                $stmt = $dbh->prepare("SELECT id FROM tags WHERE word = :tags");
                $stmt->bindParam(':tags', trim($tags[$i]));
                $stmt->execute();
                $tag_id = $stmt->fetchObject();
            }

        $stmt = $dbh->prepare("INSERT INTO relation (ticket_id, tag_id) VALUES (:ticket_id, :tag_id);");
        $stmt->bindParam(':ticket_id', $id);
        $stmt->bindParam(':tag_id', $tag_id->id);
        $stmt->execute();
    }
header("Location: /ticket.php?id=$id");
?>
