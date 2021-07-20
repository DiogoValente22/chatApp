<?php

    $conn = mysqli_connect("localhost", "root", "", "testekkk");
    if(!$conn){
        echo "Database not connected" . mysqli_connect_error();
    }

?>