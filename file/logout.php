<?Php
session_start();
include("crud.php");
$config=new config("atelcom","root","");
$cruds= new crud($config);

  $horaire=date("H:i:s");
  $_SESSION['fichepresence']['fin_travaille'] = $horaire;

    $id_user = $_SESSION['user']['id_user'];
    $date = $_SESSION['fichepresence']['date_travaille'];
    $debut = $_SESSION['fichepresence']['debut_travaille'];
    $fin = $_SESSION['fichepresence']['fin_travaille'];

      $id_p=$cruds->getId_presence($id_user,$date);
       foreach($id_p as $e){
           $id_presence=$e[0];
         }
         if($_SESSION['statu']=="connecte"){
		      $r=$cruds->modifier($id_user,$id_presence,$debut,$fin);
		 }

          $_SESSION['user']= array();
          $_SESSION['fichepresence']= array();
          $_SESSION['statu']="non connecte";
          session_destroy();
          header('location: ../index.php');
?>
