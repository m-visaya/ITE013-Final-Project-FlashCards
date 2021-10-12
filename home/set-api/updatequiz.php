<?php
header('Content-Type: application/json');

include("db.php"); //DB connection script

$id = $_POST['id'];
$name = $_POST['name'];

$stmt = $db->prepare("UPDATE quizzes SET name = ? WHERE id = ?");
$result =  $stmt->execute([$name, $age, $address, $section, $id]);

if($result){
    echo json_encode([
    'code' =>  '201'
    ]);
}

?>