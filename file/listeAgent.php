<?php
session_start();
  if(!isset($_SESSION['user'])){
    header('location: ../index.php');
  }else if($_SESSION['user']['poste']!="admin"){
  	header('location: dashboard.php');
  }
?>
<html>
<head>
 <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="../assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />

	<title>Liste Agents</title>
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
            <a class="nav-link" href="dashboard_admin.php">
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
          <li class="nav-item active">
            <a class="nav-link" href="">
              <i class="material-icons">content_paste</i>
              <p>Liste des Agents</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="statistique2.php">
              <i class="material-icons">timeline</i>
              <p>Statistiques</p>
            </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="plateforme.php">
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
	<div class="card card-stats  col-md-10" style="margin-left: 8%;background-color: #6B1A6A;">
       	<h3 class="text-center" style="color: white;padding-bottom: 1%;"><strong>Liste Des Agents</strong></h3>
	</div>
</div>
<div class="row">
	<div class=" col-md-10 " style="margin-left: 8%;">
	<?php	
		include("crud.php");
		$config = new config("atelcom","root","");
		$cruds= new crud($config);
		echo"<div class='card card-stats shadow'>";
			$resultat = $cruds->All_User();
		echo "<table border='1' class='table-hover col-md-12 table-bordered '>
		<tr>
			<th class='text-center'>#</th>
			<th class='text-center'>Nom</th>
			<th class='text-center'>Prenom</th>
			<th class='text-center'>Poste</th>
			<th class='text-center'>Connecter</th>
		</tr>";
	
		foreach($resultat as $i){
		$id=$i['Id_user'];
			echo"<tr>
				<td class='text-center'>".$id."</td>
				<td class='text-center'>".$i['Nom']."</td>
				<td class='text-center'>".$i['Prenom']."</td> 
				<td class='text-center'>".$i['Poste']."</td>"; 	
			if($cruds->isConnect($id)){
					echo"<td class='text-center'><input type='button' class='btn btn-success rounded-circle'/>	</td></tr>";
				}else{
					echo"<td class='text-center'><input type='button' class='btn btn-danger rounded-circle'/>	</td></tr>";
				}
		}		
		echo "</form></table></div>";
		
	?>
	</div>
</div>
</div>
</div>
</body>
</html>
