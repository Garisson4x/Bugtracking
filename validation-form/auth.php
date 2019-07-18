<?php
    $login = filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);
    $pass = filter_var(trim($_POST['pass']),FILTER_SANITIZE_STRING);

    // $pass = md5($pass,"dhyswoq213");
    // if(!password_verify($pass, $user->password)){
    //     header('Location: /projects.php');
    // }

    $user = 'root';
    $password = '';
    $dbh = new PDO('mysql:host=localhost;dbname=BugTracking',$user,$password);

    $stmt = $dbh->prepare("SELECT * FROM users WHERE login = :login");
    $stmt->bindParam(':login', $login);
    $stmt->execute();
    $user = $stmt->fetchall();

    if(count($user) == 0) {
        echo "Такой пользователь не найден";
        exit();
    } else {
        $stmt = $dbh->prepare("SELECT * FROM users WHERE password = :pass");
        $stmt->bindParam(':pass', $pass);
        $stmt->execute();
        $pass = $stmt->fetchall();

        if(count($pass) == 0) {
            echo "Пароль не подходит";
            exit();
        }
    }

    session_start();
    $_SESSION["user"] = $login;
    header('Location: /projects.php');
?>
