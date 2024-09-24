<?php
session_start();
?>
<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$s = json_decode(file_get_contents('php://input')); //รับ
$conn = new mysqli("localhost", "root", "", "appointment");


$sql = "SELECT  admin_username, 
                admin_password,
                admin_position,
                idadmin	
        FROM `admin` 
        WHERE  `admin_username` LIKE '{$s->admin_username}' AND `admin_password` LIKE '{$s->admin_password}' ;";
         //echo $sql;
         
$result = $conn->query($sql);
$row_cnt = $result->num_rows;  // เช็ค จำนวน  row oop

if ($row_cnt == 1) { // ถ้า=1 คือมีข้อมูล 1 record 
  $x = $result -> fetch_all(MYSQLI_ASSOC); //var_dump($x);
  $_SESSION["check"] = $x[0]["idadmin"]; 
  $_SESSION["check_position"] =$x[0]["admin_position"];
    echo json_encode(1);
  } else {
    echo json_encode(0);
  }
  // echo  $_SESSION["check"];
  // echo  $_SESSION["check_position"];
$conn->close();
//INNER JOIN `disease`ON patient_history.iddisease= disease.iddisease

?>