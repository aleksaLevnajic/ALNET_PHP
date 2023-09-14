<?php
   session_start();
   $user = $_SESSION['user'];
     if(!isset($_SESSION['user'])){
     header("location: models/404.php?notFound");
   }
     //else if($_SESSION['id_role']!=1)   
     else if($user->id_role!=1){
     header("location: models/404.php?notFound");
   }
  else{
  include "includes/headAdmin.php";
  include "includes/headerAdmin.php";
  //include "models/functions.php";
  include "config/connection.php";
 
///
  function usersAll(){
    global $conn;

    try{
        $query="SELECT * FROM user u INNER JOIN roles r ON u.id_role=r.id_role";
        $products=$conn->query($query)->fetchAll();
        return $products;
    }
    catch(PDOException $e){
        $message="Server error";
    }
}
////
function getAllFromTabel($nameTabel){
    global $conn;

    try{
        $query="SELECT * FROM $nameTabel";
        $result=$conn->query($query)->fetchAll();
        return $result;
    }
    catch(PDOException $e){
        $message="Server error";
    }
}

$users=usersAll();
$roles=getAllFromTabel("roles");
?>
  <div class="main-panel" style="height: 100vh;">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="adminPanel.php">User Table</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
        </div>
      </nav>
       <!-- End Navbar -->
    <div class="content">
        <div class="container">
            <div class="row">
      <!-- update i delete-->
      <div class="col-md-12">   
        <h3>Users</h3>
        <div id="users">
            <table class="table"> 
              <thead>
                <tr>
                  <th scope="col">id_user</th>
                  <th scope="col">firstName</th>
                  <th scope="col">lastName</th>
                  <th scope="col">email</th>
                  <th scope="col">role</th>
                  <th scope="col">date</th>
                </tr>
              </thead>
              <tbody>
              <?php
                foreach($users as $u):
              ?>
                <tr>
                  <th scope="row"><?=$u->id_user?></th>
                  <td id="nameUser<?=$u->id_user?>"><?=$u->firstName?></td>
                  <td id="lastNameUser<?=$u->id_user?>"><?=$u->lastName?></td>
                  <td id="emailUser<?=$u->id_user?>"><?=$u->email?></td>
                  <td id="roleUser<?=$u->id_user?>"><?=$u->role_name?></td>
                  <td><input type="text"  class="form-control" id="timeUser<?=$u->id_user?>" value="<?=$u->dateOfRegistration?>" disabled/></td>
                  <td>
                          </div>
                        </div>
                      </div>
                  </td>
                  <td><a href="#" data-id="<?=$u->id_user?>" class="deleteUser">Delete</a></td>
                </tr>
              <?php
                endforeach;
              ?>
            </tbody>
            </table>
          </div>
          </div>
		    </div>
      <!-- kraj update i update-->
		</div>
    </div>
<?php
  }
  include "includes/footerAdmin.php";
?>
