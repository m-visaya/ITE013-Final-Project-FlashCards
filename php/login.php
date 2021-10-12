<?php
    session_start();
    include('db.php');

    if (isset($_POST['loginLog'])) {
        $loguser = $_POST['loguser'];
        $logpass = $_POST['logpass'];
        $sql = "SELECT * FROM `flash` WHERE username = '$loguser' AND password = '$logpass';";
        $result = $conn->query($sql);
        if($result-> num_rows > 0){
            $row = mysqli_fetch_assoc($result);
            if ($row['username'] === $loguser && $row['password'] === $logpass) {

                    echo "<script>alert('Login Success');</script>";
                    $_SESSION['username'] = $row['username'];

                    $_SESSION['password'] = $row['password'];

                    $_SESSION['id'] = $row['id'];

                    $_SESSION['email'] = $row['email'];

                    header("Location: ../home");

                    exit();
            }
        }else{
            echo "<script>alert('Non-Existent User. Please Sign Up!!');</script>";
            exit();
        }
    }else{
        echo "<script>alert('Non-Existent User. Please Sign Up!!');</script>";
        exit();
    }
?>