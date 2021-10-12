<?php
    header('Content-Type: application/json', true);
    session_start();
    $quizid = (int) $_POST['quizid'];
    $_SESSION['quizid'] = $quizid;
    echo $quizid;
?>