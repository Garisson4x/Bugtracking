<?php
    $name = filter_var(trim($_POST['name']),FILTER_SANITIZE_STRING);
    $pass = filter_var(trim($_POST['pass']),FILTER_SANITIZE_STRING);

    // $pass = md5($pass,"dhyswoq213");

    $user = 'root';
    $password = '';
    $dbh = new PDO('mysql:host=localhost;dbname=mybugtracking',$user,$password);

    $stmt = $dbh->prepare("SELECT * FROM users WHERE name = :name AND password = :pass");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':pass', $pass);
    $stmt->execute();
    $user = $stmt->fetchall();
    
    if(count($user) == 0) {
        echo "Такой пользователь не найден";
        exit();
    }

    session_start();
    $_SESSION["user"] = $name;
    header('Location: /list_task.php');
?>
