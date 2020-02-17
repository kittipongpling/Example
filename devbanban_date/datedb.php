
<?php
print_r($_POST);

echo "<br/>";

$result = $_POST['daterange'];  // value ที่ส่งมา
            $result_explode = explode('-', $result);   // ขั้นด้วย '-
            echo "ds: ". $result_explode[0]."<br />";  // 0 คือค่าก่อน '-'
            echo "de: ". $result_explode[1]."<br />"; // 1 ค่าหลัง '-'
 
//แยกตัวแปรเพื่อเก็บเข้าฐานข้อมูลต่อไป
            /*
            $datestart = $result_explode[0];
            $dateend =$result_explode[1];
            */

?>
<?php
print_r($_POST);
 
echo "<br/>";
 
$result = $_POST['daterange'];  // value ที่ส่งมา
            $result_explode = explode('-', $result);   // ขั้นด้วย '-
            echo "ds: ". $result_explode[0]."<br />";  // 0 คือค่าก่อน '-'
            echo "de: ". $result_explode[1]."<br />"; // 1 ค่าหลัง '-'
 
//แยกตัวแปรเพื่อเก็บเข้าฐานข้อมูลต่อไป
            /*
            $datestart = $result_explode[0];
            $dateend =$result_explode[1];
            */
 
?>