<?php
include 'config.php';

$user_id = $_GET['id'];

$sql = "DELETE FROM user WHERE user_id = {$user_id}";
$result = mysqli_query($conn, $sql) or die("Query Unsuccessful!");

if($result){
    header("Location: {$hostname}/admin/users.php");
}

?>