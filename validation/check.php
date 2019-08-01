<?php
    $login = filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);
    $pass = filter_var(trim($_POST['pass']),FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']),FILTER_SANITIZE_STRING);

    $pass = password_hash($_POST['pass'], PASSWORD_BCRYPT);

    include '_connect.php';

    $stmt = $dbh->prepare("SELECT * FROM users WHERE login = :login");
    $stmt->bindParam(':login', $login);
    $stmt->execute();
    $user = $stmt->fetchall();

    if(count($user) == 0) {
        $stmt = $dbh->prepare("INSERT INTO users (login, password, email) VALUES (:login, :pass, :email)");
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':pass', $pass);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    } else {
        echo "Такой пользователь уже существует";
        exit();
    }

    header('Location: /index.html');
?>
