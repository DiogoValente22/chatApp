<?php
    session_start();
    include_once "config.php";

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){
        //validate email
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){

            // SELECT query for database using PDO
            $stmt = $conn->prepare("SELECT email FROM users WHERE email = '{$email}'");
            $stmt->execute();
            $sql = $stmt->fetchAll(PDO::FETCH_ASSOC);

            //check if the email already exists
            if($sql){
                echo "$email - This email already exist!";
            }else{
                if(isset($_FILES['image'])){
                    $img_name = $_FILES['image']['name']; //getting user upladed img name
                    $tmp_name = $_FILES['image']['tmp_name']; // temporary name is used to save/move file in our folder

                    $img_explode = explode('.', $img_name);
                    $img_ext = end($img_explode);
                    
                    $valid_ext = ['png', 'jpeg', 'jpg'];
                    if(in_array($img_ext, $valid_ext)){
                        $time = time();
                        $new_img_name = $time.$img_name;
                        $upload_folder = "images/";
                        $moveFile = move_uploaded_file($tmp_name, $upload_folder.$new_img_name);
                        if($moveFile){
                            $status = "Active now";
                            $random_id = rand(time(), 10000000);

                            $stmt2 = $conn->prepare("INSERT INTO users (unique_id, fname, lname, email, password, img, status) VALUES (:RANDOM_ID, :FNAME, :LNAME, :EMAIL, :PASSWORD, :IMG, :STATUS)");

                            $stmt2->bindParam(":RANDOM_ID", $random_id);
                            $stmt2->bindParam(":FNAME", $fname);
                            $stmt2->bindParam(":LNAME", $lname);
                            $stmt2->bindParam(":EMAIL", $email);
                            $stmt2->bindParam(":PASSWORD", $password);
                            $stmt2->bindParam(":IMG", $new_img_name);
                            $stmt2->bindParam(":STATUS", $status);
                            $stmt2->execute();
                            
                            if($stmt2){

                                $stmt3 = $conn->prepare("SELECT * FROM users WHERE email = '{$email}'");
                                $stmt3->execute();
                                $sql2 = $stmt3->fetchAll(PDO::FETCH_ASSOC);

                                if($sql2){
                                    $_SESSION['unique_id'] = $sql2[0]['unique_id'];
                                    echo "success";
                                }else{
                                    echo "error";
                                }
                            }else{
                                echo "something went wrong";
                            }
                        }   
                        

                    }else{
                        echo "Please select and image file - jpeg, jpg, png";
                    }

                }else{
                    echo "please select an image file!";
                }
            }
        }else{
            echo "$email - This is not a valid email";
        }
    }else{
        echo "All input field are required";
    }

?>