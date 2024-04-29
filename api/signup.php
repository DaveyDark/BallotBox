<?php

require_once 'includes/dbh.inc.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($name) || empty($email) || empty($password)) {
        header('Location: /signup?error=emptyfields');
        die();
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: /signup?error=invalidemail');
        die();
    }

    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch();
    if ($user) {
        header('Location: /signup?error=emailtaken');
        die();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password) VALUES (:name, :email, :password)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashedPassword);

    $stmt->execute();
    $_SESSION['user_id'] = $pdo->lastInsertId();
    header('Location: /');
    die();
}