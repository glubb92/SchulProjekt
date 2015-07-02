<?php
	include_once"../bausteine/get_tables.php";
	session_start();
	if (isset($_SESSION['username'])) {
		$valid = true;
		if( isset($_POST['kompID'])){
		
			if( isset($_POST['kompArtID'])){
				$compArt = $_POST['kompArtID'];
			}else{
				$valid = false;
				$compArt = -1;
			}
			if( isset($_POST['kompID'])){
				$compID = $_POST['kompID'];
			}else{
				$valid = false;
				$compID = -1;
			}
			
			$newComp = false;
			
			if($valid){
				$db = new getDB();
				$komponentenDS = $db->get_Komponent($compArt);
				$komponenten = mysqli_fetch_array($komponentenDS);
				$ds = $db->get_all_attributes_with_values($compID,$compArt);
				
				if($compID <= -1){
					$sqlFields = "INSERT INTO tblKomponent (";
					$sqlValues = "values( ";
					
					for($i = 4;$i < mysqli_num_fields( $komponentenDS )-2;$i++){
						$sqlFields.= mysqli_fetch_field_direct($komponentenDS, $i)->name.", ";
						$sqlValues.= "'".$_POST[mysqli_fetch_field_direct($komponentenDS, $i)->name]."', ";
					}
					
					$sqlFields.= "Raum_ID, ";
					$sqlValues.= "'".$_POST['raum']."', ";
					$sqlFields.= "Art_ID, ";
					$sqlValues.= "'".$compArt."', ";
					$sqlFields.= "Lieferant_ID) ";
					$sqlValues.= "'".$_POST['lieferant']."') ";
					$sqlFields.= $sqlValues;
					$compID=$db->queryDML($sqlFields);
					$newComp = true;
				}else{
					$sqlUpdate = "UPDATE tblKomponent SET ";
					for($i = 4;$i < mysqli_num_fields( $komponentenDS )-2;$i++){
						$sqlUpdate.= mysqli_fetch_field_direct($komponentenDS, $i)->name." = '".$_POST[mysqli_fetch_field_direct($komponentenDS, $i)->name]."', ";
					}
					$sqlUpdate.= "Raum_ID = ".$_POST['raum'].", ";
					$sqlUpdate.= "Lieferant_ID = ".$_POST['lieferant'];
					$sqlUpdate.= " WHERE Komponent_ID = ".$compID;
					$db->query( $sqlUpdate);
				}
				
				while($attribut = mysqli_fetch_assoc($ds)){
					if($newComp){
						$sqlUpdate = "INSERT INTO tblzuordnung_attr_komp (Attribut_ID, Komponent_ID, Wert) values ('".$attribut['AttrID']."','".$compID."','".$_POST[$attribut['AttrID']]."')";
						$db->query( $sqlUpdate);
					}else{
						$sqlUpdate = "UPDATE tblzuordnung_attr_komp SET  Wert = '".$_POST[$attribut['AttrID']]."' WHERE Attribut_ID = ".$attribut['AttrID']." and Komponent_ID = ".$compID;
						$db->query( $sqlUpdate);
						/*if (mysqli_error($connection))
						{
							$sqlUpdate = "INSERT INTO tblzuordnung_attr_komp (Attribut_ID, Komponent_ID, Wert) values ('".$attribut['AttrID']."','".$compID."','".$_POST[$attribut['AttrID']]."')";
						}
						$db->query( $sqlUpdate);*/
					}
				}
					$_GET['komponentenart']=$compArt;
					$_GET['komponentenid']=$compID;
					header('Location: komponenten_anzeigen.php?komponentenart='.$compArt.'&komponentenid='.$compID); 
					//include_once"komponenten_anzeigen.php";
				
				
				
			
			}
		}
	}
?>