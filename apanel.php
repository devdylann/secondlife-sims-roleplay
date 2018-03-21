<?php
	session_start();

		if($_SESSION['isadmin'] != "1") // If session is not set then redirect to Login Page
		 {
			 header( 'Location: index.php' ) ;
		 }

 	$servername = "localhost";
 	$username = "root";
 	$password = "*bu4PW2;tDad:t{X";
 	$dbname = "avierp";
 		// Create connection
 		$conn = new mysqli($servername, $username, $password, $dbname);
 		// Check connection
 		if ($conn->connect_error) {
 			die("Connection failed: " . $conn->connect_error);
 		}

 		$sql = "SELECT * FROM players WHERE sl_uuid='" . $_SESSION['uuid'] ."'";
 		$result = $conn->query($sql);

 		if ($result->num_rows > 0) {
 			// output data of each row
 			while($row = $result->fetch_assoc()) {
				$avieid = $row["id"];
        $uuid = $row["sl_uuid"];
        $name = $row["sl_name"];
        $joindate = $row["joindate"];
        $isBanned = $row["isBanned"];
        $isBeta = $row["isBeta"];
        $isRegistered = $row["isRegistered"];
        $age = $row["rp_age"];
	      $sex= $row["rp_sex"];
        $ethnicity = $row["rp_ethnicity"];
	      $species = $row["rp_species"];
        $hunger = $row["rp_hunger"];
        $thirst = $row["rp_thirst"];
        $hygiene = $row["rp_hygiene"];
        $health = $row["rp_health"];

 			}
 		}
 		else
 		{
 			echo "Invalid Player";
 		}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>AvieRP HUD</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">

	<script src="js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>
<body>
	<header>
		<div class="container">
			<img src="img/logo.png">
			<nav class="navbar-inverse navbar-default">
			  <div class="container-fluid">
			    <!-- Brand and toggle get grouped for better mobile display -->
			    <div class="navbar-header ">
			      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			    </div>

			    <!-- Collect the nav links, forms, and other content for toggling -->
			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			      <ul class="nav navbar-nav">

			        <li><a href="index.php"><span class="glyphicon glyphicon-home"></span></a></li>
			        <li><a href="stats.php">Roleplay Profile</a></li>
							<li><a href="instructions.php">Instructions</a></li>
			      </ul>
						<?php
						if($_SESSION['auth'] == "True") // If session is not set then redirect to Login Page
			       {
								echo'
								<ul class="nav navbar-nav navbar-right">
								<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome, ' . $_SESSION["user"] . ' <b class="caret"></b></a>
										<ul class="dropdown-menu">';
										if($_SESSION['isadmin'] == "1"){echo'<li><a href="apanel.php">Admin</a></li>';}
											echo'<li><a href="logoff.php">Login Off</a></li>
											<li role="separator" class="divider"></li>
											<li><a href="#">Change Password</a></li>
										</ul>
									</li>
								</ul>';
							}
							else {
								echo'
								<ul class="nav navbar-nav navbar-right">
								<li class="dropdown">
										<li><a href="login.html">Login</a></li>
									</li>
								</ul>';
							}
						?>
			    </div><!-- /.navbar-collapse -->
			  </div><!-- /.container-fluid -->
			</nav>
			</div>
		</header>
	<div class="container">
		<div class="panel panel-default">
		  <!-- Default panel contents -->
		  <div class="panel-heading"><b>Player Database</b></div>

		  <!-- Table -->
		  <table class="table">
		    <tr>
					<th>SL UUID</th>
					<th>SL NAME</th>
					<th>JOINED</th>
					<th>isBanned</th>
					<th>isBeta</th>
					<th>isRegistered</th>
					<th>RP Age</th>
					<th>RP Ethnicity</th>
					<th>RP Species</th>
					<th>RP Hunger</th>
					<th>RP Hygiene</th>
					<th>RP Health</th>
					<th>Last Update</th>
					<th>Version</th>
				</tr>
				<?php
				$sql = "SELECT * FROM players";
		 		$result = $conn->query($sql);

		 		if ($result->num_rows > 0) {
		 			while($row = $result->fetch_assoc()) {
						echo '<tr>';
		         echo '<td>' . $row["sl_uuid"] . '</td>';
						 echo '<td>' . $row["sl_name"] . '</td>';
						 echo '<td>' . $row["joindate"] . '</td>';
						 echo '<td>' . $row["isBanned"] . '</td>';
						 echo '<td>' . $row["isBeta"] . '</td>';
						 echo '<td>' . $row["isRegistered"] . '</td>';
						 echo '<td>' . $row["rp_age"] . '</td>';
						 echo '<td>' . $row["rp_ethnicity"] . '</td>';
						 echo '<td>' . $row["rp_species"] . '</td>';
						 echo '<td>' . $row["rp_hunger"] . '</td>';
						 echo '<td>' . $row["rp_hygiene"] . '</td>';
						 echo '<td>' . $row["rp_health"] . '</td>';
						 echo '<td>' . $row["lastupdate"] . '</td>';
						 echo '<td>' . $row["hudversion"] . '</td>';

		         /*$c_uuid = $row["owner_uuid"];
		         $c_type = $row["type"];
		         $c_qtyremain = $row["qty_remaining"];
		         $c_expires = $row["expires"];*/
					echo '</tr>';
		 			}
		 		}
		 		$conn->close();

					/*echo'<tr>
						<td>'. $c_serialno . '</td>
						<td>' . $c_type .'</td>
						<td>' .$c_qtyremain .'</td>
						<td>' . $c_expires .'</td>
					</tr>';*/
				?>
		  </table>
		</div>
	</div>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</body>
</html>
