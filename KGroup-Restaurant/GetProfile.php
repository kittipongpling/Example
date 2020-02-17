<?php session_start();?>
<?php
		 
	require_once("connection.php");
	$_SESSION["SelectDate"];
	if (isset($_REQUEST['id'])) {
			
        $TableID = $_REQUEST['id'];
		$sql = "SELECT *  FROM tablemantraplan INNER JOIN bookingres ON  tablemantraplan.TableID = bookingres.TableID INNER JOIN guest ON guest.GuestID=bookingres.GuestID WHERE bookingres.DataIn = '$_SESSION[SelectDate]' AND bookingres.TimeRange = '$_SESSION[SelectTime]' AND tablemantraplan.TableID ='".$TableID."' ORDER BY tablemantraplan.TableID ASC";
        $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $result = mysqli_fetch_array($query,MYSQLI_ASSOC);
        {?>
        
		<div class="table-responsive">
		<table class="table table-striped table-bordered">
		    <tr>
			    <th style="width: 45%;">หมายเลขโต๊ะ</th>
				<th><?php if ($result["ResName"]=='Loft'){
                            echo $NewVar = (int)substr($result["TableNumber"], 3, 2);
                        }else{ 
                            echo $result["TableNumber"]; 
                        } ?>
                </th>
            </tr>
            <tr>
			    <th>ชื่อบริษัท</th>
				<td><?php echo $result["GuestCompany"]; ?></td>
			</tr>
            <tr>
			    <th>ชื่อ - นามสกุล (ลูกค้า)</th>
				<td><?php echo $result["GuestName"]; ?></td>
			</tr>
			<tr>
				<th>อีเมล</th>
				<td><?php echo $result["GuestEmail"]; ?></td>
			</tr>
			<tr>
				<th>เบอร์โทรติดต่อ / เบอร์โทรสำรอง</th>
				<td><?php echo $result["GuestTel"]; ?> เบอร์โทรสำรอง ( <?php echo $result["GuestTelBackup"]; ?> )</td>
			</tr>
			<tr>
				<th>Line ID</th>
				<td><?php echo $result["GuestLine"]; ?></td>
			</tr>
            <tr>
				<th>วัน เวลาที่เข้าร้าน</th>
				<td>วันที่ : <?php echo DateThai($result["DataIn"]); ?>  เวลา : <?php echo $result["TimeIn"]; ?> น.</td>
			</tr>
            <tr>
				<th>จำนวนลูกค้า</th>
				<td><?php echo $result["GuestNum"]; ?> ท่าน </td>
			</tr>
            <tr>
				<th style="vertical-align: initial;">รายการอาหาร</th>
				<td> <?php if(!empty($result["MenuName1"])){ ?>
                     รายการ 1. <?php echo $result["MenuName1"]; ?><br>
                     รายการ 2. <?php echo $result["MenuName2"]; ?><br>
                     รายการ 3. <?php echo $result["MenuName3"]; ?><br>
                     รายการ 4. <?php echo $result["MenuName4"]; ?><br>
                     รายการ 5. <?php echo $result["MenuName5"]; ?><br>
                     รายการ 6. <?php echo $result["MenuName6"]; ?><br>
                     <?php if(!empty($result["MenuName7"])){ ?>
                     รายการ 7. <?php echo $result["MenuName7"]; ?><br><?php }?>
                     <?php if(!empty($result["MenuName8"])){ ?>
                     รายการ 8. <?php echo $result["MenuName8"]; ?><br><?php }?>
                     <?php if(!empty($result["MenuName9"])){ ?>
                     รายการ 9. <?php echo $result["MenuName9"]; ?><br><?php }?>
                     </br>เพิ่มเติม <?php echo $result["MenuName10"]; ?><br><br>
                <?php } ?>
			</tr>
            <tr>
				<th style="vertical-align: initial;">รายการอาหารอื่นๆ</th>
				<td><?php echo $result["MenuOther"]; ?></td>
			</tr>
            <tr>
				<th>จองเมื่อวันที่</th>
				<td><?php echo DateThai($result["DateRecode"]); ?></td>
			</tr>
		</table>
			
		</div><?php } ?>
		<?php				
	}