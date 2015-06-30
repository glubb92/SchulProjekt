<?php
	function get_supplier($ID = 0)
	{
		if($ID == 0)
		{
			$Query = 'SELECT * FROM tblLieferant';
		}
		else
		{
			$Query = "SELECT * FROM tblLieferant WHERE Lieferant_ID = '".$ID."'";
		}
		$Result = mysql_query($Query);
		return $Result;
	}
	
	function get_rooms($ID = 0)
	{
		if($ID == 0)
		{
			$Query = 'SELECT * FROM tblRaum';
		}
		else
		{
			$Query = "SELECT * FROM tblRaum WHERE Raum_ID = '".$ID."'";
		}
		$Result = mysql_query($Query);
		return $Result;
	}
	
	//Räume
	function get_rooms_on_floor($floor)
	{
		$floor = $floor * 100;
		$temp = $floor + 100;
		$Query = "SELECT * FROM tblRaum WHERE Bezeichnung > '".$floor."' AND Bezeichnung < '".$temp."'";
		var_dump($Query);
		$Result = mysql_query($Query);
		return $Result;
	}
	
	// Funktion um alle Komponenten eines Raumes über die RaumID anzeigen zu lassen 
	function get_component_by_room($roomid)
	{
		$Query = "SELECT  
					tblRaum.Bezeichnung, tblRaum.Notiz, 
					tblKomponentenart.Bezeichnung,
					komp.Hersteller, komp.Notiz, komp.Einkaufsdatum, komp.Gewaehrleistungsdauer,
					tblLieferant.Name
					FROM tblKomponent AS komp 
					INNER JOIN tblRaum ON tblRaum.Raum_ID = komp.Raum_ID
					INNER JOIN tblKomponentenart ON tblKomponentenart.Art_ID = komp.Art_ID
					INNER JOIN tblLieferant ON tblLieferant.Lieferant_ID = komp.Lieferant_ID
					WHERE komp.Raum_ID = ".$roomid."";
		$Result = mysql_query($Query);
		
		return $Result;
	}
?>