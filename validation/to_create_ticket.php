<?php
session_start();
    $fileTmpPath = $_FILES['file']['tmp_name'];
    $fileName = $_FILES['file']['name'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
    $uploadFileDir = "upload/";
    $dest_path = $uploadFileDir . $newFileName;
    move_uploaded_file($fileTmpPath, $dest_path);
    $title = filter_var(trim($_POST['title']),FILTER_SANITIZE_STRING);
    $id = $_GET['id'];
    include '_connect.php';
    $stmt = $dbh->prepare("INSERT INTO tickets (title, creator_id, type, project_id, status, description, assigned_id, file, file_name) VALUES (:title, :creator_id, :type, :project_id, :status, :description, :assigned, :file, :file_name);");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':creator_id', $_SESSION["user_obj"]->id);
    $stmt->bindParam(':type', $_POST["type"]);
    $stmt->bindParam(':project_id', $id);
    $stmt->bindParam(':status', $_POST["status"]);
    $stmt->bindParam(':description', $_POST["description"]);
    $stmt->bindParam(':assigned', $_POST["assigned"]);
    $stmt->bindParam(':file', $dest_path);
    $stmt->bindParam(':file_name', $fileName);
    $stmt->execute();
header("Location: /project.php?id=$id");
?>
