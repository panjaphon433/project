<?php
session_start();
// echo $_SESSION ["check"];
// else if ($_SESSION["admin_position"] != "แพทย์" ) {
//   header("location:../admin/patient_his.php");
//   exit();
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าหลัก</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- <style>
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>     -->
    
</head>
<body>




<nav class="navbar navbar-expand-lg navbar-dark "style="background-color: #333a73; font-size:1.2rem;"> 
    <!-- <nav style="background-color: #e3f2fd #333A73;" ></nav> สีพื้นหลังแบบนี้ก็ได้ -->
        <div class="container-fluid">
            <!-- โลโก้รูปภาพ -->
            <a class="navbar-brand" href="#">
                <img src="/appoint-project/admin/images/panm.png" alt="โรงพยาบาลส่งเสริมสุขภาพตำบลแม่กา" height="40">
                <b>โรงพยาบาลส่งเสริมสุขภาพตำบลแม่กา</b>
            </a>
            <!-- ปุ่มเมนูสำหรับแสดงหรือซ่อนเมนูในแบบ mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- เมนู -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                
                                
                </ul>
            </div>
        </div>
    </nav>
    
  <div class="container">
    <div class="px-4 py-5 my-5 text-center">
    <img class="d-block mx-auto mb-4" src="/appoint-project/admin/images/panm.png" alt="" width="150" height="150">
    <h1 class="display-5 fw-bold">WEB NON-COMUNICABLE DISEASES (NCD)</h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">เว็ปแอปพลิเคชั่นสำหรับจัดการข้อมูลผู้ป่วยโรคติดต่อไม่เรื้อรัง <br>Information on patients whih chronic non-communicable diseases</p>
    </div>
    <a href="adminlogin.php" class="btn btn-outline-primary">เข้าสู่ระบบ</a>
  </div>
  </div>


  <footer class="footer mt-auto py-2 bg-light">
  <div class="container text-left">
    <span class="text-muted">สำหรับ นัดหมายผู้ป่วยโรงพยาบาลส่งเสริมสุขภาพตำบลแม่กา</span>
  </div>
</footer>
 
  
    
</body>
</html>