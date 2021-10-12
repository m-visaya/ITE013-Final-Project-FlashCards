<?php

header('Content-Type: application/json', true);

include("db.php");

$user_id = (int) $_POST['user_id'];
$search =  $_POST['search'];

$stmt = $db->prepare("SELECT * FROM quizzes WHERE user_id = ? AND name LIKE ? OR description LIKE ?");
$stmt->execute([$user_id, $search, $search]);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);

?>