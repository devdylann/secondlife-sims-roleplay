<?php
  $SECRET = "d448e900-8a77-41c5-93f0-3e782d1867a5";

  if($_POST['secret'] != $SECRET)
  {
    die("Invalid Token!");
  }

	$actiontype = $_POST['actiontype'];
	$sluuid = $_POST['sluuid'];

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

		switch($actiontype)
		{
      case "foodData":
				$sql = "SELECT * FROM consumables WHERE serialNo='" . $_POST['fserial'] ."'";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) {
				$fserial= $row["serialNo"];
        $fowner= $row["owner_uuid"];
        $ftype = $row["type"];
        $fqty= $row["qty"];
        $fhunger= $row["hunger_effect"];
        $fthirst= $row["thirst_effect"];
        $fexpries= $row["expires"];

        echo "serialNo," . $fserial . ",owner," . $fowner . ",type," . $ftype . ",qty," . $fqty . ",hunger_effect," . $fhunger . ",thirst_effect," . $fthirst . ",expires," . $fexpires;

					}
				}
				else
				{
					echo "Food Not Found";
				}
			break;
		}
	$conn->close();
?>
