<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$s = json_decode(file_get_contents('php://input')); //รับ
$conn = new mysqli("localhost", "root", "", "appointment");
// $month = substr($s->month,5,2);
// echo $month;
// echo $s->month;


//if(($s->key) == NULL ){ echo "a";} else {echo $s->key ;}
//if(($s->date) == NULL){ echo "b";} else {echo $s->date ;}

//var_dump($s); เช็ค ตัวแปร 
$sql_1 = "SELECT  appointment.idappointment, 
                patient.HN, 
                patient.patient_name, 
                patient.patient_lastname, 
                patient.patient_phone, 
                appointment.appointment_date, 
                appointment_time.time_name,      
                appointment_reason.reason_name, 
                appointment_status.status_name,
                appointment.appointment_time,
                appointment.status,
                appointment.appointment_reason";

$sql_2 =        " FROM `appointment`
                INNER JOIN `patient`ON appointment.HN=patient.HN 
                LEFT JOIN `appointment_time`ON appointment.appointment_time=appointment_time.id_time 
                LEFT JOIN `appointment_reason`ON appointment.appointment_reason=appointment_reason.idreason
                LEFT JOIN `appointment_status`ON appointment.status=appointment_status.idstatus";
                //  ORDER BY  appointment.appointment_date DESC;";
                // if(($s->key) != NULL){
                //     $w1 = "(patient.HN LIKE '{$s->key}%' OR `patient_name` LIKE '{$s->key}%' OR `patient_idcard` LIKE '{$s->key}%' )";
                // }else{
                //     $w1 = 1;
                // }
                if(($s->month) != NULL){
                    $w1 = "(appointment_date LIKE '{$s->month}%')";
                }else{$w1 =1;}
                if(($s->date) != NULL){
                    $w2 = "(appointment_date = '{$s->date}')";
                }else{$w2 =1;}
                // if(($s->status) != NULL){ ใช้ทุกค่าที่มี null ก็ใช้ 
                    $w3 = "(status = '{$s->status}')";
                // }else{
                //     $w3 = '(status = "")';} 
                if(($s->time) != NULL){
                    $w4 = "(appointment_time = '{$s->time}')";
                }else{$w4 = 1;}
                $where = " WHERE " .$w1 . " AND " . $w2 . " AND " . $w3 . " AND " . $w4 ;
                $sql_2 .= $where; 

                
                // echo $sql_1; 
                // echo $sql_2;
        
$result = $conn->query($sql_1.$sql_2);
$x = $result -> fetch_all(MYSQLI_ASSOC);


// echo json_encode($x);   
$result -> free_result();                                                                               
$sql_3 = " SELECT  appointment.appointment_date, appointment_status.status_name, COUNT(*) AS CNT " ; // เลือก3 ตัวไปselect ทำcount
$sql_4 = " GROUP BY appointment.appointment_date, appointment_status.status_name " ;
$sql_5 = $sql_3 . $sql_2 . $sql_4 ;
// echo $sql_5;
$result = $conn->query($sql_5);
$x2 = $result -> fetch_all(MYSQLI_ASSOC);
// date 
$sql_3 = ' SELECT TRIM(RIGHT (SUBSTRING_INDEX(`appointment_date`, "-", 2), 2 ))AS Month , COUNT(*) AS CNT ' ; // เลือก3 ตัวไปselect ทำcount
$sql_4 = " GROUP BY Month " ;
$sql_5 = $sql_3 . $sql_2 . $sql_4 ;
$result = $conn->query($sql_5);
$x3 = $result -> fetch_all(MYSQLI_ASSOC);
 //echo $sql_5;
echo json_encode([$x,$x2,$x3]);   //ส่งสองตัว
$conn->close();


?>