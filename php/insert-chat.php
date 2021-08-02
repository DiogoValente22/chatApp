<?php

    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_id = $_POST['outgoing_id'];
        $incoming_id = $_POST['incoming_id'];
        $message = $_POST['message'];

        if(!empty($message)){
            $stmt = $conn->prepare("INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg) VALUES (:INCOMING_MSG_ID, :OUTGOING_MSG_ID, :MSG)") or die();
            $stmt->bindParam(":INCOMING_MSG_ID", $incoming_id);
            $stmt->bindParam(":OUTGOING_MSG_ID", $outgoing_id);
            $stmt->bindParam(":MSG", $message);

            $stmt->execute();
        }
    }else {
        header("../login.php");
    }

?>