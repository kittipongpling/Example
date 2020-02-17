<?php
			 
    include ('Include/header.php');
	require_once("connection.php");
	
	if (isset($_REQUEST['id'])) {
        
        $GuestID = $_REQUEST['id'];
        $query = "update guest set GuestStatus='2' where GuestID='$GuestID'";
        $result = mysqli_query($conn, $query);
        
	if ($result) {
			echo "<center><p style='font-size:25px; color:blue;'; ></br>ลบข้อมูลผู้ดูแลระบบเสร็จสิ้น ...</br></br></center>";
		}
        else{
            
            echo "<br><br><p style=text-align:center;>Sorry there was an error. Please try again later</p><br><br>";
    }
}