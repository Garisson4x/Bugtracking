<?php
    $login = filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);
    $pass = filter_var(trim($_POST['pass']),FILTER_SANITIZE_STRING);

    include '_connect.php';

    $stmt = $dbh->prepare("SELECT * FROM users WHERE login = :login");
    $stmt->bindParam(':login', $login);
    $stmt->execute();
    $user = $stmt->fetchall();

    if(count($user) == 0) {
        echo "Такой пользователь не найден";
        exit();
    } else {
        $stmt = $dbh->prepare("SELECT password FROM users where login = :login");
        $stmt->bindParam(':login', $login);
        $stmt->execute();
        $password = $stmt->fetchObject();
        $hash = $password->password;

        if (!password_verify($pass, $hash) || count($pass) == 0) {
            echo "Пароль не подходит";
            exit();
        }
    }

    session_start();
    $_SESSION["user"] = $login;
    $stmt = $dbh->prepare("SELECT * FROM users WHERE login = :login;");
    $stmt->bindParam(':login', $login);
    $stmt->execute();
    $user = $stmt->fetchObject();
    $_SESSION["user_obj"] = $user;
    header('Location: /projects.php');
?>
