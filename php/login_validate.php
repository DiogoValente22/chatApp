<?php

    session_start();
    include_once "config.php";

    $email = $_POST['email'];
    $password = $_POST['password'];
    
    if(!empty($email) && !empty($password)){

        if(filter_var($email, FILTER_VALIDATE_EMAIL)){

            $stmt = $conn->prepare("SELECT * FROM users WHERE email = '{$email}' AND password = '{$password}'");
            $stmt->execute();
            $sql = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // check if email and password matched
            if($sql){
                $_SESSION['unique_id'] = $sql[0]['unique_id'];
                echo "success";
            }else{
                echo "Email or Password is incorrect!";
            }

        }else{
            echo "$email - This is not a valid email";
        }

    }else{
        echo "All input fields are required!";
    }

?>