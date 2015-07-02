<?php
include"connect.php";

class getDB extends connectDB
{	
	// Rückgabe aller Lieferanten, oder über die ID einen bestimmten
	public function get_supplier($ID = 0)
	{
		if($ID == 0) // Alle Lieferanten
		{
			$Query = 'SELECT * FROM tblLieferant';
		}
		else	// Lieferant nach ID
		{
			$Query = "SELECT * FROM tblLieferant WHERE Lieferant_ID = '".$ID."'";
		}
		return $this->query($Query);
	}
	
	//sucht in der Ganzen Tabelle Lieferanten nach dem Begriff
	public function search_supplier($ID)
	{
		$Query = "SELECT * FROM tblLieferant WHERE Name like '%".$ID."%' or Strasse like '%".$ID."%' or PLZ like '%".$ID."%' or Ansprechpartner like '%".$ID."%' or URL like '%".$ID."%'";
		return $this->query($Query);
	}
	// Rückgabe aller Räume, oder über die ID einen bestimmten
	public function get_rooms($ID = 0)
	{
		if($ID == 0)	// Alle Räume
		{
			$Query = 'SELECT * FROM tblRaum ORDER BY Bezeichnung';
		}
		else	// Raum nach ID
		{
			$Query = "SELECT * FROM tblRaum WHERE Raum_ID = '".$ID."'";
		}
		return $this->query($Query);
	}
	
	//Rückgabe der Räume anhand vom Stockwerk
	public function get_rooms_on_floor($floor)
	{
		// Stockwerk wird  * 100 genommen, da die Raumbezeichnung eine 3-Stellige Zahl ist und die erste Stelle das Stockwerk symbolisiert
		$floor = $floor * 100;
		$temp = $floor + 100;
		$Query = "SELECT * FROM tblRaum WHERE Bezeichnung > '".$floor."' AND Bezeichnung < '".$temp."'";
		var_dump($Query);
		return $this->query($Query);
	}
	
	//Alle dynamischen Attribute einer Komponentenart
	public function get_attribute_by_art($ID)
	{
		$Query = "SELECT attr.* FROM tblZuordnung_art_attr AS zuord
					INNER JOIN tblKomponentenattribut AS attr ON attr.Attribut_ID = zuord.Attribut_ID
					WHERE zuord.Art_ID = ".$ID."";
		return $this->query($Query);
	}	
	
