<?php session_start();?>
<?php 
 @ini_set('display_errors', '0');
 require_once("connection.php");
 require_once("Include/EncodeDecode.php");
 require_once("Include/SessionTable.php");
 
$_SESSION["ResName"];
$_SESSION["ZoneName"];
$_SESSION["SelectDate"];
$_SESSION["Username"];
$_SESSION["SelectTime"];

if (!$_SESSION["UserID"]){  //check session

	  	Header("Location: index.html"); //ไม่พบผู้ใช้กระโดดกลับไปหน้า login form 

}elseif(!$_SESSION["ResName"]){
        Header("Location: Management.php");

}elseif(!$_SESSION["SelectDate"]){
        echo "<script>alert('กรุณาเลือกวันที่และช่วงเวลา ก่อนเลือกโซนที่นั่ง');history.back();</script>";
    
}else{?>

<!doctype html>
<html lang="en">

<head>
    <?php
      include ('Include/header.php');
	  ?>
</head>

<body>
    <?php
      include ('Include/Menu.php');
	  ?>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        
                       <div class="col-lg-8 col-md-7">
                            <div class="card">
                            <div class="header">
                              <h4 class="title" style="font-family: 'Trirong', serif;">แผนผังร้าน คีรีมันตรา</h4>
                            </div>
                                <br><p id="rcorners2">อาคาร 2 </p>
                            <div class="content table-responsive table-full-width">
                                <div class="canvas">
                                    <div class="main-content">
                                    <table style="width:100%">
                                        <tr><td>แสดงข้อมูลการจองโต๊ะวันที่ : <input type="text" name="GuestName" id="GuestName" class="form-control border-input" value="<?php echo DateThai($_SESSION["SelectDate"]);?>  เวลา : <?php echo $_SESSION["SelectTime"];?>" readonly style="width: 100%; margin-bottom: 10px; text-align: center; background-color: #fffcf5; font-weight: 600;"></td>
                                            <td><a href="MantraPlan.php?ResName=<?php echo $_SESSION["ResName"];?>">
                                            <img src="images/MantraPlan/Button-Back.png" style="width: 80px; float: right; margin-top: 20px;"></a></td></tr></table>
                                    
                                        <?php 
                                            require_once("connection.php");
                                            $max_row = 3;
                                            $loop = 0;
                                            $output = '';
                                            $PathIcon = "images/MantraPlan/TableIcon/";
                                            $sql = "SELECT * FROM (SELECT tablemantraplan.*,bookingres.BKStatus FROM tablemantraplan LEFT JOIN bookingres ON tablemantraplan.TableID = bookingres.TableID WHERE bookingres.DataIn = '$_SESSION[SelectDate]' AND bookingres.TimeRange = '$_SESSION[SelectTime]' AND tablemantraplan.TableZone ='2' AND tablemantraplan.TableGroup ='A'  AND tablemantraplan.ResName ='KeereeMantra' UNION All SELECT tablemantraplan.*,tablemantraplan.TableStatus FROM tablemantraplan LEFT JOIN bookingres ON tablemantraplan.TableID = bookingres.TableID WHERE TableZone ='2' AND TableGroup ='A' AND tablemantraplan.ResName ='KeereeMantra' ) As TBid GROUP BY TBid.TableID";
                                            
                                            $query = mysqli_query($conn,$sql);
	                                        while($result=mysqli_fetch_array($query,MYSQLI_ASSOC))
	                                           {						
                                                if($loop == 0) {
                                                    $tmp = '<tr>';
                                                }
                                                 $tmp .= '<td>';
                                                
                                                include ('Include/QueryTableMantra.php');
                                                
                                                $tmp .= '</td>';
                                                $loop++;

                                                if($loop == $max_row) {
                                                    $tmp .= '</tr>';
                                                    $output = $tmp . $output;
                                                    $loop = 0;
                                                }
                                            }
                                            if($loop > 0) {
                                                for ($i = $loop; $i < $max_row; $i++) { 
                                                    $tmp .= '<td></td>';
                                                }
                                                $output = $tmp . $output;
                                            }?>
                                        
                                        <table width="90%" border="" class="Zone2">
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td>
                                                  <table width="100%" border="0" >
                                            <tr>
                                            
                                            <?php 
                                                $sql = "SELECT * FROM (SELECT tablemantraplan.*,bookingres.BKStatus FROM tablemantraplan LEFT JOIN bookingres ON tablemantraplan.TableID = bookingres.TableID WHERE bookingres.DataIn = '$_SESSION[SelectDate]' AND bookingres.TimeRange = '$_SESSION[SelectTime]' AND tablemantraplan.TableZone ='2' AND tablemantraplan.TableGroup ='B' AND tablemantraplan.ResName ='KeereeMantra' UNION All SELECT tablemantraplan.*,tablemantraplan.TableStatus FROM tablemantraplan LEFT JOIN bookingres ON tablemantraplan.TableID = bookingres.TableID WHERE TableZone ='2' AND TableGroup ='B' AND tablemantraplan.ResName ='KeereeMantra') As TBid GROUP BY TBid.TableID";
                                                
                                                $query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
                                                while($result=mysqli_fetch_array($query,MYSQLI_ASSOC))
	                                               {
                                                    $NewVar = $result["TableNumber"];
                                                    if($rn++ % 5 == 0 && $rn > 1){
                                                        echo '</tr><tr>';
                                                    }
                                                    
                                                    echo '<td>';
                                                    
                                                    include ('Include/QueryTable.php');
                                                    
                                                    echo '</td>';
                                                    ?>
                                                    <?php } ?>
                                                    </tr>
                                                    
                                                </table>
                                                  </td>
                                                <td></td>
                                              </tr>
                                                <tr>
                                                <td style="width:20%; vertical-align: bottom;">
                                                    <table border="0" cellspacing='0' cellpadding='0' style="width: 100% " > 
                                                <?php 
                                                $sql = "SELECT * FROM (SELECT tablemantraplan.*,bookingres.BKStatus FROM tablemantraplan LEFT JOIN bookingres ON tablemantraplan.TableID = bookingres.TableID WHERE bookingres.DataIn = '$_SESSION[SelectDate]' AND bookingres.TimeRange = '$_SESSION[SelectTime]' AND tablemantraplan.TableZone ='2' AND tablemantraplan.TableGroup ='C' AND tablemantraplan.ResName ='KeereeMantra' UNION All SELECT tablemantraplan.*,tablemantraplan.TableStatus FROM tablemantraplan LEFT JOIN bookingres ON tablemantraplan.TableID = bookingres.TableID WHERE TableZone ='2' AND TableGroup ='C' AND tablemantraplan.ResName ='KeereeMantra') As TBid GROUP BY TBid.TableID";
                                                
                                                $query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
                                                while($result=mysqli_fetch_array($query,MYSQLI_ASSOC))
	                                               {
                                                    $NewVar = $result["TableNumber"];
                                                    if($rn++ % 1 == 0 && $rn > 1){
                                                        echo '</tr><tr>';
                                                    }
                                                    
                                                    echo '<td>';
                                                    
                                                    include ('Include/QueryTable.php');
                                                    
                                                    echo '</td>';
                                                    ?>
                                                    <?php } ?>
                                         
                                                </table>
                                                    </td>
                                                <td>
                                                <table border="0" cellspacing='0' cellpadding='0' style="width: 100%" class="Zone2">
                                                        <?php echo $output; ?></table>
                                                  </td>
                                                <td style="width:15%"></td>
                                              </tr>
                                              <tr>
                                                <td colspan="3"></td>
                                              </tr>
                                            </table>
                                            <img src="<?php echo $PathIcon;?>TableStatus.png" style="width: 100%; padding-top:20px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                         <?php
                            include ('SelectMenu.php');
	                       ?>
                    </div>
                </div>
            </div>

        <?php
      include ('Include/footer.php');
	  ?>
<?php
      include ('Include/GetGuest.php');
	  ?>
</html>
<?php }
?>
 <?php
mysqli_close($conn);
?>
