<?php

    session_start();

    $unique_id_session = $_SESSION['unique_id'];

    if(!isset($unique_id_session)){
        header("location: login.php");
    }

?>
<?php include_once "header.php"; ?>
<body>
    
    <div class="wrapper">

        <section class="users">
            
            <header>

            <?php
                include_once "php/config.php";
                $stmt = $conn->prepare("SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
                $stmt->execute();
                $sql = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $show = $sql[0];
            ?>

                <div class="content">

                    <img src="php/images/<?= $show['img'];?>" alt="profile icon">

                    <div class="details">

                        <span><?= $show['fname'] . " " . $show['lname'];?></span>
                        <p><?= $show['status'];?></p>

                    </div>

                </div>

                <a href="#" class="logout">Logout</a>

            </header>

            <div class="search">

                <span class="text">Select an user to start chat</span>
                <input type="text" placeholder="Enter Name to search...">
                <button><i class="fas fa-search"></i></button>

            </div>

            <div class="users-list">

                

            </div>

        </section>

    </div>


    <script src="assets/js/users.js"></script>
</body>
</html>