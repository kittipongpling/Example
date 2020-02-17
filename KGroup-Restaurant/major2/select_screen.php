<?php session_start();
$_SESSION["c_id"]=$_GET["c_id"];
$_SESSION["s_id"]=$_GET["s_id"];
?>
<script>window.location="select_chair.php";</script>