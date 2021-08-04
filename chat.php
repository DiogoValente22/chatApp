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
        <section class="chat-area">
            <header>
                <?php
                    include_once "php/config.php";
                    $user_id = $_GET['user_id'];
                    $stmt = $conn->prepare("SELECT * FROM users WHERE unique_id = {$user_id}");
                    $stmt->execute();
                    $sql = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $show = $sql[0];
                ?>
                <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img src="php/images/<?= $show['img'];?>" alt="">
                <div class="details">
                    <span><?= $show['fname'] . " " . $show['lname'];?></span>
                    <p><?= $show['status'];?></p>
                </div>
            </header>

            <div class="chat-box">
                
            </div>
            <form action="#" class="typing-area" autocomplete="off"> 
                <input type="text" name="outgoing_id" value="<?= $_SESSION['unique_id'];?>" hidden>
                <input type="text" name="incoming_id" value="<?= $user_id?>" hidden>
                <input type="text" name="message" class="input-field" placeholder="Type a message here...">
                <button><i class="fab fa-telegram-plane"></i></button>
            </form>
        </section>
    </div>

    <script src="assets/js/chat.js"></script>

</body>
</html>