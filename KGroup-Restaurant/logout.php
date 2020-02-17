<?php

session_start();

unset($_SESSION['UserID']);
unset($_SESSION['User']);
unset($_SESSION['Userlevel']);
unset($_SESSION['ResName']);
unset($_SESSION['ZoneName']);
unset($_SESSION['SelectDate']);
unset($_SESSION['SelectTime']);
unset($_SESSION["Username"]);
//unset($_SESSION["shopping_cart"]);  

header("Location: index.html");	
?>