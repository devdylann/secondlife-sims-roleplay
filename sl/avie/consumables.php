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
      case "registerFood":
      $sql = "INSERT INTO `avierp`.`consumables` (`serialNo`, `owner_uuid`, `type`, `description`, `qty`, `hunger_effect`, `thirst_effect`, `expires`) VALUES ('".$_POST['foodserial']."', '".$_POST['sluuid']."', '".$_POST['ftype']."', '".$_POST['fdescription']."', '".$_POST['fqty']."', '".$_POST['fhungereffect']."', '".$_POST['fthirsteffect']."', '2020-04-14');";
      $result = $conn->query($sql);
      break;

      case "eatFood":
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

            $sql = "SELECT * FROM players WHERE sl_uuid='" . $_POST['sluuid'] ."'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
              $rphunger= $row["rp_hunger"];
              $rpthirst= $row["rp_thirst"];
              $rpbladder= $row["rp_bladder"];
              $rphealth = $row["rp_health"];
              }

              $sql = "UPDATE players SET rp_hunger, rp_thirst = $rphunger+$_POST['consumedqty']*$fhunger, $rpthirst+$_POST['consumedqty']*$fthirst WHERE sl_uuid = ''".$_POST['sluuid']."''";
              $result = $conn->query($sql);

              if($_POST['consumedqty'] <= $fqty)
              {
                $sql = "UPDATE consumables SET 'qty' = $fqty-$_POST['consumedqty'] WHERE serialNo = $fserial";
                $result = $conn->query($sql);
              }
              else {
                $sql = "UPDATE consumables SET 'qty' = '0' WHERE serialNo = $fserial";
                $result = $conn->query($sql);
              }
            }
            else
            {
              echo "Player Not Found";
            }
          }
        }
        else
        {
          echo "Food Not Found";
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
		}
	$conn->close();
?>
