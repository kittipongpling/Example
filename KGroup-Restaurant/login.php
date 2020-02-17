<head>
	<?php
    session_start();
      include ('Include/header.php');
	  ?>
    
</head>
<?php 
require_once("connection.php");
if(isset($_POST['Login'])){
	$username = trim($_POST['Username']);
	$password = trim($_POST['Password']);
    
	$sql="SELECT * FROM user Where 1";
    $result = mysqli_query($conn,$sql)or die("Error: " . mysqli_error($conn));
    // echo "<pre>"
    // print_r($result)
    // echo "</pre>"
	if(mysqli_num_rows($result)==1){
		$row = mysqli_fetch_array($result);
        
		if(password_verify($password,$row['Password'])){
            
                $_SESSION["UserID"] = $row["ID"];
                $_SESSION["Username"] = $row["Username"];
                $_SESSION["User"] = $row["Firstname"]." ".$row["Lastname"];
                $_SESSION["Userlevel"] = $row["Userlevel"];
			
                if($_SESSION["Userlevel"]=="Admin"){ //ถ้าเป็น admin ให้กระโดดไปหน้า admin_page.php
                        Header("Location: Management.php");
                }
                
                if ($_SESSION["Userlevel"]=="Editor"){  //ถ้าเป็น member ให้กระโดดไปหน้า user_page.php
                        Header("Location: Management.php");
                }

		}else{ ?>   
                        <script type="text/javascript">
                                        if(!alertify.showSuccess){
                                            alertify.dialog('showSuccess',function factory(){
                                                return{
                                                    build:function(){
                                                    var errorHeader = '<span class="fa fa-times-circle fa-2x" '
                                                    +    'style="vertical-align:middle;color:#e10000;">'
                                                    + '</span>&nbsp;&nbsp; เกิดข้อผิดพลาด';
                                                    this.setHeader(errorHeader);
                                                                    }
                                                    };
                                                },true,'alert');
                                        }
                                        alertify.defaults.theme.ok = "btn btn-primary";
                                        $(function(){alertify.showSuccess(' Username หรือ Password ไม่ถูกต้อง<br/><br/>',
                                                function (e) {
                                                if (e) {
                                                window.location.href='index.html';
                                                } else {
                                                return false;
                                                }
                                            });
                                        });
                        </script>
<?php   }
	    }else{ ?> 
                     <script type="text/javascript">
                                        if(!alertify.showSuccess){
                                            alertify.dialog('showSuccess',function factory(){
                                                return{
                                                    build:function(){
                                                    var errorHeader = '<span class="fa fa-times-circle fa-2x" '
                                                    +    'style="vertical-align:middle;color:#e10000;">'
                                                    + '</span>&nbsp;&nbsp; เกิดข้อผิดพลาด';
                                                    this.setHeader(errorHeader);
                                                                    }
                                                    };
                                                },true,'alert');
                                        }
                                        alertify.defaults.theme.ok = "btn btn-primary";
                                            $(function(){alertify.showSuccess('ไม่มีชื่อผู้ใช้นี้ในระบบปรดตรวจสอบ Username หรือ Password อีกครั้ง<br/><br/>',
                                                function (e) {
                                                if (e) {
                                                window.location.href='index.html';
                                                } else {
                                                return false;
                                                }
                                            });
                                        });
                        </script>
<?php   }
}   
?>
