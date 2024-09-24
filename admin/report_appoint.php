<?php
session_start();
// echo $_SESSION ["check"];
if ($_SESSION == NULL) {
  header("location:../adminlogin.php");
  exit();
}
// else if ($_SESSION["admin_position"] != "แพทย์" ) {
//   header("location:../admin/patient_his.php");
//   exit();
// }
?>
<!doctype html>
<html ng-app="patientApp" lang="th">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
  <script src="appoint2.js"></script>
  <title>ประวัติการนัดหมาย</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <style>
    body {
            background-image: url('/appoint-project/admin/images/lio.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh; /* ความสูงเต็มหน้าจอ */
  margin: 0;
        }
        
    .container{
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 50vh;
    }
    .header{
      margin-bottom: 20px;
    }
    .title{
      margin-top: 5px;
      font-weight: bold;
      text-align: center;
    }
    thead{
     text-align: center;
     
    } /* CSS สำหรับการจัดระเบียบฟอร์ม */

    /* CSS สำหรับการปรับรูปแบบฟอร์ม */
    .head-content th{
      background-color: #333a73;
      color: #fff;
    }
    .tbody-content{
      text-align: center;
    }
    .header-content{
      text-align: center;
    }
    .search-patient {
      border: 1px solid #ccc; /* ใส่เส้นขอบ */
      border-radius: 10px; /* ทำมุมขอบโค้ง */
      padding: 5px; /* ระยะห่างระหว่างข้อความและกรอบ */
      background-color: rgba(255, 255, 255, 0.7); /* สีพื้นหลังแบบจาง */
    }
    .btn-primary{
      border-radius: 10px; /* ทำมุมขอบโค้ง */
    }
    .btn-primary:hover{
      background-color: #333a73;

    }
  </style>


</head>

<body ng-controller="Appoint2Controller">
  <?php include 'navbar_admin.php'; ?>
  <div class="container-fluid">
    <div class="header" >
      <h1 class="title" >รายงานการนัดหมาย</h1>
      
    </div>
      <div class="container-body">
      <div class="row align-items-center">
        <div class="col">
            <b>ค้นหาเดือน: </b>
            <input ng-model="s.month0" type="month" class="form-control mb-3" placeholder="กรุณากรอกเดือน" class="search-patient"/>
        </div>
        <div class="col">
            <b>ค้นหาวันที่นัดหมาย: </b>
            <input ng-model="s.date0" type="date" class="form-control mb-3" placeholder="กรุณากรอกวันเดือนปีที่นัด" class="search-patient"/>
        </div>
        <div class="col">
            <b>เลือกเวลานัดหมาย: </b> 
            <select class="form-select mb-3" ng-model="s.time" class="search-patient">
                <option value=""></option>
                <option value="1">ช่วงเช้า เวลา 08:00 น. - 12:00 น.</option>
                <option value="2">ช่วงบ่าย เวลา 13:00 น. - 16:00 น.</option>
            </select>
        </div>
        <div class="col">
            <b>เลือกสถานะการนัดหมาย: </b>
            <select class="form-select mb-3" ng-model="s.status" class="search-patient">
                <option value="">ยังไม่มาตามนัด</option>
                <option value="1">มาตามนัดหมายแล้ว</option>
                <option value="2">ไม่มาตามนัด</option>
            </select>
        </div>
        <div class="col">
            <button class="btn btn-primary " ng-click="select2()">แสดงข้อมูลการนัดหมาย</button>
        </div>
        <div class="col">
            <?php
                echo "<input type='button' class='btn btn-primary ' onclick='javascript:print()' value='สั่งพิมพ์รายงานการนัดหมาย'>";
            ?>
        </div>
    </div>

  
    <br /><br />
    <table class="table table-hover table-striped">
      <thead class="table-head">
        <tr class="head-content">
          <th>ลำดับ</th>
          <th>HN</th>
          <th>ชื่อ-สกุลผู้ป่วย</th>
          <th>เบอร์โทรติดต่อ</th>
          <th>วันที่นัดหมาย</th>
          <th>เวลานัดหมาย</th>
          <th>สาเหตุการนัด</th>
          <!-- <th>สถานที่นัดหมาย</th>
                    <th>สาเหตุการนัด</th>
                    <th>สิ่งที่ต้องปฏิบัติ</th>
                    <th>แพทย์ผู้นัด</th> -->
          <!-- <th>สถานะการนัดหมาย</th> -->
        </tr>
      </thead>
      <tbody class="tbody-content">
        <tr ng-repeat='val in list track by $index' class="tbody-content">
          <td>{{$index+1}}</td>
          <td>{{val.HN}}</td>
          <td>{{val.patient_name}} {{val.patient_lastname}}</td>
          <td>{{val.patient_phone}}</td>
          <td>{{val.appointment_date | date:'yyyy-MM-dd'}}</td>
          <td>{{val.time_name}}</td>
          <td>{{val.reason_name}}</td>
          <!-- <td>{{val.location_name}}</td>
                    <td>{{val.reason_name}}</td>
                    <td>{{val.detail}}</td>
                    <td>{{val.admin_name}}   {{val.admin_lastname}}</td> -->
          <!-- <td>{{val.status_name}} -->
            <!-- <button type="button" className="btn btn-warning" data-bs-toggle="modal" ng-click= "switchStatus(val.status,val.idappointment)" >บันทึก</button> -->
          </td>
        </tr>
      </tbody>
    </table>
    <br>
    <h2 class="title">สถิติการนัดหมาย</h2>
    <table class="table table-hover table-striped">
      <head class="table-head">
        <tr class="header-content">
          <th>วันที่นัดหมาย</th>
          <th>จำนวนการนัดหมายทั้งหมด</th>
        </tr>
      </head>
      <tr ng-repeat='val in list2' class="tbody-content">
        <th>{{val.appointment_date}}</th>
        <th>{{val.CNT}}</th>
      </tr>
    </table>
<br>
    <h2 class="title">รายงานการนัดหมายประจำเดือน</h2>
    <table class="table table-hover table-striped">
      <head class="table-head">
        <tr class="header-content">
          <th>ประจำเดือน</th>
          <th>จำนวนการนัดหมายทั้งหมด</th>
        </tr>
      </head>
      <tr ng-repeat='val in list3' class="tbody-content">
        <th>{{val.Month}}</th>
        <th>{{val.CNT}}</th>
      </tr>
    </table>
  </div>
  </div>
  </div>
  </div>
  </div>

  <!-- Button trigger modal เอาไว้ใส่ย้อยกลับ หรืออะไรเอา-->
  <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
   เพิ่มการนัดหมาย 
  </button> -->


  <!-- Modal popup-->
  <!-- Button trigger modal -->
  <!-- Modal -->
  <div class="modal fade" id="popup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          {{a}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>





</body>

</html>