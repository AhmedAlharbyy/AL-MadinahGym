<?php

if(isset($_GET['get_id'])){
    $get_id = $_GET['get_id'];
 }else{
    $get_id = '';
    header('location:view_gym_for_control.php');
 }
include '../components/connect.php';
$update_gym = $conn->prepare("UPDATE `gym_dscr` SET  states = ? WHERE id = ?");
$update_gym->execute(['accepted', $get_id]);
header('location:dashboard.php');
 
?>