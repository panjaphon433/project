<?php
session_start();
// echo $_SESSION ["check"];
if ($_SESSION == NULL) {
  header("location:../adminlogin.php");
  exit();
}
?>


<!doctype html>
<html ng-app="patientApp" lang="th">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
  <script src="patient.js"></script>
  <title>รายงานข้อมูลผู้ป่วย</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Sarabun:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
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
    .tbody-content{
      text-align: center;
    }
    .btn-edit-delete {
      display: flex;
      gap: 5px; /* ระยะห่างระหว่างปุ่ม */
    }
    .header-content{
      text-align: center;
    }
    .left {
      background-color: #f0f0f0;
      padding: 20px;
    }

    .right {
      background-color: #e0e0e0;
      padding: 20px;
    }
  </style>
</head>

<body ng-controller="PatientController">
  <?php include 'navbar_admin.php'; ?>
  <div class="container">
    <div class="header">
    <h1 class="title">รายงานข้อมูลผู้ป่วย</h1>
  <div class="container-body">
    <b>ค้นหาข้อมูลผู้ป่วยตามหมู่บ้าน : </b><input type="text" placeholder="ค้นหาข้อมูลหมู่บ้าน" ng-model="s.key" class="search-patient"/>
    <button class="btn btn-primary" ng-click="select3()">แสดงข้อมูลผู้ป่วย</button>
    <?php
        echo "<input type='button' class='btn btn-primary' style='float:right;' onclick='javascript:print()' value='สั่งพิมพ์ข้อมูลผู้ป่วย'>";
        ?>
    <!-- Button trigger modal -->
    <br /><br />

    <table class="table table-hover table-striped" >
      <thead class="table-head">
        <tr class="head-content">
          <th rowspan="2">HN</th>
          <th rowspan="2">ชื่อ</th>
          <th rowspan="2">นามสกุล</th>
          <th rowspan="2">ปี/เดือน/วันเกิด</th>
          <th rowspan="2">อายุ</th>
          <th rowspan="2">เลขประจำตัวประชาชน</th>
          <th rowspan="2">ที่อยู่</th>
          <th rowspan="2">เบอร์โทรศัพท์</th>
          <th rowspan="2">กรุ๊ปเลือด</th>
          
          <!-- <th rowspan="2">รหัสผ่าน</th> -->
        </tr>
      </thead>
      <tbody ng-init="select3();">
        <tr ng-repeat='val in list' class="tbody-content">
          <td>{{val.HN}}</td>
          <td>{{val.patient_name}} </td>
          <td>{{val.patient_lastname}}</td>
          <td>{{val.patient_birthday | date:'yyyy-MM-dd'}}</td>
          <td>{{val.Age}}</td>
          <td>{{val.patient_idcard}}</td>
          <td>{{val.patient_address}}</td>
          <td>{{val.patient_phone}}</td>
          <td>{{val.patient_blood}}</td>
          <!-- <td>{{val.patient_password}}</td> -->
        </tr>
      </tbody>
    </table>
    <h2>สถิติผู้ป่วย</h2>
    <table class="table table-hover table-striped">
      <thead class="table-head">
        <tr class="head-content">
          <th>หมู่บ้านเลขที่</th>
          <!-- <th>กรุ๊ปเลือด</th> -->
          <th>จำนวนการผู้ป่วยทั้งหมด</th>
        </tr>
      </thead>
      <tbody class="tbody-content">
      <tr ng-repeat='val in list2' class="tbody-content">
        <th>{{val.moo}}</th>
        <!-- <th>{{val.patient_blood}}</th> -->
        <th>{{val.CNT}}</th>
      </tr>
      </tbody>
    </table>
  </div>
  </div>
  </div>
  </div>
  </div>


  <!-- Modal show data patient-->
  <!-- <div class="modal fade" id="aaa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">ข้อมูลผู้ป่วยเพิ่มเติม</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table class="table table-hover" striped>
            <thead>
              <tr>
                <th>HN</th>
                <th>ชื่อ</th>
                <th>เพศ</th>
                <th>สัญชาติ</th>
                <th>เชื้อชาติ</th>
                <th>ศาสนา</th>
                <th>วุฒิการศึกษา</th>
                <th>สถานภาพสมรส</th>
                <th>อาชีพ</th>
                <th>สิทธิ</th>
                <th>ชื่อมารดา</th>
                <th>บัตรประจำตัวประชาชนมารดา</th>
                <th>ชื่อบิดา</th>
                <th>บัตรประจำตัวประชาชนบิดา</th>
                <th>ชื่อคู่สมรส</th>
                <th>บัตรประจำตัวประชาชนคู่สมรส</th>

              </tr>
            </thead>
            <tbody>

              <tr ng-repeat='val in list2'>
                <td>{{val.HN}}</td>
                <td>{{val.patient_name}}</td>
                <td ng-switch on="val.patient_sex">
                  <span ng-switch-when="1">ชาย</span>
                  <span ng-switch-when="2">หญิง</span>
                </td>
                <td ng-switch on="val.patient_nation">
                  <span ng-switch-when="1">ไทย</span>
                  <span ng-switch-when="2">อื่น ๆ</span>
                </td>
                <td ng-switch on="val.patient_race">
                  <span ng-switch-when="1">ไทย</option>
                    <span ng-switch-when="2">อื่น ๆ</option>
                </td>
                <td ng-switch on="val.patient_religion">
                  <span ng-switch-when="1">ศาสนาพุทธ</span>
                  <span ng-switch-when="2">ศาสนาคริสต์</span>
                  <span ng-switch-when="3">ศาสนาอิสลาม</span>
                </td>
                <td ng-switch on="val.patient_degree">
                  <span ng-switch-when="1">ประถมศึกษา</span>
                  <span ng-switch-when="2">มัธยมศึกษา</span>
                  <span ng-switch-when="3">อาชีวศึกษา</span>
                  <span ng-switch-when="4">อุดมศึกษา</span>
                </td>
                <td ng-switch on="val.patient_marital">
                  <span ng-switch-when="1">จดทะเบียนสมรส</span>
                  <span ng-switch-when="2">โสด</span>
                </td>
                <td ng-switch on="val.patient_occupation">
                  <span ng-switch-when="1">ค้าขาย</span>
                  <span ng-switch-when="2">เกษตรกร</span>
                  <span ng-switch-when="3">ธุรกิจส่วนตัว</span>
                  <span ng-switch-when="4">ข้าราชการ</span>
                  <span ng-switch-when="5">นักเรียน</span>
                  <span ng-switch-when="6">อื่น ๆ</span>
                </td>
                <td ng-switch on="val.patient_right">
                  <span ng-switch-when="1">เด็กทารก ( 30 บาทเดิม )</span>
                  <span ng-switch-when="2">ช่วงอายุ 12 - 59 ปี ( 30 บาทเดิม )</span>
                  <span ng-switch-when="3">ผู้สูงอายุ ( อายุ 60 ปีบริบูรณ์ขึ้นไป )</span>
                  <span ng-switch-when="4">บุคคลในครอบครัวของผู้นำชุมชน (กำนัน,สารวัตรกำนัน,ผญบ.,ผช.,แพทย์ประจำหมู่บ้าน)</span>
                  <span ng-switch-when="5">อื่น ๆ</span>
                </td>
                <td>{{val.patient_mom}}</td>
                <td>{{val.mom_idcard}}</td>
                <td>{{val.patient_dad}}</td>
                <td>{{val.dad_idcard}}</td>
                <td>{{val.patient_spouse}}</td>
                <td>{{val.spouse_idcard}}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div> -->


  <!-- Modal popup-->
  <!-- Button trigger modal -->
  <!-- Modal -->
  <div class="modal fade" id="popup1" data-keyboard="false" data-backdrop="true" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ช้อความแจ้งเตือน</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          {{a}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="popupInsert" data-keyboard="false" data-backdrop="true" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ช้อความแจ้งเตือน</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          {{b}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
        </div>
      </div>
    </div>
  </div>
  <!-- <button type="button" class="btn btn-secondary" ng-click="test()">Close</button> -->
  <!-- Modal -->

  <!-- ลบข้อมูล-->
  <div class="modal fade" id="popupDelete" aria-hidden="true" aria-labelledby="popupDeleteLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="popupDeleteLabel">ลบข้อมูล</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          คุณแน่ใจหรือไม่ว่าต้องการลบข้อมูลนี้ .. <br> HN:{{goingTodelete.HN}} ชื่อ-สกุล:{{goingTodelete.patient_name}} {{goingTodelete.patient_lastname}}
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" data-bs-target="#popupDelete2" data-bs-toggle="modal" ng-click="delete(goingTodelete.HN)">ลบ</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="popupDelete2" aria-hidden="true" aria-labelledby="popupDeleteLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="popupDeleteLabel2">การแจ้งเตือน</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          {{a}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
        </div>
      </div>
    </div>
  </div>






</body>

</html>