<?php
include_once "connect.php";

class setDB extends connectDB
{	
	// Updates the columns of the supplier
	public function set_supplier($ID = 0, $name, $street, $postcode, $contactname, $url)
	{
		if($ID != 0)
		{
			$Query = "UPDATE tblLieferant
						SET Name='".$name."',Strasse='".$street."',PLZ='".$postcode."',Ansprechpartner='".$contactname."',URL='".$url."'
						WHERE Lieferant_ID = '".$ID."'";
		}
		else
		{
			// No $ID no changes!
		}
		return $this->query($Query);
	}
	
	// Rückgabe aller Räume, oder über die ID einen bestimmten
	public function set_rooms($ID = 0, $label, $note)
	{
		if($ID != 0)
		{
			$Query = 'UPDATE tblRaum
						SET Bezeichnung="'.$label.'", Notiz="'.$note.'"
						WHERE Raum_ID="'.$ID.'"';
		}
		else
		{
			// No $ID no changes!
		}
		return $this->query($Query);
	}
	
	// Set article attribute assignment 
	public function set_attribute_by_art($Art_ID, $Attribut_ID)
	{
		if($Art_ID != 0 && $Attribut_ID != 0){
			$Query = "UPDATE tblZuordnung_art_attr AS zuord
						SET Art_ID='".$Art_ID."',Attribut_ID='".$Attribut_ID."'
						WHERE zuord.Art_ID ='".$ID."'";
		}
		
		return $this->query($Query);
	}
}	
	
	// alter component attributes
	public function set_component_attributes($Att_ID, $description, $unit){
		if($Att_ID!=0){
			$Query = "UPDATE tblkomponentenattribut
						SET Bezeichnung='".$description."',Einheit='".$unit."'
						WHERE Attribut_ID = '".$Att_ID."'";
		}
		return this->query($Query);
	}
	
	// add new component attribute
	public function add_component_attribute($Att_ID, $description, $unit){
		if(isset($description) && isset($unit)){
			$Query = "INSERT INTO tblkomponentenattribut(Bezeichnung, Einheit)
						VALUES('".$description."','".$unit."')";
		}
		return this->query($Query);
	}
?>