<?php
/*Create API*/
header('Content-Type: application/json');

include("db.php");

$question = $_POST['quiz_question'];
$answer = $_POST['quiz_answer'];
$quiz_id = (int) $_POST['quizid'];

$stmt = $db->prepare("INSERT INTO flashcards (question, answer, quiz_id) VALUES (?, ?, ?)");
$result = $stmt->execute([$question, $answer, $quiz_id]);

if($result){
    echo json_encode([
    'code' =>  '201'
    ]);
}


?>