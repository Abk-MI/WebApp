<?php 
session_start();
  if(!isset($_SESSION['user'])){
    header('location: ../index.php');
  }

include("crud.php");
$config = new config("atelcom","root","");
$cruds= new crud($config);
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
          <li class="nav-item active">
            <a class="nav-link" href="">
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
	       	<h3 class="text-center" style="color: white;padding-bottom: 1%;"><strong>User Profile</strong></h3>
		</div>
	</div>
<div class="row">
            <div class="col-md-10" style="margin-left:8% ">
              <div class="card">
                <div class="card-body">
                  <form method="post">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Identifiant (disabled)</label>
                          <input type="text" class="form-control" disabled <?php echo"value='".$_SESSION['user']['id_user']."'";?>>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Poste (disabled)</label>
                          <input type="text" class="form-control" disabled <?php echo"value='".$_SESSION['user']['poste']."'"; ?> >
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Prenom</label>
                          <input type="text" class="form-control" name="prenom" <?php echo"value='".$_SESSION['user']['prenom']."'"; ?> disabled>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Nom</label>
                          <input type="text" class="form-control" name="nom" <?php echo"value='".$_SESSION['user']['nom']."'"; ?> disabled>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Pseudo</label>
                          <input type="text" class="form-control" name="pseudo" <?php echo"value='".$_SESSION['user']['pseudo']."'"; ?> disabled>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Username</label>
                          <input type="text" class="form-control" name="username" <?php echo"value='".$_SESSION['user']['username']."'"; ?> disabled>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Mot de passe</label>
                          <input type="password" name="mtp" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Nouveau Mot de passe</label>
                          <input type="password" name="nv_mtp" class="form-control">
                        </div>
                      </div>
                    </div>
                    
                    <button type="submit" name="confirmer" class="btn btn-primary pull-right">Confirmer</button>
                  </form>
                  <?php 				
						if(isset($_POST['confirmer'])){
							if(!empty($_POST['mtp'])){
								if($cruds->verif($_SESSION['user']['id_user'],$_POST['mtp'])){
									if(!empty($_POST['nv_mtp'])){
										$cruds->nouveaumtp($_SESSION['user']['id_user'],$_POST['nv_mtp']);
										echo"<h3 class='text-success'>Nouveau Mot de passe Effectué!</h3>";
									}else{
										echo"<h3 class='text-danger'>Saisir le nouveau Mot de passe!</h3>";
									}
								}else{
									echo"<h3 class='text-danger'>Mot de passe incorrect!</h3>";
								}
							}
						}
					?>
                </div>
              </div>
            </div>
	</div>
</div>
</div>
</body>
</html>            

