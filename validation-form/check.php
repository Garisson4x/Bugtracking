<?php
    $name = filter_var(trim($_POST['name']),FILTER_SANITIZE_STRING);
    $pass = filter_var(trim($_POST['pass']),FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']),FILTER_SANITIZE_STRING);

    // if(mb_strlen($name) < 3 || mb_strlen($name) > 50) {
    //     echo "Недопустимая длина логина";
    //     exit();
    // } else if(mb_strlen($pass) < 2 || mb_strlen($pass) > 6){
    //     echo "Недопустимая длина пароля (от 2 до 6 символов)";
    //     exit();
    // } else if(mb_strlen($email) < 8 || mb_strlen($email) > 50){
    //     echo "Недопустимая длина почты";
    //     exit();
    // }

    // $pass = md5($pass,"dhyswoq213");

    $mysql = new mysqli('localhost', 'root', '', 'mybugtracking');
    $mysql->query("INSERT INTO `users` (`name`, `password`, `email`) VALUES ('$name', '$pass', '$email')");

    $mysql->close();

    header('Location: /index.html');
?>
