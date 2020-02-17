<?php
session_start();
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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_movie = 10;
$pageNum_movie = 0;
if (isset($_GET['pageNum_movie'])) {
  $pageNum_movie = $_GET['pageNum_movie'];
}
$startRow_movie = $pageNum_movie * $maxRows_movie;


$query_movie = "SELECT * FROM movie";
$query_limit_movie = sprintf("%s LIMIT %d, %d", $query_movie, $startRow_movie, $maxRows_movie);
$movie = mysqli_query($conn, $query_limit_movie) or die(mysqli_error($conn));
$row_movie = mysqli_fetch_assoc($movie);

if (isset($_GET['totalRows_movie'])) {
  $totalRows_movie = $_GET['totalRows_movie'];
} else {
  $all_movie = mysql_query($query_movie);
  $totalRows_movie = mysql_num_rows($all_movie);
}
$totalPages_movie = ceil($totalRows_movie/$maxRows_movie)-1;

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
<?php 
if($_SESSION['product']){
unset($_SESSION['price']);
unset($_SESSION['linener']);
unset($_SESSION['product']);
}
?>
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
                <td><a href="select_time.php?m_id=<?php echo $row_movie['m_id']; ?>"><img src="<?php echo $row_movie['pic']; ?>" width="301" height="253" /></a></td>
              </tr>
            </table></td>
            	<?php if($i%2==0){?>
          </tr>
          	<?php } ?>
	<?php
$i++;
?>
          <?php } while ($row_movie = mysqli_fetch_assoc($movie)); ?>
    </table>
    <p>&nbsp;    
    <table border="0">
      <tr>
        <td><?php if ($pageNum_movie > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_movie=%d%s", $currentPage, 0, $queryString_movie); ?>"><img src="img/First.gif" /></a>
            <?php } // Show if not first page ?></td>
        <td><?php if ($pageNum_movie > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_movie=%d%s", $currentPage, max(0, $pageNum_movie - 1), $queryString_movie); ?>"><img src="img/Previous.gif" /></a>
            <?php } // Show if not first page ?></td>
        <td><?php if ($pageNum_movie < $totalPages_movie) { // Show if not last page ?>
            <a href="<?php printf("%s?pageNum_movie=%d%s", $currentPage, min($totalPages_movie, $pageNum_movie + 1), $queryString_movie); ?>"><img src="img/Next.gif" /></a>
            <?php } // Show if not last page ?></td>
        <td><?php if ($pageNum_movie < $totalPages_movie) { // Show if not last page ?>
            <a href="<?php printf("%s?pageNum_movie=%d%s", $currentPage, $totalPages_movie, $queryString_movie); ?>"><img src="img/Last.gif" /></a>
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
mysqli_free_result($movie);
?>
