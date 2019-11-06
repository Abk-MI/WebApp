<?php
session_start();
  if(!isset($_SESSION['user'])){
    header('location: ../index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
   <title>Plateforme</title>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!-- Fonts and icons -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="../assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
</head>
<body>
  <div class="wrapper ">
    <div class="sidebar" data-color="purple">
      <div class="logo">
        <a href="" class="simple-text logo-normal">Atelcom</a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item">
	          <?php if($_SESSION['user']['poste']=="admin"){
	          		echo"<a class='nav-link' href='dashboard_admin.php'>";
				}else{
					echo"<a class='nav-link' href='dashboard.php'>";
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
          <?php if($_SESSION['user']['poste']=="admin"){
		          echo"<li class='nav-item'>
		            <a class='nav-link' href='listeAgent.php' data-toggle='modal' data-target='#model'>
		              <i class='material-icons'>content_paste</i>
		              <p>Liste des Agents</p>
		            </a>
		          </li>
		          <li class='nav-item'>
		            <a class='nav-link' href='statistique2.php'>
		              <i class='material-icons'>timeline</i>
		              <p>Statistiques</p>
		            </a>
		          </li>";
			} ?>
          <li class="nav-item active">
              <a class="nav-link" href="">
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
        <!-- on/off -->
        <?php
        if($_SESSION['user']['poste']!="admin"){
	
	         echo"<form method='post' name='onoff' action='pausse.php'>";	 
		   		 if($_SESSION['statu']=='connecte'){
				 	echo"<input class='btn btn-success' type='submit' name='pause' value='Connecter'/>";
				 }else{
				 	echo"<input class='btn btn-danger' type='submit' name='pause' value='Non Connecter' />";
				 } 
	
	          echo"</form>";
		}
		 ?>
         <!-- on/off-->
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
 					<h3 class="text-center" style="color: white;padding-bottom: 1%;"><strong>Plateforme</strong></h3>	
 				</div>
 	</div>
			<div class="card col-md-10 " style="margin-left: 8%;">
             	<div class="row">
             		 <h3 class="text-center col-md-10">ACCES PERSONNEL ENCADREMENT AAMT</h3>
             		 <a href="APEaamt.php" style="margin-top: 1%">
						<input type="button" class="btn btn-success  " value="Allez à >>"/>
	           		 </a>
             	</div>
	        </div>
	        <div class="card col-md-10" style="margin-left: 8%">
             	<div class="row">
		            <h3 class="text-center col-md-10">ACCES PERSONNEL ENCADREMENT ATELCOM</h3>
	             	<a href="APEAtelcom.php"  style="margin-top: 1%">
		            	<input type="button" class="btn btn-success  " value="Allez à >>"/>
		            </a>
	  			</div>
	        </div>
	        <div class="card col-md-10" style="margin-left: 8%">
             	<div class="row">
		            <h3 class="text-center col-md-10">ACCES PERSONNEL DE PRODUCTION ATELCOM</h3>
	             	<a href="APPatelcom.php" style="margin-top: 1%">
		            	<input type="button" class="btn btn-success  " value="Allez à >>"/>
		            </a>
				</div>
	        </div>
	        <?php
		        if($_SESSION['user']['poste']=='admin'){
			        echo"<div class='card col-md-10' style='margin-left: 8%'>
	             			<div class='row'>
				            	<h3 class='text-center col-md-10'>ACCES ADMINISTRATEUR</h3>
				             	<a href='Aadmin.php' style='margin-top: 1%'>
					            	<input type='button' class='btn btn-success' value='Allez à >>'/>
					            </a>
				            </div>
			        	</div>";}else{
							echo"<div class='card col-md-10' style='margin-left: 8% ;cursor: not-allowed;' >
	             			<div class='row' >
				            	<h3 class='text-center col-md-10' >ACCES ADMINISTRATEUR</h3>
				             	<a href='Aadmin.php' style='margin-top: 1%' disabled>
					            	<input type='button' class='btn btn-success' style='cursor: not-allowed;' value='Allez à >>' disabled/>
					            </a>
				            </div>
			        	</div>";
						}
	        ?>
		</div>
	</div>

</body>
</html>