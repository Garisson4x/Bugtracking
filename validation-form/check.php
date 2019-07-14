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

    $user = 'root';
    $password = '';
    $dbh = new PDO('mysql:host=localhost;dbname=mybugtracking',$user,$password);

    $stmt = $dbh->prepare("SELECT * FROM users WHERE name = :name");
    $stmt->bindParam(':name', $name);
    $stmt->execute();
    $user = $stmt->fetchall();
    
    if(count($user) == 0) {
        $stmt = $dbh->prepare("INSERT INTO users (name, password, email) VALUES (:name, :pass, :email)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':pass', $pass);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    } else {
        echo "Такой пользователь уже существует";
        exit();
    }


    header('Location: /index.html');
?>
