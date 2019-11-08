<?php 
session_start();
  if(!isset($_SESSION['user'])){
    header('location: ../index.php');
  }else if($_SESSION['user']['poste']!="admin"){
  	header('location: dashboard.php');
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Statistique</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="../assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
</head>
<body>
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
      <div class="logo">
        <a href="" class="simple-text logo-normal">Atelcom</a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item">
          <a 
          <?php 
            	include("crud.php");
				$config = new config("atelcom","root","");
				$cruds= new crud($config);
				
          if($_SESSION['user']['poste']=="admin"){
          		echo" class='nav-link' href='dashboard_admin.php'>";
			}else{
				echo" class='nav-link' href='dashboard.php'>";
			} ?>
             <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="profile.php">
              <i class="material-icons">person</i>
              <p>User Profile</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="listeAgent.php">
              <i class="material-icons">content_paste</i>
              <p>Liste des Agents</p>
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="statistique2.php">
              <i class="material-icons">timeline</i>
              <p>Statistiques</p>
            </a>
          </li>
          <li class="nav-item dropdown">
              <a class="nav-link" href="plateforme.php" id="navbarDropdownProfile" >
               
              <i class="material-icons">business</i>
                <p>Plateforme</p>
              </a>
             	
            </li>
        </ul>
      </div>
    </div>

  <!-- Navbar -->
  <div class="main-panel">
  <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
      <div class="container-fluid">
        <div class="navbar-wrapper d-inline p-1">
        </div>
        <div class="collapse navbar-collapse justify-content-end">
        	<p>
        	<?php echo "<h4 style='color:#53872A;text-decoration: underline;margin-right:15px;' class='d-inline p-2'>".($_SESSION['user']['pseudo'])."</h4>";
		        ?>
	        </p>
			<a href="logout.php"> 
				<button class="btn-dark" type="button">
					Déconnexion<i class="material-icons">logout</i>
				</button>
			</a>
        </div>
      </div>
    </nav>
 <!-- End Navbar -->
    	<div class="content">
    		
 <div class="container">       
 	<div class="row">
 		<div class="card card-stats col-md-10" style="margin-left: 8%;background-color: #6B1A6A;">
 			<h3 class="text-center" style="color: white;padding-bottom: 1%;"><strong>Statistiques</strong></h3>	
 		</div>
 	</div>
 	<div class="row">	
<!-- AUJOURD'HUI  -->
       	<div class="card card-stats col-md-4" style="margin-left: 10%; height: 150px;">
            		<a href="#" class="material-icons "  data-toggle="modal" data-target="#monModal">
	            		<h3 style="text-align: center;padding-top: 10%;">Aujourd'hui</h3>
	            	</a>
		    <div class="modal fade" id="monModal">
				<div class="modal-dialog">
					<div class="modal-content" style="width: 700px;">
						<div class="modal-header " style="background-color: #6B1A6A">
		                	<h3 class="modal-title col-md-11 text-center" style="color: white"><strong>Aujourd'hui</strong></h3> 
							<button type="button" class="close col-md-1" data-dismiss="modal" style="color: white">x</button>
						</div>
						<div class="modal-body">
						<?php
		    				echo "<table border='1' class='table table-bordered table-hover  table-shopping'>
			    					<tr>
				    					<th class='text-center'>Id</th>
				    					<th class='text-center'>Nom</th>
				    					<th class='text-center'>Prenom</th>
				    					<th class='text-center'>Date</th>
				    					<th class='text-center'>Nombre d'heure</th>
				    					<th class='text-center'>Nombre Pause</th>
				    				</tr>";
						    				$alluser=$cruds->All_User();
						    				foreach($alluser as $u){
												$IdUser=$u['Id_user'];
												$res = $cruds->getnowdate($IdUser);
													foreach($res as $r){
														
														echo"<td class='text-center'>".$IdUser."</td>
								    					<td class='text-center'>".$r['Nom']."</td>
								    					<td class='text-center'>".$r['Prenom']."</td>
								    					<td class='text-center'>".$r['Date_travaille']."</td>";
															$date=$r['Date_travaille'];
															$h=$cruds->gethours($IdUser,$date);
														echo"<td class='text-center'>".$h."</td>
														<td class='text-center'>".$cruds->getnbpause($IdUser,$date)."</td></tr>";
													}
											}
		    				echo "</table>";
	    				?>
						  </div>
						<div class="modal-footer">
							<button type="button" class="btn" data-dismiss="modal">Fermer</button>
						</div>
					</div>
				</div>
            </div>
        </div>
<!-- END AUJOURD'HUI -->
<!-- HIER  -->        
        	<div class="card card-stats col-md-4" style="margin-left: 10%; height: 150px;">
            		<a href="#" class="material-icons "  data-toggle="modal" data-target="#monModal2">
	            		<h3 style="text-align: center;padding-top: 10%;">Hier</h3>
	            	</a>
		    <div class="modal fade" id="monModal2">
				<div class="modal-dialog">
					<div class="modal-content" style="width: 700px;">
						<div class="modal-header " style="background-color: #6B1A6A">
		                	<h3 class="modal-title col-md-11 text-center" style="color: white"><strong>Hier</strong></h3> 
							<button type="button" class="close col-md-1" data-dismiss="modal" style="color: white">x</button>
						</div>
						<div class="modal-body">
						<?php
		    				echo "<table border='1' class='table table-bordered table-hover table-shopping'>
			    					<tr>
				    					<th class='text-center'>Id</th>
				    					<th class='text-center'>Nom</th>
				    					<th class='text-center'>Prenom</th>
				    					<th class='text-center'>Date</th>
				    					<th class='text-center'>Nombre d'heure</th>
				    					<th class='text-center'>Nombre Pause</th>
				    				</tr>";
						    				$alluser=$cruds->All_User();
						    				foreach($alluser as $u){
												$IdUser=$u['Id_user'];
												$res = $cruds->getLastdate($IdUser);
													foreach($res as $r){
														
														echo"<td class='text-center'>".$IdUser."</td>
								    					<td class='text-center'>".$r['Nom']."</td>
								    					<td class='text-center'>".$r['Prenom']."</td>
								    					<td class='text-center'>".$r['Date_travaille']."</td>";
															$date=$r['Date_travaille'];
															$h=$cruds->gethours($IdUser,$date);
														echo"<td class='text-center'>".$h."</td>
														<td class='text-center'>".$cruds->getnbpause($IdUser,$date)."</td></tr>";
													}
											}
		    				echo "</table>";
	    				?>
						  </div>
						<div class="modal-footer">
							<button type="button" class="btn" data-dismiss="modal">Fermer</button>
						</div>
					</div>
				</div>
            </div>
        </div>
        <!-- END HIER -->
	</div>        
<!-- END ROW aujourd'hui hier' -->
<!-- semaine mois -->
<div class="row">	
<!-- semaine  -->
       	<div class="card card-stats col-md-4" style="margin-left: 10%; height: 150px;">
            		<a href="#" class="material-icons "  data-toggle="modal" data-target="#monModal3">
	            		<h3 style="text-align: center;padding-top: 10%;">Semaine</h3>
	            	</a>
		    <div class="modal fade" id="monModal3">
				<div class="modal-dialog">
					<div class="modal-content" style="width: 700px;">
						<div class="modal-header " style="background-color: #6B1A6A">
		                	<h3 class="modal-title col-md-11 text-center" style="color: white"><strong>Semaine</strong></h3> 
							<button type="button" class="close col-md-1" data-dismiss="modal" style="color: white">x</button>
						</div>
						<div class="modal-body">
					<!--	<div class='text-center'>
								<form>
									  <input type="week" name="year_week"/>
									  </br></br>
								</form>
							</div>		-->
						<?php
		    				echo "<table border='1' class='table table-bordered table-hover table-shopping'>
			    					<tr>
				    					<th class='text-center'>Id</th>
				    					<th class='text-center'>Nom</th>
				    					<th class='text-center'>Prenom</th>
				    					<th class='text-center'>Nombre d'heure</th>
				    				</tr>";
						    				$alluser=$cruds->All_User();
						    				foreach($alluser as $u){
												$IdUser=$u['Id_user'];
												echo"<td class='text-center'>".$IdUser."</td>
						    					<td class='text-center'>".$u['Nom']."</td>
						    					<td class='text-center'>".$u['Prenom']."</td>";
												echo"<td  class='text-center'>".$cruds->SevenDayHours($IdUser)."</td></tr>";
											}
		    				echo "</table>";
	    				?>
						  </div>
						<div class="modal-footer">
							<button type="button" class="btn" data-dismiss="modal">Fermer</button>
						</div>
					</div>
				</div>
            </div>
        </div>
<!-- END SEMAIN -->
<!-- MOIS  -->        
        	<div class="card card-stats col-md-4" style="margin-left: 10%; height: 150px;">
            		<a href="#" class="material-icons "  data-toggle="modal" data-target="#monModal4">
	            		<h3 class="text-center" style="padding-top: 10%;">Mois</h3>
	            	</a>
		    <div class="modal fade" id="monModal4">
				<div class="modal-dialog">
					<div class="modal-content" style="width: 700px;height: 300px;">
						<div class="modal-header " style="background-color: #6B1A6A">
		                	<h3 class="modal-title col-md-11 text-center" style="color: white"><strong>Mois</strong></h3> 
							<button type="button" class="close col-md-1" data-dismiss="modal" style="color: white">x</button>
						</div>
						<div class="modal-body">
						<form method="get" name="listaf" action="stat3.php" class="text-center">
							<select name="lista" class="form-control">
								<option value="0">Choisir un mois</option>
								<option value="1">Janvier</option>
								<option value="2">Fevrier</option>
								<option value="3">Mars</option>
								<option value="4">Avril</option>
								<option value="5">Mai</option>
								<option value="6">juin</option>
								<option value="7">juillet</option>
								<option value="8">aout</option>
								<option value="9">september</option>
								<option value="10">october</option>
								<option value="11">November</option>
								<option value="12">Décember</option>
							</select>
								<input type="submit" value="voir" name="btnv" class="btn btn-success"/>
							
						</form>
						
						  </div>
						<div class="modal-footer">
							<button type="button" class="btn" data-dismiss="modal">Fermer</button>
						</div>
					</div>
				</div>
            </div>
        </div>
        <!-- END mois -->
	</div>        
<!-- END ROW semaine mois -->
</div>
</div>
</div>
<!--   Core JS Files   -->
<script src="../assets/js/core/jquery.min.js"></script>
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap-material-design.min.js"></script>
</body>
</html>