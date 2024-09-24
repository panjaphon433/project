<?php
session_start();
// echo $_SESSION ["check"];

// echo $_SESSION ["check"];
if ($_SESSION == NULL) {
  header("location:../adminlogin.php");
  exit();
}
?>


<!doctype html>
<html ng-app="adminApp" lang="th">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
  <script src="profile.js"></script>
  <title>หน้าโปรไฟล์</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <style>
    /* CSS สำหรับการจัดระเบียบฟอร์ม */

    /* CSS สำหรับการปรับรูปแบบฟอร์ม */
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
      min-height: 50vh; /* CSS ระยะห่างขอบ */
    }
    .header{
      margin-bottom: 20px;
    }
    .left {
      background-color: #f0f0f0;
      padding: 20px;
    }

    .right {
      background-color: #e0e0e0;
      padding: 20px;
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
  </style>
</head>

<body ng-controller="AdminshowController">
  <?php include 'navbar_admin.php'; ?>
  <br>
  <h1 class="fw-bold">เจ้าหน้าที่ที่เข้าสู่ระบบ: {{list[0].admin_name}} {{list[0].admin_lastname}} {{list[0].admin_position}}</h1>
  <div class="container">
    <br /><br />
    <table class="table table-hover table-striped">
      <thead class="table-head">
        <tr class="head-content">
          <th>ชื่อ</th>
          <th>นามสกุล</th>
          <th>ตำแหน่ง</th>
          <th>เลขประจำตัวประชาชน</th>
          <th>ชื่อผู้ใช้งาน</th>
          <th>รหัสผ่าน</th>
        </tr>
      </thead>
      <tbody ng-init="select();" class="tbody-content">
        <tr ng-repeat='val in list' class="tbody-content">
          <td>{{val.admin_name}}</td>
          <td>{{val.admin_lastname}}</td>
          <td>{{val.admin_position}}</td>
          <td>{{val.admin_idcard}}</td>
          <td>{{val.admin_username}}</td>
          <td>{{val.admin_password}}</td>
        </tr>
      </tbody>
    </table>
  </div>


  <!-- Modal popup-->
  <!-- Button trigger modal -->
  <!-- Modal -->
  <div class="modal fade" id="popup" data-keyboard="false" data-backdrop="true" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">แจ้งเตือน</h5>
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