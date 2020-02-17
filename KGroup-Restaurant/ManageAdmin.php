<?php session_start();?>
<?php 
require_once("Include/EncodeDecode.php");
if (!$_SESSION["UserID"]){  //check session

	  	Header("Location: index.html"); //ไม่พบผู้ใช้กระโดดกลับไปหน้า login form 

}else{?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
   
     <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />

	<?php
      include ('Include/header.php');
	  ?>
    
</head>
    <?php
      include ('Include/NewAdmin.php');
	  ?>
<body>
  <?php
      include ('Include/Menu.php');
    ?>
        <div class="content">
            <div class="container-fluid">
               
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Manage Admin</h4>
                            </div>
                            <div class="content">
                                <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                  
                                    <?php 
                                            require_once("connection.php");
                                            $sql = "SELECT * FROM user";
                                            $query = mysqli_query($conn,$sql);
                                        ?>
                                    <form name="frmMain" method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
                                        <input type="hidden" name="hdnCmd" value="">
                                    <thead>
                                    	<th width="15%"><b>Username</b></th>
                                        <th width="15%"><b>รหัสผ่าน</b></th>
                                    	<th width="15%"><b>ชื่อ</b></th>
                                    	<th width="15%"><b>นามสกุล</b></th>
                                    	<th width="15%"><b>เบอร์โทร</b></th>
                                        <th width="15%"><b>สถานะ</b></th>
                                        <th width="15%"><b></b></th>
                                    </thead>
                                    <tbody>
                                         
                                        <?php
                                        while($result=mysqli_fetch_array($query,MYSQLI_ASSOC))
                                        {?>
                                        <tr>
                                            <td><?php echo $result["Username"];?></td>
                                        	<td>********</td>
                                        	<td><?php echo $result["Firstname"];?></td>
                                        	<td><?php echo $result["Lastname"];?></td>
                                            <td><?php echo $result["Tel"];?></td>
                                            <td><?php echo $result["Userlevel"];?></td>
                                            <td><a href="EditAdmin.php?UserID=<?php echo base64url_encode($result["ID"]);?>" style="color:#000000">
                                                <i class="ti-pencil" style="font-size: 1.5em;"></i></a>&nbsp;&nbsp;
                                                
                                                <a class="DeleteAdmin" data-id="<?php echo base64url_encode($result["ID"]);?>" href="javascript:void(0)" style="color:#000000">
                                                <i class="ti-eraser" style="font-size: 1.5em;"></i></a>&nbsp;&nbsp;</td>
                                        </tr>                                                                        
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </form></table>  
                                </div><h4 class="title">เพิ่มข้อมูลผู้ดูแลระบบ</h4></br>
                                <?php
                                    include ('Include/formAdmin.php');
	                               ?>
                            </div>
                        </div>
                </div>
               <?php
      include ('Include/footer.php');
    ?>	
            </div>
 
<script src="js/jquery-1.12-0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootbox.min.js"></script>

<script>
	$(document).ready(function(){
		$('.DeleteAdmin').click(function(e){
			e.preventDefault();
			var pid = $(this).attr('data-id');
			var parent = $(this).parent("td").parent("tr");
			
			bootbox.dialog({
			  message: "<p style='font-size:18px;'; ></br>ยืนยันการลบข้อมูลผู้ดูแลระบบ ?</br></br>",
			  title: "<i class='glyphicon glyphicon-trash'></i> Delete !",
			  buttons: {
				
				danger: {
				  label: "Delete!",
				  className: "btn-danger",
				  callback: function() {
					  
					  $.ajax({
						  type: 'POST',
						  url: 'delete.php',
						  data: 'delete='+pid
					  })
					  .done(function(response){
						  bootbox.alert(response);
						  parent.fadeOut('slow');
					  })
					  .fail(function(){
						  bootbox.alert('Something Went Wrog ....');
					  })
				  }
				},success: {
				  label: "Cancel",
				  className: "btn-success",
				  callback: function() {
					 $('.bootbox').modal('hide');
				  }
			  }
				}
			});
		});
	});
</script>


</html>
    <?php }?>
    <?php
mysqli_close($conn);
?>
