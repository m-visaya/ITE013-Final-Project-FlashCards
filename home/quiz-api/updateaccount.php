<?php
header('Content-Type: application/json');

include("db.php"); //DB connection script

$newusername = $_POST['newusername'];
$newemail = $_POST['newemail'];
$newpassword = $_POST['newpassword'];
$user_id = (int) $_POST['user_id'];

if($newusername = "") $newusername = 

$stmt = $db->prepare("UPDATE flash SET username = '?', email = '?', password = '?' WHERE id = ?");
$result =  $stmt->execute([$newusername, $newemail, $newpassword, $user_id]);

if($result){
    echo json_encode([
    'code' =>  '201'
    ]);
}

?>