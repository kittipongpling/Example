<?php
session_start();
$_SESSION['linener']=$_SESSION['linener']+1;
$_SESSION['product'][$_SESSION['linener']]=$_GET["name"];
$_SESSION['price'][$_SESSION['linener']]=$_GET["price"];
?>
<script>window.location="select_chair.php";</script>