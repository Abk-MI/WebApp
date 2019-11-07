<?php
session_start();
include("crud.php");
$config=new config("atelcom","root","");
$cruds= new crud($config);

    $id_user=$_SESSION['user']['id_user'];
    $date=$_SESSION['fichepresence']['date_travaille'];
    $id_p=$cruds->getId_presence($id_user,$date);
    foreach($id_p as $e){
       $id_presence=$e[0];
     }

      if($_SESSION['statu']=="connecte"){

           $debut=$_SESSION['fichepresence']['debut_travaille'];
           $fin=date("H:i:s");

        $r=$cruds->modifier($id_user,$id_presence,$debut,$fin);
	          
	          if($r!=0){
		            $_SESSION['statu']="non connecte";
		        	$_SESSION['statud']=date("H:i:s");
	         	}else{
		            echo"erreur ajout fin pause";
	   		        die;
	          	}
	          	
      }else if($_SESSION['statu']=="non connecte"){
	  	
        $_SESSION['fichepresence']['debut_travaille']=date("H:i:s");
        $debut=$_SESSION['fichepresence']['debut_travaille'];

        $n=$cruds->ajout_heure($id_user,$id_presence,$debut);

		        if($n!=0){
			        $_SESSION['statu']="connecte";  
			        $_SESSION['statuf']=date("H:i:s");   
			        
			        $f=$_SESSION['statuf'];
				  	$d=$_SESSION['statud'];
				  	
				  	$c=$cruds->calcul($d,$f);
					if($c>50){
						header('location: logout.php');
						die();
					}
		        }else{
		            echo"erreur ajout debut pause";
		            die;
		        }
}

  header('location: dashboard.php');
?>
