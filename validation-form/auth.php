<?php
    $name = filter_var(trim($_POST['name']),FILTER_SANITIZE_STRING);
    $pass = filter_var(trim($_POST['pass']),FILTER_SANITIZE_STRING);

    // $pass = md5($pass,"dhyswoq213");

    $mysql = new mysqli('localhost', 'root', '', 'mybugtracking');

    $result = $mysql->query("SELECT * FROM `users` WHERE `name` = '$name' AND `password` = '$pass'");
    $user = $result->fetch_assoc();
    if(count($user) == 0) {
        echo "Такой пользователь не найден";
        exit();
    }

    setcookie('user', $user['name'], time() + 3600, "/");

    $mysql->close();

    header('Location: /list_task.html');
?>
