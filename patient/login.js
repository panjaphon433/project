angular.module('loginApp', [])
  .controller('loginController', ['$scope','$http', function($scope,$http){
    var popup = new bootstrap.Modal(document.getElementById('popup'), {
        keyboard: false ,
        backdrop: true ,
        show: true
      });
        $scope.login= function(){{ 
            $http({
                method: 'POST',
                url: 'login.php',
                headers: {
                  'Content-Type': undefined
                },
                data: $scope.s
            }).then(
                function(z){
                    // $scope.list = z.data;
                   if(z.data == 1){
                        window.location.assign("appoint.php");  
                   }else{
                    $scope.a ="ข้อมูลผู้ใช้งาน หรือ รหัสผ่านไม่ถูกต้อง"; 
                    popup.show();
                    } 
                    
                }, 
                function(response){    
                }
            );
            }   //window.location.assign("appoint.php");      
        }
  }]);