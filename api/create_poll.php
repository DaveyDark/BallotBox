<?php

require_once 'includes/dbh.inc.php';

if (!isset($_SESSION['user_id'])) {
    die("User not logged in");
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $options = array();

    foreach ($_POST as $key => $value) {
        if (strpos($key, 'option-') === 0) {
            $options[] = $value;
        }
    }

    $box_id = insertBox($pdo, $user_id, $title);
    $ballot_id = insertBallots($pdo, $box_id, $options);
    header ('Location: /');
}

function insertBox($pdo, $user_id, $name) {
    $sql = "INSERT INTO boxes (user_id, name) VALUES (:user_id, :name)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':name', $name);
    $stmt->execute();
    return $pdo->lastInsertId();
}

function insertBallots($pdo, $box_id, $options) {
    $sql = "INSERT INTO ballots (box_id, name) VALUES (:box_id, :option)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':box_id', $box_id);
    foreach ($options as $option) {
        $stmt->bindParam(':option', $option);
        $stmt->execute();
    }
    return $pdo->lastInsertId();
}