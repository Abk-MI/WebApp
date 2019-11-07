<?php
include("config.php");

class crud{
	
  	public $obj;

    public function __construct ($config){
    	$this->obj=$config->getconnection();
    }

	public function recherche($table){
		
	    $r = $this->obj->query("select * from $table;");
		return $r->fetchall();
	}
	
	public function All_User(){

		$sql_request="SELECT `Id_user` , `Nom` , `Prenom`, `Poste` FROM `user` WHERE `Poste` != 'admin'";
		  $r = $this->obj->query($sql_request);
			return $r->fetchall();
	}
		
	public function getId_presence($id_user,$date){

		$sql_request="SELECT `Id_presence` from `fichepresence` WHERE `Id_user` = $id_user and `Date_travaille` = '$date';";
  
		$r = $this->obj->query($sql_request);
		
		return $r->fetchall();	
	}
		
	public function nouvelledate($id_user){

		$sql_request="SELECT `Date_travaille` from `fichepresence` WHERE `Id_user` = $id_user";
		  
		$r = $this->obj->query($sql_request);
		
		return $r->fetchall();	
	}
    
    public function ajout_date($id_user, $date){

		$sql_request="INSERT INTO `fichepresence` (`Id_presence`,  `Id_user`,`Date_travaille`) VALUES ('NULL', '$id_user','$date');";
       
        return $this->obj->exec($sql_request);
    }

	public function ajout_heure($id_user,$id_presence,$debut){

        $sql_request="INSERT INTO fichehoraire (Id_user,Id_presence,Debut_travaille) VALUES ($id_user,$id_presence,'$debut');";
		//echo $sql_request;
        //die;
        return $this->obj->exec($sql_request);
    }
	
    public function modifier($id_user,$id_presence,$debut,$fin){
    
        $sql_request="UPDATE `fichehoraire` SET  `Fin_travaille` = '$fin' WHERE `Id_user` = $id_user  and `Id_presence` = $id_presence and `Debut_travaille` = '$debut' ;";
    
        return $this->obj->exec($sql_request);
	}
	
	public function getInfo($id_user){
		
		$sql_request="SELECT `Nom`, `Prenom` FROM `user` WHERE `Id_user` = $id_user;";
			
        $r = $this->obj->query($sql_request);
		
		return $r->fetchall();	
	}
	
	public function getnowdate($id_user){
		
		$sql_request="SELECT `f`.`Id_user`, `f`.`Date_travaille` , `u`.`Nom`, `u`.`Prenom` FROM `fichepresence` AS `f` JOIN `user` AS `u` USING(`Id_user`) WHERE `Date_travaille`=DATE( NOW() ) and `f`.`Id_user` = $id_user;";
			
        $r = $this->obj->query($sql_request);
		
		return $r->fetchall();	
	}

	public function gethours($id_user,$date){	

		$sql_request="SELECT `f2`.`Id_user`,`f1`.`Debut_travaille` , `f1`.`Fin_travaille`  FROM `fichehoraire` AS `f1` JOIN `fichepresence` AS `f2` ON(`f1`.`Id_presence`=`f2`.`Id_presence`) WHERE `f2`.`Date_travaille`='$date' and `f2`.`Id_user`=$id_user AND `f1`.`Fin_travaille` != 'NULL'";
	  	$r = $this->obj->query($sql_request);
		
		$p= $r->fetchall();	

		$calc=0;
			foreach($p as $h){		
				$h1=strtotime($h['Debut_travaille']);
				$h2=strtotime($h['Fin_travaille']);
				$calc+=$h2-$h1;												
			}
		
		$nb="";
		if($calc<3600){
			$nb=$nb."0h";
			$minute=(int)($calc/60);
			$nb=$nb." ".$minute."m";
		}else{
			$hour=(int)($calc/3600);
			$calc-=$hour*3600;
			$minute=(int)($calc/60);
			$nb=$nb.$hour."h".$minute."m";
		}

		return $nb;
	}
		
		//$date=DATE( NOW() );
	public function getnbpause($id_user,$date){

		$sql_request="SELECT `f2`.`Id_user`, count(`f1`.`Debut_travaille`)-1 as `Nombre_Pause`  FROM `fichehoraire` AS `f1` JOIN `fichepresence` AS `f2` ON(`f1`.`Id_presence`=`f2`.`Id_presence`) WHERE `f2`.`Date_travaille`='$date' and `f2`.`Id_user`=$id_user AND `f1`.`Fin_travaille` != 'NULL'";
	  
	  	$r = $this->obj->query($sql_request);
		
		$p= $r->fetchall();	

			foreach($p as $h){
				if($h['Nombre_Pause']==-1){
					$pause = 0;					
				}else{
					$pause = $h['Nombre_Pause'];
				}
			}
		return $pause;
	}