	//Rückgabe bestimmter Software
	public function get_software($bez)
	{
		$Query = "SELECT komp.Komponent_ID, komp.Bezeichnung, attr.Bezeichnung, zuord.Wert, attr.Einheit FROM tblKomponent as komp
					INNER JOIN tblKomponentenart as art ON komp.Art_ID = art.Art_ID
					LEFT JOIN tblZuordnung_attr_komp as zuord ON komp.Komponent_ID = zuord.Komponent_ID
					INNER JOIN tblZuordnung_art_attr as zuord2 ON komp.Art_ID = zuord2.Art_ID
					INNER JOIN tblKomponentenattribut as attr ON zuord2.Attribut_ID = attr.Attribut_ID
					WHERE art.Bezeichnung = 'Software' AND komp.Bezeichnung LIKE '%".$bez."%'";
		return $this->query($Query);
	}
	// Rückgabe aller Räume und deren Komponenten, in denen vorhandene Komponenten eine bestimmte Bezeichnung besitzen
	public function get_rooms_by_component($bez)
	{
		//Erster Select: Alle Computer, bei denen die Suche auf ein Teilkomponent zutrifft
		// union: mergen von beiden Ergebnissen in eines
		//Zweiter Select: Alle Computer, auf die die Suchbedingung an sich zutrifft
		$Query = "(SELECT zuord.Komponent_ID as compID, comp.raum_id as Raum_ID, room.Bezeichnung as Bezeichnung,room.notiz, comp1.Bezeichnung as bez FROM tblKomponent as comp
					INNER JOIN tblZuordnung_komp_vorgang as zuord ON comp.Komponent_ID = zuord.Teilkomponenten_ID
					INNER JOIN tblKomponent AS comp1 ON zuord.Komponent_ID = comp1.Komponent_ID 
					INNER JOIN tblRaum AS room ON comp1.Raum_ID = room.Raum_ID
					WHERE comp.Bezeichnung LIKE '%".$bez."%' AND comp1.Art_ID = (SELECT art_id from tblKomponentenart where bezeichnung like 'Computer'))
					union 
					(SELECT comp.Komponent_ID as compID , comp.raum_id as Raum_ID , room.Bezeichnung as Bezeichnung,room.Notiz, comp.Bezeichnung as bez FROM tblKomponent as comp 
					INNER JOIN tblRaum AS room ON comp.Raum_ID = room.Raum_ID
					WHERE comp.Bezeichnung LIKE '%".$bez."%' AND comp.Art_ID = (SELECT art_id from tblKomponentenart where bezeichnung like 'Computer')) ORDER BY Raum_ID,compID ";
		return $this->query($Query);
	}
	
	// Gibt einen Raum zurück, wenn ein Komponent in "Bezeichnung" dem Suchbegriff übereinstimmt
	public function get_room_by_search($bez)
	{
			$Query = "SELECT room.* FROM tblRaum AS room
						LEFT JOIN  tblKomponent as comp ON room.Raum_ID = comp.Raum_ID
						LEFT JOIN  tblKomponentenart as art ON art.Art_ID = comp.Art_ID
						WHERE comp.Bezeichnung LIKE '%".$bez."%'
						OR    room.Bezeichnung LIKE '%".$bez."%'
						OR    room.Notiz LIKE '%".$bez."%'
						OR    art.Bezeichnung LIKE '%".$bez."%'
						GROUP BY room.Raum_ID 
						ORDER BY room.Bezeichnung";
			return $this->query($Query);
	}
	// Funktion um alle Komponenten , die kein Teilkomponent sind, eines Raumes über die RaumID anzeigen zu lassen 
	public function get_components_by_room($roomid) 
	{
		$Query = "SELECT  
					komp.Komponent_ID AS KompID, 
					tblKomponentenart.Bezeichnung AS ArtBezeichnung, tblKomponentenart.Art_ID AS ArtID, 
					komp.Hersteller, komp.Bezeichnung AS KompBezeichnung, komp.Notiz, komp.Einkaufsdatum, komp.Gewaehrleistungsdauer,
					tblLieferant.Name
					FROM tblKomponent AS komp 
					INNER JOIN tblRaum ON tblRaum.Raum_ID = komp.Raum_ID
					INNER JOIN tblKomponentenart ON tblKomponentenart.Art_ID = komp.Art_ID
					INNER JOIN tblLieferant ON tblLieferant.Lieferant_ID = komp.Lieferant_ID
					LEFT JOIN tblZuordnung_komp_vorgang as zuord ON komp.Komponent_ID = zuord.Teilkomponenten_ID
					WHERE komp.Raum_ID = ".$roomid." AND zuord.Teilkomponenten_ID IS NULL";
		return $this->query($Query);
	}
	
	// Zählt alle Komponenten in einem Raum nach Komponentenart sortiert
	public function count_roomcomponents_by_art($roomid, $artid)
	{
		$Query = "SELECT count(Komponent_ID) AS Anzahl FROM tblKomponent
					WHERE Raum_ID = ".$roomid." 
					AND Art_ID = ".$artid."
					GROUP BY Art_ID";
		return $this->query($Query);
	}
	
	// Zählt alle Komponenten in einem Raum, welche keine Teilkomponenten eines anderen Komponents sind
	public function count_roomcomponents($roomid)
	{
		$Query = "SELECT count(komp.Komponent_ID) AS Anzahl FROM tblKomponent AS komp
					LEFT JOIN tblZuordnung_komp_vorgang as zuord ON komp.Komponent_ID = zuord.Teilkomponenten_ID
					WHERE Raum_ID = ".$roomid." 
					AND zuord.Teilkomponenten_ID IS NULL";
		return $this->query($Query);
	}
	
	//Rückgabe aller dynamisch verwalteten attribute von einem Komponent
	public function get_component_attributes($ID)
	{
		$Query = "SELECT zuord.attribut_ID, attr.Bezeichnung, zuord.Wert,attr.Einheit FROM tblZuordnung_attr_komp AS zuord
					INNER JOIN tblKomponentenattribut AS attr ON zuord.Attribut_ID = attr.Attribut_ID
					WHERE zuord.Komponent_ID = ".$ID."";
		return $this->query($Query);
	}
	
	// Rückgabe aller Vorgangsarten, oder über die ID einen bestimmten
	public function get_procedure($ID = 0)
	{
		if($ID == 0)	// Alle Vorgansarten
		{
			$Query = 'SELECT * FROM tblVorgangsart';
		}
		else	// Vorgangsart nach ID
		{
			$Query = "SELECT * FROM tblVorgangsart WHERE Vorgang_ID = '".$ID."'";
		}
		return $this->query($Query);
	}
	
		// Rückgabe aller Komponentenarten, oder über die ID einen bestimmten
	public function get_component_art($ID = 0)
	{
		if($ID == 0)	// Alle Komponentenarten
		{
			$Query = 'SELECT * FROM tblkomponentenart';
		}
		else	// Komponentenarten nach ID
		{
			$Query = "SELECT * FROM tblkomponentenart WHERE Art_ID = '".$ID."'";
		}
		return $this->query($Query);
	}
}
?>