<?php

header('Content-Type: application/json', true);

include("db.php");

$user_id = (int) $_POST['user_id'];

$stmt = $db->prepare("SELECT * FROM quizzes WHERE user_id = ?");
$stmt->execute([$user_id]);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);

?>