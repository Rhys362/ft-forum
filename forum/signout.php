<?php

include 'header.php';
include 'connect.php';


$old_user = $_SESSION ['signed_in'];

unset($_SESSION['signed_in']);
session_destroy();

echo 'You have signed out successfully. <a href="signin.php">Go back</a>';

?>