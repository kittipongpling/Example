<?php
require_once("connection.php");

    if($_POST["editval"]== '108' or $_POST["editval"]== '109' or $_POST["editval"]== '110' or $_POST["editval"]== '111' or $_POST["editval"]== '112'){
        
        $test=$_POST["editval"]+1;
        $sql2 = "UPDATE bookingres SET " . $_POST["column"] . " = '".$test."' WHERE BookingID = '".$_POST["BookingID"]."' ";
	    $query2 = mysqli_query($conn,$sql2) or die(mysqli_error($conn));
    
    }else{
        $test=$_POST["editval"];
        $sql2 = "UPDATE bookingres SET " . $_POST["column"] . " = '".$test."' WHERE BookingID = '".$_POST["BookingID"]."' ";
	    $query2 = mysqli_query($conn,$sql2) or die(mysqli_error($conn));
    }
?>