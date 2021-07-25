<?php
    
    $conn = new PDO("mysql:dbname=bd_chatapp; host=localhost", "root", "");
    if(!$conn){
        echo "Database not connected";
    }
?>