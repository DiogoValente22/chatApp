<?php

    //This code repeat on 'chatUsers.php' and 'user_search.php', so this file was created to include in the other files
    while($sql = $stmt->fetchAll(PDO::FETCH_ASSOC)){

        /* there's a error to show last message chat  - i will fix this later

        //count rows query
        $stmt_count2 = $conn->prepare("SELECT count(*) FROM messages");
        $stmt_count2->execute();
        $result_count2 = $stmt_count2->fetchAll(PDO::FETCH_ASSOC);
        $rows_number2 = $result_count2[0]['count(*)'];

        //get last message - 
        foreach($sql as $row){
            
            $stmt2 = $conn->prepare("SELECT * FROM messages WHERE (outgoing_msg_id = {$row['unique_id']}) ORDER BY msg_id DESC LIMIT 1");
            var_dump($row['unique_id']);
            // OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id}
            // OR outgoing_msg_id = {$outgoing_id})
            $stmt2->execute();
            $sql2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
            var_dump($sql2);
        }
        if($rows_number2 > 0){
            foreach ($sql2 as $row2){
                echo "vai se fuderr";
                $result = $row2['msg'];
            }
        }else{
            $result = "No message available";
        }

        (strlen($result) > 28) ? $msg = substr($result, 0, 28) : $msg = $result;
        ($outgoing_id == $row2['outgoing_msg_id]) ? $you = "You: " : $you = "";
        */

        //<p>'. $you . $msg .'</p>

        foreach ($sql as $row){

            //check user is online or offline
            ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";

            $output .= '
            <a href="chat.php?user_id='.$row['unique_id'].'">
            <div class="content">
            <img src="php/images/'. $row['img'] .'" alt="">
            <div class="details">
            <span>'. $row['fname'] . " " . $row['lname'] .'</span>
            <p></p>
            </div>
            </div>
            <div class="status-dot '.$offline.'"><i class="fas fa-circle"></i>
            </div>
            </a>
        ';
        }
    }

?>