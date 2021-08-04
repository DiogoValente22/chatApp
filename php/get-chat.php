<?php

    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_id = $_POST['outgoing_id'];
        $incoming_id = $_POST['incoming_id'];
        $output = "";

        //count rows query
        $stmt_count = $conn->prepare("SELECT count(*) FROM messages");
        $stmt_count->execute();
        $result_count = $stmt_count->fetchAll(PDO::FETCH_ASSOC);
        $rows_number = $result_count[0]['count(*)'];

        //select query
        $stmt = $conn->prepare(
            "SELECT * FROM messages
             LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
             WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id}) OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id ASC"
        );
        $stmt->execute();
        
        if($rows_number > 0){
            while($sql = $stmt->fetchAll(PDO::FETCH_ASSOC)){
                foreach($sql as $row){
                    if($row['outgoing_msg_id'] === $outgoing_id){ //msg sender
                        $output .= '<div class="chat outgoing">
                                    <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                    </div>
                                    </div>';
                    }else{ // msg receiver 
                        $output .= '<div class="chat incoming">
                                    <img src="php/images/'. $row['img'] .'" alt="">
                                    <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                    </div>
                                    </div>';
                    }
                }
            }
            echo $output;
        }
    }else {
        header("../login.php");
    }

?>