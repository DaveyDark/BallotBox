<?php

include_once 'includes/dbh.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        http_response_code(401);
        echo json_encode(array("message" => "Unauthorized"));
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $box_id = $_POST['box_id'];

    $formData = $_POST;

    $stmt = $pdo->prepare("INSERT INTO votes (ballot_id, user_id, box_id, rank) VALUES (:ballot_id, :user_id, :box_id, :rank)");
    foreach ($formData as $ballot_id => $rank) {
        if (!is_numeric($ballot_id) || !is_numeric($rank)) {
            continue;
        }

        $stmt->bindParam(':ballot_id', $ballot_id);
        $stmt->bindParam(':box_id', $box_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':rank', $rank);
        $stmt->execute();
    }

    http_response_code(200);
    Header ('Location: /');
} else {
    http_response_code(405);
    echo json_encode(array("message" => "Method Not Allowed"));
}