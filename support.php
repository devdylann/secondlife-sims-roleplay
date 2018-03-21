<?php   session_start();

if($_SESSION['auth'] != "True") // If session is not set then redirect to Login Page
 {
	 header( 'Location: login.html' ) ;
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
							<?php
									if($_SESSION['auth'] == "True") // If session is not set then redirect to Login Page
									 {
										 echo'<li><a href="stats.php">Roleplay Profile</a></li>';
									 }
							 ?>
							 <li><a href="instructions.php">Instructions</a></li>
							 <li class="active"><a href="support.php">Submit a Ticket</a></li>
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
					  <!---  <li class="dropdown">
					      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account <b class="caret"></b></a>
					      <ul class="dropdown-menu">
					        <li><a href="login.html">Login</a></li>
									<li><a href="#">Login Off</a></li>
									<li role="separator" class="divider"></li>
									<li><a href="#">Change Password</a></li> --->
			    </div><!-- /.navbar-collapse -->
			  </div><!-- /.container-fluid -->
			</nav>
			</div>
		</header>
	<div class="container">
		<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title">Support Ticket</h3>
		  </div>
		  <div class="panel-body">
				<div class="panel-body">
					<form id="login-form" action="support_processing.php" method="post">
						<div class="form-group">
							<?php echo '<b>SL UUID:</b><br> '. $_SESSION['uuid']?>
						</div>
						<div class="form-group">
							<?php echo '<b>SL Username:</b><br> '. $_SESSION['user']?>
						</div>
					  <div class="form-group">
					    <label for="username">Issue:</label>
					    <input type="text" name="username" id="username" class="form-control"/>
					  </div>
						<div class="form-group">
					    <label for="username">Description:</label>
							<textarea class="form-control" rows="3"></textarea>
					  </div>
					  <button type="submit" id="support-button" value="support"class="btn btn-default">Submit</button>
					</form>
		  </div>
		</div>
	</div>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</body>
</html>
