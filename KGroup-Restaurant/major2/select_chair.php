<?php session_start();
 @ini_set('display_errors', '0');
?>
<?php 
require_once('Connections/conn.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
body {
	background-color: #000;
	text-align: center;
}
td {
	text-align: center;
}
table {
	text-align: center;
}
</style>
</head>

<body>
<table width="1024" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="img/Untitled-2.jpg" width="1024" height="179" /></td>
  </tr>
  <tr>
    <td height="500" valign="top" bgcolor="#FFFFFF"><p>
    </p>
      <p>
        <?php
    $chair=array("0","A","B","C","D","E","F","G","H","I","J","K");
	$pr=array("0","90","100","101","103","150","200","300","400","500","600","700");
	?>
        <?php for($a=1; $a<=count($chair)-1; $a++){?>
        <?php for($b=1; $b<=20; $b++){?>
        <?php $name="$chair[$a]00$b";?>
        <?php $pp=$pr[$a];?>
        <?php

$query_Recordset1 = "SELECT * FROM orders where seat_name='$name' and c_id='$_SESSION[c_id]' and s_id='$_SESSION[s_id]' and m_id='$_SESSION[m_id]'";
$Recordset1 = mysqli_query($conn, $query_Recordset1) or die(mysqli_error($conn));
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);?>

        <?php if($row_Recordset1 ){?>
        <img src="img/buy.png" width="32" height="32" />
        <?php }else{?>
        <?php if(!isset($_SESSION['product'])){?>
        <a href="order.php?name=<?php echo($name);?>&amp;price=<?php echo($pp);?>"><img src="img/Magenta-Seat-icon.png" width="32" height="32" /></a>
        <?php }else{?>
        <?php if(in_array($name,$_SESSION['product'])){?>
        <img src="img/check.png" width="32" height="32" />
        <?php }else{?>
        <a href="order.php?name=<?php echo($name);?>&amp;price=<?php echo($pp);?>"><img src="img/Magenta-Seat-icon.png" width="32" height="32" /></a>
        <?php }}?>
  <?php }?>
  <?php if($b==20){?>
        <?php echo"<br />";?>
        <?php }?>
        <?php }?>
        <?php }?>
    </p>
    <p>&nbsp;</p>
    <fieldset>
      <legend>รายการ      </legend>
      <?php for($x=1; $x<=$_SESSION['linener']; $x++){?>
      <p><?php if(!$_SESSION['product'][$x]){?><?php }else{?>
        <img src="img/check.png" width="32" height="32" />ที่นั่งที่ <?php echo($_SESSION['product'][$x]);?>
      ราคา <?php echo($_SESSION['price'][$x]);?> <a href="del.php?act=<?php echo($x);?>">x</a>     <?php }?> 
      <p><?php }?>      
      <p>
        
        ราคารวม : 
          <?php if(!isset($_SESSION['product'])){?>
          00.00
          <?php }else{?>
          <?php $sum=array_sum($_SESSION['price']);?>    <?php echo number_format(($sum),2);?>  
          <?php }?>
      <p><a href="pay.php">ชำระเงิน</a></p>
 
    </fieldset></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">Design By Webmaster</td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>

?>
