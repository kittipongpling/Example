<?php 
session_start();
$_SESSION["m_id"]=$_GET["m_id"];
require_once('Connections/conn.php'); ?>

<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_movie = 10;
$pageNum_movie = 0;
if (isset($_GET['pageNum_movie'])) {
  $pageNum_movie = $_GET['pageNum_movie'];
}
$startRow_movie = $pageNum_movie * $maxRows_movie;

$colname_movie = "-1";
if (isset($_GET['m_id'])) {
  $colname_movie = $_GET['m_id'];
}

$query_movie = sprintf("SELECT * FROM movie WHERE m_id = %s", GetSQLValueString($colname_movie, "int"));
$query_limit_movie = sprintf("%s LIMIT %d, %d", $query_movie, $startRow_movie, $maxRows_movie);
$movie = mysqli_query($conn, $query_limit_movie) or die(mysqli_error($conn));
$row_movie = mysqli_fetch_assoc($movie);

if (isset($_GET['totalRows_movie'])) {
  $totalRows_movie = $_GET['totalRows_movie'];
} else {
  $all_movie = mysqli_query($conn, $query_movie);
  $totalRows_movie = mysqli_num_rows($all_movie);
}
$totalPages_movie = ceil($totalRows_movie/$maxRows_movie)-1;

$maxRows_intime = 10;
$pageNum_intime = 0;
if (isset($_GET['pageNum_intime'])) {
  $pageNum_intime = $_GET['pageNum_intime'];
}
$startRow_intime = $pageNum_intime * $maxRows_intime;


$query_intime = "SELECT * FROM screen sn , cinema cn WHERE sn.m_id='$_GET[m_id]' and sn.c_id=cn.c_id";
$query_limit_intime = sprintf("%s LIMIT %d, %d", $query_intime, $startRow_intime, $maxRows_intime);
$intime = mysqli_query($conn, $query_limit_intime) or die(mysqli_error($conn));
$row_intime = mysqli_fetch_assoc($intime);

if (isset($_GET['totalRows_intime'])) {
  $totalRows_intime = $_GET['totalRows_intime'];
} else {
  $all_intime = mysqli_query($conn, $query_intime);
  $totalRows_intime = mysqli_num_rows($all_intime);
}
$totalPages_intime = ceil($totalRows_intime/$maxRows_intime)-1;

$queryString_intime = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_intime") == false && 
        stristr($param, "totalRows_intime") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_intime = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_intime = sprintf("&totalRows_intime=%d%s", $totalRows_intime, $queryString_intime);

$queryString_movie = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_movie") == false && 
        stristr($param, "totalRows_movie") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_movie = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_movie = sprintf("&totalRows_movie=%d%s", $totalRows_movie, $queryString_movie);
?>
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
    <td height="500" valign="top" bgcolor="#FFFFFF">&nbsp;
      <br />
      <table border="0" align="center" cellpadding="0" cellspacing="0">
             <?php  $i=1;?>
  <?php do { ?>
                  <?php if($i%2==1){?>
          <tr>
             <?php } ?>
            <td width="153"><table width="350" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="340"><?php echo $row_movie['title']; ?></td>
              </tr>
              <tr>
                <td><img src="<?php echo $row_movie['pic']; ?>" width="301" height="253" /></td>
              </tr>
            </table></td>
            	<?php if($i%2==0){?>
          </tr>
          	<?php } ?>
	<?
$i++;
?>
          <?php } while ($row_movie = mysqli_fetch_assoc($movie)); ?>
    </table>
    <p>&nbsp;    
    เวลาฉาย    
    <p> </p>
    <table border="1" align="center">
      <tr>
        <td width="89">วันที่ฉาย</td>
        <td width="108">เวลาฉาย</td>
        </tr>
      <?php do { ?>
        <? 
		$date=date("Y-m-d");
		$times=date("H-i-s");
		if($date<=$row_intime['date']){?>
          <tr>
          <td><?php echo $row_intime['date']; ?></td>
          <td><a href="select_screen.php?s_id=<?php echo $row_intime['s_id']; ?>&amp;c_id=<?php echo $row_intime['c_id']; ?>"><?php echo $row_intime['time']; ?></a></td>
          <? }else{?>
        <? if($times<=$row_intime['time'] and $date<=$row_intime['date']){?>
        <tr>
          <? }else{?>
          <? }}?>
        </tr>
        <?php } while ($row_intime = mysqli_fetch_assoc($intime)); ?>
    </table>
    <p>&nbsp;
    <table border="0">
      <tr>
        <td><?php if ($pageNum_intime > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_intime=%d%s", $currentPage, 0, $queryString_intime); ?>"><img src="img/First.gif" /></a>
            <?php } // Show if not first page ?></td>
        <td><?php if ($pageNum_intime > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_intime=%d%s", $currentPage, max(0, $pageNum_intime - 1), $queryString_intime); ?>"><img src="img/Previous.gif" /></a>
            <?php } // Show if not first page ?></td>
        <td><?php if ($pageNum_intime < $totalPages_intime) { // Show if not last page ?>
            <a href="<?php printf("%s?pageNum_intime=%d%s", $currentPage, min($totalPages_intime, $pageNum_intime + 1), $queryString_intime); ?>"><img src="img/Next.gif" /></a>
            <?php } // Show if not last page ?></td>
        <td><?php if ($pageNum_intime < $totalPages_intime) { // Show if not last page ?>
            <a href="<?php printf("%s?pageNum_intime=%d%s", $currentPage, $totalPages_intime, $queryString_intime); ?>"><img src="img/Last.gif" /></a>
            <?php } // Show if not last page ?></td>
      </tr>
    </table>
    </p></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">Design By Webmaster</td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($intime);

mysql_free_result($movie);
?>
