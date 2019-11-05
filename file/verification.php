<?php
session_start();
include("crud.php");
$config = new config("atelcom","root","");
$cruds= new crud($config);

if($config->getconnection()){
  if(isset($_POST['submit'])){

      $result=$cruds->recherche("user");

    $user=$_POST['username'];
    $pass=$_POST['password'];

    $v=0;
    foreach($result as $i){
  		if(($i['Username']==$user) && ($i['Password']==$pass)){

          $_SESSION['user'] = array(
            'id_user' => $i['Id_user'],
            'nom' => $i['Nom'],
            'prenom' => $i['Prenom'],
            'poste' => $i['Poste'],
            'pseudo' => $i['Pseudo'],
            'username' => $i['Username'],
            'password' => $i['Password']
          );

    $datejour=date("Y-m-d");
    $horaire=date("H:i:s");

          $_SESSION['fichepresence'] = array(
            'id_user' => $i['Id_user'],
            'date_travaille' => $datejour,
            'debut_travaille' => $horaire
          );

          $id_user = $_SESSION['user']['id_user'];

          $tab=$cruds->nouvelledate($id_user);
          $test="false";
          
        foreach($tab as $t){
          if($t['Date_travaille']==$datejour){
            $test="true";
          }
        }
          if($test=="false"){
          $n=$cruds->ajout_date($id_user, $datejour);
          }

          $id_p=$cruds->getId_presence($id_user,$datejour);
          
           foreach($id_p as $e){
               $id_presence=$e[0];
             }
          
          $n=$cruds->ajout_heure($id_user,$id_presence,$horaire);
          $_SESSION['statu']="connecte";


    if($n != 0){
      if($i['Poste']=="admin"){
				    header('location: dashboard_admin.php');
  			}else{
  				  header('location: dashboard.php');
  			}
      }else {
        die;
      }
			$v=1;
		  }
	  }
    	if($v==0){
          $_SESSION["erreur"]='true';
    			header('location: ../index.php');
    			}
    }
  }else{
  echo"<h3 style='color:red; text-align:center;'>Erreur de connexion avec la base de donnée ! </h3>";
  }
?>
