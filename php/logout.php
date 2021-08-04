<?php

    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $logout_id = $_GET['logout_id'];
        if(isset($logout_id)){
            $status = "Offline now";
            $stmt = $conn->prepare("UPDATE users SET status = :STATUS WHERE unique_id = {$logout_id}");
            $stmt->bindParam(":STATUS", $status);
            $stmt->Execute();

            if($stmt){
                session_unset();
                session_destroy();
                header("location: ../login.php");
            }
            
        }else{
            header("location: ../users.php");
        }
    }else{
        header("location: ../login.php");
    }

?>