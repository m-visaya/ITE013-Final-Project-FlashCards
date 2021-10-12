<?php
/*Create API*/
header('Content-Type: application/json');

include("db.php");

$name = $_POST['quizname'];
$description = $_POST['quizdescription'];
$user_id = (int) $_POST['user_id'];

$stmt = $db->prepare("INSERT INTO quizzes (name, description, user_id) VALUES (?, ?, ?)");
$result = $stmt->execute([$name, $description, $user_id]);

if($result){
    echo json_encode([
    'code' =>  '201'
    ]);
}


?>