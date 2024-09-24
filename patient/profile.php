<?php
session_start();
if ($_SESSION == NULL) {
  header("location:../patientlogin.php");
  exit();
}
?>


<!doctype html>
<html ng-app="patientApp" lang="th">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
  <script src="profile.js"></script>
  <title>หน้าโปรไฟล์</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <style>
    /* .container{
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 50vh;
      
    } */
    /* CSS สำหรับการจัดระเบียบฟอร์ม */

    body {
            background-image: url('/appoint-project/admin/images/lio.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh; /* ความสูงเต็มหน้าจอ */
  margin: 0;
        }
    .left {
      
      background-color: #f0f0f0;
      padding: 20px;
    }

    .right {
      background-color: #e0e0e0;
      padding: 20px;
    }
    .tbody-content{
      text-align: center;
    }
    
    .header-content{
      text-align: center;
    }
    thead{
     text-align: center;
     
    }
    /* .table-head{
      background-color: #333a73;
    } */
    .head-content th{
      background-color: #333a73;
      color: #fff;
    }
  </style>
</head>

<body ng-controller="PatientshowController">
  <?php include 'nav.php'; ?>
  <br>
  <h1 class="fw-bold">เข้าสู่ระบบโดย: รหัสผู้ป่วย {{list[0].HN}} ชื่อ-สกุล {{list[0].patient_name}} {{list[0].patient_lastname}}</h1>
  <div class="container">
    <br /><br />
    <table class="table table-hover table-striped">
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
          <th rowspan="2">รหัสผ่าน</th>

 
          <th rowspan="2">รายละเอียด</th>
          </tr>
          </thead>
      <tbody ng-init="select();" class="tbody-content">
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
          <td>{{val.patient_password}}</td>

          

          <td><button type="button" class="btn btn-light" style="width: 7rem;" data-bs-toggle="modal" ng-click="select2(val.HN)" data-bs-target="#aaa">
          รายละเอียด</button></td>
          </tr>
      </tbody>
      </table>
      </div>
      </div>


      </div>
      </div>


  <!-- Modal show data patient-->
  <div class="modal fade" id="aaa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">ข้อมูลผู้ป่วยเพิ่มเติม</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table class="table table-hover" >
            <thead class="header-content">
              <tr class="head-content">
              <th class="text-end" rowspan="2">HN</th> 
              <th class="text-end" rowspan="2">ชื่อ</th>
              <th class="text-end" rowspan="2">เพศ</th>
              <th class="text-end" rowspan="2">สัญชาติ</th>
              <th class="text-end" rowspan="2">เชื้อชาติ</th>
              <th class="text-end" rowspan="2">ศาสนา</th>
              <th class="text-end" rowspan="2">วุฒิการศึกษา</th>
              <th class="text-end" rowspan="2">สถานภาพสมรส</th>
              <th class="text-end" rowspan="2">อาชีพ</th>
              <th class="text-end" rowspan="2">สิทธิ</th>
              <th class="text-end" rowspan="2">ชื่อมารดา</th>
              <th class="text-end" rowspan="2">บัตรประจำตัวประชาชนมารดา</th>
              <th class="text-end" rowspan="2">ชื่อบิดา</th>
              <th class="text-end" rowspan="2">บัตรประจำตัวประชาชนบิดา</th>
              <th class="text-end" rowspan="2">ชื่อคู่สมรส</th>
              <th class="text-end" rowspan="2">บัตรประจำตัวประชาชนคู่สมรส</th></tr>
              
            </thead>
            <tbody class="tbody-content">
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
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ปิด</button>
        </div>
      </div>
    </div>
  </div>











         <!-- <div>  -->
          <!-- <th rowspan="2">HN</th>
          <th rowspan="2">ชื่อ</th>
          <th rowspan="2">นามสกุล</th>
          <th rowspan="2">วัน/เดือน/ปีเกิด</th>
          <th rowspan="2">อายุ</th>
          <th rowspan="2">เลขประจำตัวประชาชน</th>
          <th rowspan="2">ที่อยู่</th>
          <th rowspan="2">เบอร์โทรศัพท์</th>
          <th rowspan="2">กรุ๊ปเลือด</th>
          <th rowspan="2">เพศ</th>
          <th rowspan="2">สัญชาติ</th>
          <th rowspan="2">เชื้อชาติ</th>
          <th rowspan="2">ศาสนา</th>
          <th rowspan="2">วุฒิการศึกษา</th>
          <th rowspan="2">สถานภาพสมรส</th>
          <th rowspan="2">อาชีพ</th>
          <th rowspan="2">สิทธิ</th>
          <th rowspan="2">ชื่อมารดา</th>
          <th rowspan="2">บัตรประจำตัวประชาชนมารดา</th>
          <th rowspan="2">ชื่อบิดา</th>
          <th rowspan="2">บัตรประจำตัวประชาชนบิดา</th>
          <th rowspan="2">ชื่อคู่สมรส</th>
          <th rowspan="2">บัตรประจำตัวประชาชนคู่สมรส</th>
          <th rowspan="2">รหัสผ่าน</th>
        </tr>
      </thead>
      <tbody ng-init="select();" class="tbody-content">
        <tr ng-repeat='val in list' class="tbody-content">
          <td>{{val.HN}}</td>
          <td>{{val.patient_name}}</td>
          <td>{{val.patient_lastname}}</td>
          <td>{{val.patient_birthday | date:'yyyy-MM-dd'}}</td>
          <td>{{val.Age}}</td>
          <td>{{val.patient_idcard}}</td>
          <td>{{val.patient_address}}</td>
          <td>{{val.patient_phone}}</td>
          <td>{{val.patient_blood}}</td>
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
          <td>{{val.patient_password}}</td>
        </tr>
      </tbody>
    </table>
    <table>
      
    </table>
  </div>
  </div>
  </div> -->


  <!-- Modal popup-->
  <!-- Button trigger modal -->
  <!-- Modal -->
  <div class="modal fade" id="popup" data-keyboard="false" data-backdrop="true" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
  <!-- <button type="button" class="btn btn-secondary" ng-click="test()">Close</button> -->

</body>

</html>