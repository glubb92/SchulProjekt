<?php
	include"connect.php";
	
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
			
			return this->query($sql);
		}

		public function add_Raum($Bezeichung, $Notiz)
		{
			if(!$this->openDB()){
				return 'Connect Error: '.$this->myDB->connect_error;}	
			$DB = $this->myDB;
			
			$Bezeichung = $DB->real_escape_string($Bezeichung);
			$Notiz = $DB->real_escape_string($Notiz);
			
			$sql = "INSERT INTO tblraum (Bezeichnung, Notiz) VALUES ('".$Bezeichung."','".$Notiz."')";
			
			return this->query($sql);
		}

		public function add_Kompart($Bezeichung)
		{
			
			if(!$this->openDB()){
				return 'Connect Error: '.$this->myDB->connect_error;}	
			$DB = $this->myDB;
			
			$Bezeichung = $DB->real_escape_string($Bezeichung);
			
			$sql = "INSERT INTO tblkomponentenart (Bezeichnung) VALUES ('".$Bezeichung."')";
			
			return this->query($sql);
		}
		
		public function add_Kompattribut($Bezeichung, $Einheit)
		{
			
			if(!$this->openDB()){
				return 'Connect Error: '.$this->myDB->connect_error;}	
			$DB = $this->myDB;
			
			$Bezeichung = $DB->real_escape_string($Bezeichung);
			$Einheit = $DB->real_escape_string($Einheit);
			
			$sql = "INSERT INTO tblkomponentenattribut (Bezeichnung, Einheit) VALUES ('".$Bezeichung."','".$Einheit."')";
			
			return this->query($sql);
		}
	}
	
	
?>