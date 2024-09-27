<?php
error_reporting(0);
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$x = json_decode(file_get_contents('php://input'));

$conn = new mysqli("localhost", "root", "", "appointment");

$sql = "INSERT INTO `patient_history` 
                   ( `HN`, 
                   `idadmin`,
                   `iddisease`, 
                   `date_treatment`, 
                   `detail`,
                   `record_time`,
                   `weight`,
                   `height`,
                   `bps`,
                   `bpd`,
                   `p`,
                   `waistline`)
        VALUES    (
                    '{$x->HN}', 
                    '{$x->idadmin}', 
                    '{$x->iddisease}', 
                    '{$x->date_treatment2}', 
                    '{$x->detail}',
                    CURRENT_TIMESTAMP(),
                    '{$x->weight}',
                    '{$x->height}',
                    '{$x->bps}',
                    '{$x->bpd}',
                    '{$x->p}',
                    '{$x->waistline}'  

                    
                  )";
       
// echo $sql;
 $result = $conn->query($sql);
// if(($x->idallergy) != NULL ){
// $sql2 = "INSERT INTO `patient_allergy`     
//             (
//               HN, 
//             allergy_name
//             ) 
//           VALUES    
//           ( 
//             '{$x->HN}', 
//             '{$x->idallergy}'
//           )";}
          //echo $sql2;
// $result = $conn->query($sql2);

if ($result === TRUE) {
    echo json_encode(1);
  } else {
    echo json_encode(0);
  }
   
$conn->close();

?>