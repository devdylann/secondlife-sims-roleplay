<?php
  $SECRET = "d448e900-8a77-41c5-93f0-3e782d1867a5";

  if($_POST['secret'] != $SECRET)
  {
    die("Invalid Token!");
  }

  $actiontype = $_POST['actiontype'];
	$sluuid = $_POST['sluuid'];
  $sl_name = $_POST['sl_name'];

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
        $age = $row["rp_age"];
		$sex= $row["rp_sex"];
        $ethnicity = $row["rp_ethnicity"];
		$species = $row["rp_species"];
        $hunger = $row["rp_hunger"];
        $thirst = $row["rp_thirst"];
        $hygiene = $row["rp_hygiene"];
        $health = $row["rp_health"];

		switch($actiontype)
		{

            case "setsex":
            $sql = "UPDATE `avierp`.`players` SET `rp_sex` = '".$_POST['psex']."' WHERE `players`.`sl_uuid` = '".$sluuid ."';";
            $result = $conn->query($sql);
            echo "Gender changed to " . $_POST['psex'];
            break;

            case "setage":
            $sql = "UPDATE `avierp`.`players` SET `rp_age` = '".$_POST['page']."' WHERE `players`.`sl_uuid` = '".$sluuid ."';";
            $result = $conn->query($sql);
            echo "Age changed to " . $_POST['page'];
            break;

            case "setEthnicity":
            $sql = "UPDATE `avierp`.`players` SET `rp_ethnicity` = '".$_POST['pethnicity']."' WHERE `players`.`sl_uuid` = '".$sluuid ."';";
            $result = $conn->query($sql);
            echo "Ethnicity changed to " . $_POST['pethnicity'];
            break;

            case "registerFood":
            $sql = "INSERT INTO `avierp`.`consumables` (`serialNo`, `owner_uuid`, `type`, `description`, `qty`, `hunger_effect`, `thirst_effect`, `expires`) VALUES ('".$_POST['foodserial']."', '".$_POST['sluuid']."', '".$_POST['ftype']."', '".$_POST['fdescription']."', '".$_POST['fqty']."', '".$_POST['fhungereffect']."', '".$_POST['fthirsteffect']."', '2020-04-14');";
            $result = $conn->query($sql);
            break;

					}
			}
		}
		else
		{
		  switch($actiontype)
		  {
			case "newBeta":
			$sql1 = "INSERT INTO `avierp`.`players` (`id`, `sl_uuid`, `sl_name`, `joindate`, `isBanned`, `isBeta`, `isRegistered`, `rp_age`, `rp_ethnicity`, `rp_hunger`, `rp_thirst`) VALUES (NULL, '" . $sluuid . "', '" . $sl_name . "', CURRENT_TIMESTAMP, '0', '1', '0', '0', 'NONE', '100', '100');";
			$result1 = $conn->query($sql1);
			break;
		  }
		}
		$conn->close();
?>
