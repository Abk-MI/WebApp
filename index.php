<?php
	session_start();
?>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/css/styles.css" media="screen" type="text/css"/>
</head>
<body>
	<div id="container">
	    <form action="file/verification.php" method="POST">
	        <h1>Connexion</h1>

	        <label><b>Username</b></label>
	        <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>

	        <label><b>Password</b></label>
	        <input type="password" placeholder="Entrer le mot de passe" name="password" required>

	        <input type="submit" name="submit" value='LOGIN' />
	    </form>
	</div>
</body>
</html>
<?php

	if(isset($_SESSION["erreur"])){
		echo "<h3 style='color:red;' class='text-center'> Username ou Password incorrect !</h3>";
	}

	session_destroy();
?>
