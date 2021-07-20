<?php

    include_once "config.php";

    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){
        //validate email
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
            if(mysqli_num_rows($sql) > 0){
                echo "$email - This email already exist!";
            }else{
                if(isset($_FILES['image'])){
                    $img_name = $_FILES['image']['name']; //getting user upladed img name
                    $img_type = $_FILES['image']['type']; // same but type
                    $tmp_name = $_FILES['image']['tmp_name']; // temporary name is used to save/move file in our folder

                    $img_explode = explode('.', $img_name);
                    $img_ext = end($img_explode);

                    $valid_ext = ['png', 'jpeg', 'jpg'];
                    if(in_array($img_ext, $valid_ext)){
                        $time = time();

                        move_uploaded_file($tmp_name, "folder_name");
                        $status = "Active now";
                        
                    }else{
                        echo "Please select and image file - jpeg, jpg, png";
                    }

                }else{
                    echo "please select an image file!";
                }
            }
        }else{
            echo "$email - This is not a valid email animal";
        }
    }else{
        echo "all input field are required burro estupido";
    }

?>