	public function getLastdate($id_user){
		
		$sql_request="SELECT `f`.`Id_user`, `f`.`Date_travaille` , `u`.`Nom`, `u`.`Prenom` FROM `fichepresence` AS `f` JOIN `user` AS `u` USING(`Id_user`) WHERE `Date_travaille`=DATE_SUB(DATE(NOW()), INTERVAL 1 DAY) and `f`.`Id_user`=$id_user";
			
	    $r = $this->obj->query($sql_request);
		
		return $r->fetchall();	
	}
		
		
	public function SevenDayHours($id_user){	

		$sql_request2="SELECT `f`.`Id_user`, `f`.`Date_travaille` , `u`.`Nom`, `u`.`Prenom` FROM `fichepresence` AS `f` JOIN `user` AS `u` USING(`Id_user`) WHERE `f`.`Id_user`=1111 AND week(`Date_travaille`) = week(DATE(NOW()))";
	    
	    $re = $this->obj->query($sql_request2);
		$res= $re->fetchall();
		$calc=0;
		foreach($res as $q){	

			$date=$q['Date_travaille'];
			$sql_request="SELECT `f2`.`Id_user`,`f1`.`Debut_travaille` , `f1`.`Fin_travaille`  FROM `fichehoraire` AS `f1` JOIN `fichepresence` AS `f2` ON(`f1`.`Id_presence`=`f2`.`Id_presence`) WHERE `f2`.`Date_travaille`='$date' and `f2`.`Id_user`=$id_user AND `f1`.`Fin_travaille` != 'NULL'";
			
			$r = $this->obj->query($sql_request);
			$p= $r->fetchall();	
			
			foreach($p as $h){		
				$h1=strtotime($h['Debut_travaille']);
				$h2=strtotime($h['Fin_travaille']);
				$calc+=$h2-$h1;												
			}
		}
				
		$nb="";

		if($calc<3600){
			$nb=$nb."0h";
			$minute=(int)($calc/60);
			$nb=$nb." ".$minute."m";
		}else{
			$hour=(int)($calc/3600);
			$calc-=$hour*3600;
			$minute=(int)($calc/60);
			$nb=$nb.$hour."h".$minute."m";
		}
		return $nb;
	}
	//SELECT `Fin_travaille`  FROM `fichehoraire` WHERE `Fin_travaille` = 'NULL' and `Id_user`=$id
	public function isConnect($id){

		$sql_request="SELECT `fichehoraire`.`Id_user`,`fichehoraire`.`Fin_travaille` FROM `fichehoraire` JOIN `fichepresence` as `fp` USING(`Id_presence`) WHERE `fichehoraire`.`Id_user`=$id AND `fp`.`Date_travaille`=DATE( NOW() )";
		
		$r = $this->obj->query($sql_request);
		$p= $r->fetchall();	
				
		$test=FALSE;
		foreach($p as $h){		
			if($h['Fin_travaille']==NULL){
				$test=true;
			}											
		}

		return($test);
	}
				
	public function MonthHours($id_user,$mounth){	

			$sql_request2="SELECT `f`.`Id_user`, MONTH(`f`.`Date_travaille`) AS month , `u`.`Nom`, `u`.`Prenom` FROM `fichepresence` AS `f` JOIN `user` AS `u` USING(`Id_user`) WHERE `f`.`Id_user`=$id_user AND MONTH(`f`.`Date_travaille`) = '$mounth' ";
	        $re = $this->obj->query($sql_request2);
			$res= $re->fetchall();
			//**//
			$calc=0;
			foreach($res as $q){	
					//$date=$q['month'];
				$sql_request="SELECT `f2`.`Id_user`,`f1`.`Debut_travaille` , `f1`.`Fin_travaille` FROM `fichehoraire` AS `f1` JOIN `fichepresence` AS `f2` ON(`f1`.`Id_presence`=`f2`.`Id_presence`) WHERE MONTH(`f2`.`Date_travaille`)='$mounth' and `f2`.`Id_user`=$id_user AND `f1`.`Fin_travaille` != 'NULL'";
					
			$r = $this->obj->query($sql_request);
			$p= $r->fetchall();	
					
				foreach($p as $h){		
					$h1=strtotime($h['Debut_travaille']);
					$h2=strtotime($h['Fin_travaille']);
					$calc+=$h2-$h1;												
				}
			}
						
			$nb="";
			if($calc<3600){
				$nb=$nb."0h";
				$minute=(int)($calc/60);
				$nb=$nb." ".$minute."m";
			}else{
				$hour=(int)($calc/3600);
				$calc-=$hour*3600;
				$minute=(int)($calc/60);
				$nb=$nb.$hour."h".$minute."m";
			}

		return $nb;
	}	
	
	public function verif($id,$mtp){

		$sql_request1="SELECT `Password` FROM `user` WHERE `Id_user`=$id";
        $re = $this->obj->query($sql_request1);
		$res= $re->fetchall();
		
		foreach($res as $r){		
			$pass=$r['Password'];											
		}
		
		if($mtp==$pass){
			return TRUE;
		}else{
			return FALSE;
		}
	}		
	
	public function nouveaumtp($id,$mtp){

		$sql_request1="UPDATE `user` SET `Password` = '$mtp' WHERE `user`.`Id_user` = $id;";
		return $this->obj->exec($sql_request1);
	}
	
	public function getmois($id_user,$mounth){	

		$sql_request2="SELECT  MONTH(`f`.`Date_travaille`) AS month 

		FROM `fichepresence` AS `f` JOIN `user` AS `u` USING(`Id_user`) WHERE `f`.`Id_user`=$id_user AND MONTH(`f`.`Date_travaille`) = '$mounth' ";
			// echo"$sql_request2";die();
	   	$re = $this->obj->query($sql_request2);
			
		return $re->fetchall();	
	}	
	
	public function calcul($d,$f){
					
		$h1=strtotime($d);
		$h2=strtotime($f);
		$calc=$h2-$h1;												
			
		return $calc;
	}
	
}
?>