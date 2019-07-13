<?php
$user = 'root';
$password = '';
try {
    $dbh = new PDO('mysql:host=localhost;dbname=mybugtracking',$user,$password);
} catch (PDOException $e) {
    echo "Enable to connect to db\n";
    echo $e->getMessage();
    echo "\n";
    die();
}

$stmt = $dbh->prepare("INSERT INTO users (name, password) VALUES (:name, :password)");
$stmt->bindParam(':name', $name);
$stmt->bindParam(':password', $password);

$name = 'Serg';
$password = 'password';
$stmt->execute();

?>
