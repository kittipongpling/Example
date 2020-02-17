<?php
session_start();
?>
<?php require_once('Connections/conn.php'); ?>
<?php
for($x=1; $x<=$_SESSION['linener']; $x++){
	if(!$_SESSION['product'][$x]){
	}else{
$query_Recordset1 = "insert into orders set s_id='$_SESSION[s_id]',m_id='$_SESSION[m_id]',c_id='$_SESSION[c_id]',price='".$_SESSION[price][$x]."',seat_name='".$_SESSION[product][$x]."'";
$Recordset1 = mysqli_query($conn, $query_Recordset1) or die(mysqli_error($conn));
}}
unset($_SESSION['product']);
unset($_SESSION['price']);
unset($_SESSION['linener']);
?>
<script>window.location="index.php";</script>

