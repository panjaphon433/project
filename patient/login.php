<?php
session_start();
?>
<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$s = json_decode(file_get_contents('php://input')); //รับ
$conn = new mysqli("localhost", "root", "", "appointment");


$sql = "SELECT  
                HN,
                patient_idcard, 
                patient_password	,
                patient_name
        FROM `patient` 
        WHERE  `patient_idcard` LIKE '{$s->patient_idcard}' AND `patient_password` LIKE '{$s->patient_password}' ;";
         //echo $sql;
         
$result = $conn->query($sql);
$row_cnt = $result->num_rows;  // เช็ค จำนวน  row oop

if ($row_cnt == 1) { // ถ้า=1 คือมีข้อมูล 1 record 
  $x = $result -> fetch_all(MYSQLI_ASSOC); //var_dump($x);
  $_SESSION["check"] = $x[0]["HN"]; 
  $_SESSION["name"] = $x[0]["patient_name"]; 
  //echo  $_SESSION["check"] ;
  echo json_encode(1);
  // header('Location: appoint.php');
  } else {
    echo json_encode(0);
  }
$conn->close();
//INNER JOIN `disease`ON patient_history.iddisease= disease.iddisease

?>