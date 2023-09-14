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
  include "config/connection.php";
  //include "modals/functions.php";

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
    ///////////
    function messagesReturn(){
        global $conn;

        try{
            $query="SELECT * FROM messagecontact";
            $result=$conn->query($query)->fetchAll();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }
    ////////
    function catchAnswer($id){
        global $conn;

        try{
            $query="SELECT a.* FROM survey s INNER JOIN answer a ON s.id_survey=a.id_survey WHERE s.id_survey=:id";
            $send=$conn->prepare($query);
            $send->bindParam(":id", $id);
            $result=$send->execute();
            $result=$send->fetchAll();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }
    ////////
    function catchSurvey($id){
        global $conn;

        try{
            $query="SELECT s.id_survey FROM survey s INNER JOIN answer a ON s.id_survey=a.id_survey WHERE a.id_answer=:id";
            $send=$conn->prepare($query);
            $send->bindParam(":id", $id);
            $result=$send->execute();
            $result=$send->fetch();
            return $result;
        }

        catch(PDOException $e){
            echo $e->getMessage();
            $message="Server error";
        }
    }
    ////////
    function countAllS($idS){
        global $conn;

        try{
            $query="SELECT COUNT(v.id_answer) as surv FROM survey s INNER JOIN answer a ON s.id_survey=a.id_survey INNER JOIN surveyvotes v ON v.id_answer=a.id_answer WHERE s.id_survey=:id";
            $send=$conn->prepare($query);
            $send->bindParam(":id", $idS);
            $result=$send->execute();
            $result=$send->fetch();
            return $result;
        }

        catch(PDOException $e){
            echo $e->getMessage();
            $message="Server error";
        }
    }
    ////////
    function countAll($id){
        global $conn;

        try{
            $idS=catchSurvey($id);
            $idS=$idS->id_survey;
            $countAllS=countAllS($idS);
            $countAlls=$countAllS->surv;
            $query="SELECT ROUND((SELECT COUNT(v.id_answer) FROM surveyvotes v INNER JOIN 
            answer a ON v.id_answer=a.id_answer WHERE v.id_answer=:id)/:countAlls*100)
            as numb";
            $send=$conn->prepare($query);
            $send->bindParam(":id", $id);
            $send->bindParam(":countAlls", $countAlls);
            $result=$send->execute();
            $result=$send->fetch();
            return $result;

        }
        catch(PDOException $e){
            echo $e->getMessage();
            $message="Server error";
        }
    }

  $messages=messagesReturn();
  $questions=getAllFromTabel("survey");
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
            <a class="navbar-brand" href="adminPanel.php">Messages and Survey</a>
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
        <div class="row">
          <div class="col-md-12">
            <h3>Messages from users to you</h3>
          <div id="messages">
            <table class="table"> 
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">First Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Phone</th>
                  <th scope="col">Message</th>
                  <th scope="col">Date</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $rb=1;
                foreach($messages as $m):
              ?>
                <tr>
                  <th scope="row"><?=$rb?></th>
                  <td><?=$m->name?></td>
                  <td><?=$m->email?></td>
                  <td><?=$m->phone?></td>
                  <td><?=$m->subject?></td>
                  <td><?=$m->datOfMessage?></td>
                  <td><a href="#" data-id="<?=$m->id_message?>" class="idDelete">Delete</a></td>
                </tr>
              <?php
                $rb++;
                endforeach;
              ?>
                </tbody>
            </table>
           </div>
          </div>
        </div>
      
      <!-- anketa -->
      <div class="row">
      <div class="col-md-12 mt-5">   
      <table class="table">
            <h3>Survey statistics</h3>
              <tbody>
                <?php
                $rb=1;
                  foreach($questions as $q):
                  $catchAnswer=catchAnswer($q->id_survey);
                ?>
                  <tr>
                  <td><input type="checkbox" class="activ" id="chb<?=$q->id_survey?>" value="<?=$q->id_survey?>"></td><td><?=$rb?></td>
                  <td><?=$q->question?></td>
                  <?php
                      foreach($catchAnswer as $c):
                      $countAll=countAll($c->id_answer);
                      // var_dump($countAll);
                  ?>
                    <td><?=$c->answer?></td>
                    <?php
                      if($countAll==false){
                        echo "<td>0%</td>";
                      }
                      else{
                        echo "<td>".$countAll->numb."%</td>";
                      }
                      ?>
                  <?php
                    endforeach;
                  ?>
                </tr>
                <?php
                $rb++;
                  endforeach;
                ?>
              </tbody>
      </table>  
		  </div>
      </div>
      <!-- kraj anket -->
      </div>
    </div>
  </div>
<?php
  }
  include "includes/footerAdmin.php";
?>
