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
    $project_id = $_SESSION['project_id'];
    include '_connect.php';
    $stmt = $dbh->prepare("UPDATE tickets SET title = :title, creator_id = :creator_id, type = :type, project_id = :project_id, status = :status, description = :description, assigned_id = :assigned, file = :file, file_name = :file_name WHERE id = :id;");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':creator_id', $_SESSION["user_obj"]->id);
    $stmt->bindParam(':type', $_POST["type"]);
    $stmt->bindParam(':project_id', $project_id);
    $stmt->bindParam(':status', $_POST["status"]);
    $stmt->bindParam(':description', $_POST["description"]);
    $stmt->bindParam(':assigned', $_POST["assigned"]);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':file', $dest_path);
    $stmt->bindParam(':file_name', $fileName);
    $stmt->execute();
header("Location: /project.php?id=$project_id");
?>
