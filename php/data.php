<?php

    //This code repeat on 'chatUsers.php' and 'user_search.php', so this file was created to include in the other files
    while($sql = $stmt->fetchAll(PDO::FETCH_ASSOC)){
        foreach ($sql as $row){
            $output .= '
            <a href="chat.php?user_id='.$row['unique_id'].'">
            <div class="content">
            <img src="php/images/'. $row['img'] .'" alt="">
            <div class="details">
            <span>'. $row['fname'] . " " . $row['lname'] .'</span>
            <p>this is test messagee</p>
            </div>
            </div>
            <div class="status-dot"><i class="fas fa-circle"></i>
            </div>
            </a>
        ';
        }
    }

?>