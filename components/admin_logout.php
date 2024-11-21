<?php

   include 'connect.php';

   setcookie('id', '', time() - 1, '/');

   header('location:../admin/login.php');

?>