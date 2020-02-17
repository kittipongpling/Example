
<?php
//fetch.php
require_once("connection.php");
require_once("Include/EncodeDecode.php");
$column = array("guest.GuestID", "guest.GuestCompany", "guest.GuestName", "guest.GuestTel","guest.TimeIn");
$query = "
 SELECT * FROM guest 
 INNER JOIN bookingres 
 ON guest.GuestID = bookingres.GuestID WHERE ";

//ดึงข้อมูลตามวันที่ปัจจุบัน
if(isset($_POST["is_category"]) == '')
{
 $query .= 'guest.DataIn = DATE_FORMAT(NOW(),"%Y-%m-%d") AND';
}

if(isset($_POST["is_category"]))
{
 $query .= 'guest.DataIn = "'.$_POST["SelectDate"].'" AND bookingres.ResName = "'.$_POST["is_category"].'" AND ';
}

if(isset($_POST["search"]["value"]))
{
 $query .= '(guest.GuestID LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR guest.GuestCompany LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR guest.GuestName LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR guest.GuestTel LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR guest.TimeIn LIKE "%'.$_POST["search"]["value"].'%") ';
}

if(isset($_POST["order"]))
{
 $query .= 'GROUP BY guest.GuestID ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'GROUP BY guest.GuestID ORDER BY guest.TimeIn ASC ';
}

$query1 = '';
if($_POST["length"] != 1)
{
 $query1 .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($conn, $query));
$result = mysqli_query($conn, $query . $query1);

$data = array();

$item = 1;
while($row = mysqli_fetch_array($result))
{
 $sub_array = array();
 $sub_array[] = $_POST['start']+$item;
 $sub_array[] = mb_substr(strip_tags($row["GuestCompany"]), 0, 15, "UTF-8") . '...';
 $sub_array[] = $row["GuestName"];
 $sub_array[] = $row["GuestTel"];
 $sub_array[] = DateThai($row["DataIn"]).'<br>'.'เวลา :'.$row["TimeIn"].' น.';
            
        if($row["GuestStatus"] == '1') {
         $sub_array[] = '<button id="UpST" class="btn btn-success btn-fill" data-id="'.$row["GuestID"].'>">รอการยืนยัน</button>';
        }elseif($row["GuestStatus"] == '2'){
         $sub_array[] = '<button class="btn btn-danger btn-fill">ยืนยันแล้ว</button>';
        }else{
         $sub_array[] = '<button class="btn btn-danger btn-fill">ยืนยันแล้ว</button></td>';
        };
    
 $sub_array[] = '<a target ="_blank" id="Print" href=PrintGuest.php?GuestID='.base64url_encode($row["GuestID"]).' style="color:#000000">
                 <i class="ti-printer" style="font-size: 1.3em;"></i></a>&emsp;
    
                 <a data-toggle="modal" data-target="#view-modal" id="getPro" data-id='.$row["GuestID"].' 
                 href="javascript:void(0)" style="color:#000000"><i class="ti-search" style="font-size: 1.3em;" ></i></a>&emsp;
                 
                 <a data-toggle="modal" id="DeleteGuest" data-id='.base64url_encode($row["GuestID"]).' 
                 href="javascript:void(0)" style="color:#000000"><i class="ti-eraser" style="font-size: 1.3em;" ></i></a>&emsp;</td>';
                   
 $data[] = $sub_array;
 $item++;
    
}

function get_all_data($conn)
{
 $query = "SELECT * FROM tablemantraplan INNER JOIN bookingres ON  tablemantraplan.TableID = bookingres.TableID INNER JOIN guest ON guest.GuestID=bookingres.GuestID GROUP BY guest.GuestID ";
 $result = mysqli_query($conn, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($conn),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>

