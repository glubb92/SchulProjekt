<?php
	include_once "connect.php";
	
	class addDB extends connectDB
	{		
	
		public function add_supplier($Name, $Strasse, $PLZ, $Ansprechpartner, $URL)
		{
			
			if(!$this->openDB()){
				return 'Connect Error: '.$this->myDB->connect_error;}	
			$DB = $this->myDB;
			
			$Name = $DB->real_escape_string($Name);
			$Strasse = $DB->real_escape_string($Strasse);
			$PLZ = $DB->real_escape_string($PLZ);
			$Ansprechpartner = $DB->real_escape_string($Ansprechpartner);
			$URL = $DB->real_escape_string($URL);
			
			$sql = "INSERT INTO tbllieferant (Name, Strasse, PLZ, Ansprechpartner, URL) VALUES ('".$Name."','".$Strasse."','".$PLZ."','".$Ansprechpartner."','".$URL."')";
			
			return $this->query($sql);
		}

		public function add_raum($Bezeichung, $Notiz)
		{
			if(!$this->openDB()){
				return 'Connect Error: '.$this->myDB->connect_error;}	
			$DB = $this->myDB;
			
			$Bezeichung = $DB->real_escape_string($Bezeichung);
			$Notiz = $DB->real_escape_string($Notiz);
			
			$sql = "INSERT INTO tblraum (Bezeichnung, Notiz) VALUES ('".$Bezeichung."','".$Notiz."')";
			
			return $this->query($sql);
		}

		public function add_component_type($Bezeichung)
		{
			
			if(!$this->openDB()){
				return 'Connect Error: '.$this->myDB->connect_error;}	
			$DB = $this->myDB;
			
			$Bezeichung = $DB->real_escape_string($Bezeichung);
			
			$sql = "INSERT INTO tblkomponentenart (Bezeichnung) VALUES ('".$Bezeichung."')";
			
			return $this->query($sql);
		}
		
		public function add_component_attribute($Bezeichung, $Einheit, $Art_ID)
		{
			if(!$this->openDB()){
				return 'Connect Error: '.$this->myDB->connect_error;}	
			$DB = $this->myDB;
			
			$Bezeichung = $DB->real_escape_string($Bezeichung);
			$Einheit = $DB->real_escape_string($Einheit);
				
			$sql = "INSERT INTO tblkomponentenattribut (Bezeichnung, Einheit) VALUES ('".$Bezeichung."','".$Einheit."')";
			$this->query($sql);
			
			$sql = "Select * from tblkomponentenattribut where Bezeichnung = '".$Bezeichung."' and Einheit='".$Einheit."'";
			$ret = $this->query($sql);
			$tmp = $ret->fetch_array();
			$Attribut_ID = $tmp['Attribut_ID'];
			
			$sql = "INSERT INTO tblzuordnung_art_attr (Art_ID, Attribut_ID) VALUES ('".$Art_ID."','".$Attribut_ID."')";
			$this->query($sql);
			
		}
	}	
?>