<?php
    $Password = $_GET['Password'];
    $Hashing = password_hash($Password, PASSWORD_DEFAULT);
?>