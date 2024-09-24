<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$s = json_decode(file_get_contents('php://input')); //รับ
$conn = new mysqli("localhost", "root", "", "appointment");

// WHERE `HN`
$sql_1 = " SELECT * , TIMESTAMPDIFF(year, patient_birthday, now())+1 AS Age ";
$sql_2 = " FROM `patient` 
            INNER JOIN patient_data ON patient.HN = patient_data.HN
            WHERE  TRIM(RIGHT (SUBSTRING_INDEX(patient_address, ' ', 3), 2 )) LIKE '{$s->key}%' ";
           
            
$result = $conn->query($sql_1.$sql_2.";");
// SELECT * FROM `patient` WHERE `patient_name` LIKE '{$s->key}%' OR `patient_lastname` LIKE '{$s->key}%' OR `HN` LIKE '{$s->key}%';";
// echo $sql_1.$sql_2;

$x = $result -> fetch_all(MYSQLI_ASSOC);


$result -> free_result();                                                                               
$sql_3 = ' SELECT TRIM(RIGHT (SUBSTRING_INDEX(`patient_address`, " ", 3), 2 ))AS moo , COUNT(*) AS CNT ' ; // เลือก3 ตัวไปselect ทำcount
$sql_4 = " GROUP BY moo";
$sql_5 = $sql_3 . $sql_2 . $sql_4 ;
//  echo $sql_5;

$result = $conn->query($sql_5);
$x2 = $result -> fetch_all(MYSQLI_ASSOC);
echo json_encode([$x,$x2]);   //ส่งสองตัว

$conn->close();

//where ข้างบน `patient_name` LIKE '{$s->key}%' OR `patient_lastname` LIKE '{$s->key}%' OR `patient`.`HN` LIKE '{$s->key}%' OR `patient_idcard` LIKE '{$s->key}%' 

?>