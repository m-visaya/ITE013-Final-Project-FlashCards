<?php

header('Content-Type: application/json', true);

include("db.php");

$quiz_id = $_POST['quizid'];

$stmt = $db->prepare("SELECT name, description FROM quizzes WHERE id = ?");
$stmt->execute([$quiz_id]);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);

?>