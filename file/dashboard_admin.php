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
  <title>Dashboard</title>
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
          <li class="nav-item active">
            <a class="nav-link" href="">
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
          <li class="nav-item ">
            <a class="nav-link" href="statistique2.php">
              <i class="material-icons">timeline</i>
              <p>Statistiques</p>
            </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="plateforme.php">
               
              <i class="material-icons">business</i>
                <p>
                  Plateforme
                </p>
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
    	<div class="row">
    		<h1 class="text-primary text-uppercase p-1" style="margin-left: 10%">Bienvenue !</h1>
    	</div>
<div class="row">
<!--  ****** Profile  ********   --> 	
    	<div class="card card-stats col-md-4 shadow" style="margin-left: 10%; height: 200px;">
         	<a href="profile.php" class="material-icons text-center" style="padding-top: 40px;">
         		<i class="material-icons" style="font-size: 60px">person</i>
            	<h3 class="text-center">Profile</h3>
            </a>
            		
        </div>
<!-- END Profile  -->
<!--  ****** PLATEFORME  ********   --> 	
    	<div class="card card-stats col-md-4 shadow" style="margin-left: 10%; height: 200px;">
         	<a href="plateforme.php" class="material-icons text-center" style="padding-top: 40px;">
         	<i class="material-icons" style="font-size: 60px">business</i>
            	<h3 class="text-center">Plateforme</h3>
            </a>
        </div>
<!-- END PLATEFORME  -->    			
</div>    			
<div class="row">	
	<!--  ****** LISTE AGENTS  ********   --> 
           		<div class="card card-stats col-md-4 shadow" style="margin-left: 10%; height: 200px;">
       				 <a href="ListeAgent.php" class="material-icons text-center" style="padding-top: 40px;">
            			<i class="material-icons" style="font-size: 60px">content_paste</i>
	            
	            		<h3 style="text-align: center;">Liste des Agents</h3>
	            	</a>
		        </div>
<!--  ****** END LISTE AGENTS ********   --> 
<!--  ****** Statistiques  ********   --> 	
    	<div class="card card-stats col-md-4 shadow" style="margin-left: 10%; height: 200px;">
         	<a href="statistique2.php" class="material-icons text-center" style="padding-top: 40px;">
         	<i class="material-icons" style="font-size: 60px">timeline</i>
            	<h3 class="text-center">Statistiques</h3>
            </a>					
       	</div>
<!-- END Statistiques  -->
    </div>
</div>

</body>
</html>