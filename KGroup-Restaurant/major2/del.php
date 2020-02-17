<?php
session_start();
$a=$_GET["act"];
unset($_SESSION['product'][$a]);
unset($_SESSION['price'][$a]);
?>
<script>window.location="select_chair.php";</script>