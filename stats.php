<?php
	session_start();

		if($_SESSION['auth'] != "True") // If session is not set then redirect to Login Page
		 {
			 header( 'Location: login.html' ) ;
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
         $ethnicity = $row["rp_ethnicity"];
				 $sex = $row["rp_sex"];
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
			        <li class="active"><a href="stats.php">Roleplay Profile</a></li>
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
		<?php
		if (empty($_GET)) {
    header('Location: stats.php?section=stats');
		} ?>
	<div class="container">
		<?php if($_GET['section'] == 'stats') : ?>
		<ul class="nav nav-pills">
			<li role="presentation" class="active"><a href="stats.php?section=stats">Stats</a></li>
			<li role="presentation"><a href="stats.php?section=inventory">Inventory</a></li>
			<li role="presentation"><a href="stats.php?section=transactions">Transactions</a></li>
		</ul>
		<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title"><b>SecondLife Info</b></h3>
		  </div>
		  <div class="panel-body">
				<div class="row">
				  <div class="col-md-2"><b>SL UUID:</b></div>
				  <div class="col-md-7"><?php echo $uuid; ?></div>
				</div>
				<div class="row">
				  <div class="col-md-2"><b>SL Username:</b></div>
				  <div class="col-md-7"><?php echo $name; ?></div>
				</div>
				<div class="row">
				  <div class="col-md-2"><b>Register Date:</b></div>
				  <div class="col-md-7"><?php echo $joindate; ?></div>
				</div>
		  </div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><b>Roleplay Info</b></h3>
			</div>
		  <div class="panel-body">
				<div class="row">
				  <div class="col-md-2"><b>Species:</b></div>
				  <div class="col-md-2"><?php echo $species; ?></div>
					<div class="col-md-2"><b>Health:</b></div>
					<div class="col-md-2"><?php echo $health ; ?></div>
				</div>
				<div class="row">
				  <div class="col-md-2"><b>Age:</b></div>
				  <div class="col-md-2"><?php echo $age; ?></div>
					<div class="col-md-2"><b>Hunger:</b></div>
				  <div class="col-md-2"><?php echo $hunger ; ?></div>
				</div>
				<div class="row">
				  <div class="col-md-2"><b>Ethnicity:</b></div>
				  <div class="col-md-2"><?php echo $ethnicity; ?></div>
					<div class="col-md-2"><b>Thirst:</b></div>
				  <div class="col-md-2"><?php echo $thirst ; ?></div>
				</div>
				<div class="row">
					<div class="col-md-2"><b>Gender:</b></div>
					<div class="col-md-2"><?php echo $sex; ?></div>
				  <div class="col-md-2"><b>Hygiene:</b></div>
				  <div class="col-md-2"><?php echo $hygiene ; ?></div>
				</div>
		  </div>
		</div>
	<?php elseif($_GET["section"] == "inventory") : ?>
		<ul class="nav nav-pills">
			<li role="presentation"><a href="stats.php?section=stats">Stats</a></li>
			<li role="presentation" class="active"><a href="stats.php?section=inventory">Inventory</a></li>
			<li role="presentation"><a href="stats.php?section=transactions">Transactions</a></li>
		</ul>
		<div class="panel panel-default">
		  <!-- Default panel contents -->
		  <div class="panel-heading"><b>Consumables Inventory</b></div>

		  <!-- Table -->
		  <table class="table">
		    <tr>
					<th>Serial #</th>
					<th>Type</th>
					<th>Desc.</th>
					<th>Hunger</th>
					<th>Thirst</th>
					<th>Qty</th>
					<th>Expires</th>
				</tr>
				<?php
				$sql = "SELECT * FROM consumables WHERE owner_uuid='" . $_SESSION['uuid'] ."'";
		 		$result = $conn->query($sql);

		 		if ($result->num_rows > 0) {
		 			while($row = $result->fetch_assoc()) {
						echo '<tr>';
		         echo '<td>' . $row["serialNo"] . '</td>';
						 echo '<td>' . $row["type"] . '</td>';
						 echo '<td>' . $row["description"] . '</td>';
						 echo '<td>' . $row["hunger_effect"] . '</td>';
						 echo '<td>' . $row["thirst_effect"] . '</td>';
						 echo '<td>' . $row["qty"] . '</td>';
						 echo '<td>' . $row["expires"] . '</td>';
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
<?php elseif($_GET["section"] == "transactions") : ?>
		<ul class="nav nav-pills">
			<li role="presentation"><a href="stats.php?section=stats">Stats</a></li>
			<li role="presentation"><a href="stats.php?section=inventory">Inventory</a></li>
			<li role="presentation" class="active"><a href="stats.php?section=transactions">Transactions</a></li>
		</ul>
		<div class="panel panel-default">
		  <!-- Default panel contents -->
		  <div class="panel-heading"><b>Account Transactions</b></div>

		  <!-- Table -->
		  <table class="table">
		    <tr>
					<th>Transaction ID</th>
					<th>UUID</th>
					<th>Name</th>
					<th>Purchase Date</th>
					<th>Item</th>
					<th>Price(L$)</th>
				</tr>
				<?php
				$sql = "SELECT * FROM transactions WHERE sl_uuid='" . $_SESSION['uuid'] ."'";
		 		$result = $conn->query($sql);

		 		if ($result->num_rows > 0) {
		 			while($row = $result->fetch_assoc()) {
						echo '<tr>';
		         echo '<td>' . $row["id"] . '</td>';
						 echo '<td>' . $row["sl_uuid"] . '</td>';
						 echo '<td>' . $row["sl_name"] . '</td>';
						 echo '<td>' . $row["purdate"] . '</td>';
						 echo '<td>' . $row["item"] . '</td>';
						 echo '<td>L$' . $row["price"] . '</td>';
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
	<?php endif; ?>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</body>
</html>
