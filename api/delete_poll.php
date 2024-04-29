<?php

if($_SERVER['REQUEST_METHOD'] != "POST") {
    http_response_code(405);
    die();
}

if(!isset($_SESSION['user_id'])) {
    http_response_code(401);
    die();
}

$user_id = $_SESSION['user_id'];

require_once __DIR__ . '/../includes/dbh.inc.php';

$poll_id = json_decode(file_get_contents('php://input'), true)['poll_id'];

if(!isset($poll_id)) {
    http_response_code(400);
    die();
}

$poll = getPoll($pdo, $poll_id);
if(isset($poll['']) && $poll['user_id'] != $user_id) {
    http_response_code(403);
    die();
}

$stmt = $pdo->prepare("DELETE FROM votes WHERE box_id = :box_id");
$stmt->bindParam(':box_id', $poll_id);
$stmt->execute();

$stmt = $pdo->prepare("DELETE FROM ballots WHERE box_id = :box_id");
$stmt->bindParam(':box_id', $poll_id);
$stmt->execute();

$stmt = $pdo->prepare("DELETE FROM boxes WHERE id = :id");
$stmt->bindParam(':id', $poll_id);
$stmt->execute();

