<?php
session_start();
$outgoing_id = $_SESSION['unique_id'];
include_once "config.php";
$searchTerm = $_POST['searchTerm'];
$output = "";

$stmt = $conn->prepare("SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} AND (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%')");
$stmt->execute();
$sql = $stmt->fetchAll(PDO::FETCH_ASSOC);

if($sql){
    include "data.php";
}else{
    $output .= "No user found";
}
echo $output;

?>