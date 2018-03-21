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
      case "checkcharacter":
        $sql = "SELECT hasCharacter FROM players WHERE sl_uuid='" . $sluuid ."'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
        $hasCharacter = $row["hasCharacter"];
            echo $hasCharacter;
          }
        }
        else
        {
          echo "Invalid Player";
        }
      break;

      case "verifyplayer":
        $sql = "SELECT sl_uuid FROM players WHERE sl_uuid='" . $sluuid ."'";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					// output data of each row
  					while($row = $result->fetch_assoc()) {
    				$uuid = $row["sl_uuid"];
            echo "Verified";
					}
				}
				else
				{
					echo "Invalid";
				}
      break;

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

			case "grabData":
				$sql = "SELECT * FROM players WHERE sl_uuid='" . $sluuid ."'";
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
        $hasCharacter = $row["hasCharacter"];
				$age = $row["rp_age"];
				$sex= $row["rp_sex"];
				$ethnicity = $row["rp_ethnicity"];
				$species = $row["rp_species"];
				$hunger = $row["rp_hunger"];
				$thirst = $row["rp_thirst"];
				$hygiene = $row["rp_hygiene"];
				$health = $row["rp_health"];

					echo "id," . $avieid . ",sl_uuid," . $uuid . ",sl_name," . $name . ",joindate," . $joindate . ",isBanned," . $isBanned . ",isBeta," . $isBeta . ",isRegistered," . $isRegistered . ",age," . $age .",sex," . $sex . ",ethnicity," . $ethnicity . ",hunger," . $hunger . ",thirst," . $thirst . ",species," . $species . ",hygiene," . $hygiene . ",health," . $health . ",hasCharacter," . $hasCharacter;
					}
				}
				else
				{
					echo "Invalid Player";
				}
			break;
		}
	$conn->close();
?>
