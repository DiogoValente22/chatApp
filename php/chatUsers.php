<?php

    session_start();
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];

    //count rows query
    $stmt_count = $conn->prepare("SELECT count(*) FROM users");
    $stmt_count->execute();
    $result_count = $stmt_count->fetchAll(PDO::FETCH_ASSOC);
    $rows_number = $result_count[0]['count(*)'];

    //query to select all data from users
    $stmt = $conn->prepare("SELECT * FROM users WHERE NOT unique_id = {$outgoing_id}");
    $stmt->execute();
    
    $output = "";

    if($rows_number == 1){
        $output = "No users are available to chat";
    }elseif($rows_number > 0){
        include "data.php";
    }

    echo $output;

?>