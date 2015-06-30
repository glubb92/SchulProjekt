<?php
	class addDB
	{
		public $myDB;

		public function openDB()
		{
			if (!isset($this->myDB))
			{		
				$this->myDB = new mysqli("localhost", "root", NULL, "dbproject");
				if ($this->myDB->connect_error) {
					return false;
				}else{
					return true;
				}
			}else{
				return true;
			}
		}
		//Fügt den Lieferanten hin-zu
		public function add_supplier($Name, $Strasse, $PLZ, $Ansprechpartner, $URL)
		{
			$DB = $this->myDB;
			if(!$this->openDB())
			{
				return 'Connect Error: '.$DB->connect_error;
			}

			$Name = $DB->real_escape_string($Name);
			$Strasse = $DB->real_escape_string($Strasse);
			$PLZ = $DB->real_escape_string($PLZ);
			$Ansprechpartner = $DB->real_escape_string($Ansprechpartner);
			$URL = $DB->real_escape_string($URL);
			
			$sql = "INSERT INTO tbllieferant (Name, Strasse, PLZ, Ansprechpartner, URL) VALUES ('".$Name."','".$Strasse."','".$PLZ."','".$Ansprechpartner."','".$URL."')";
			
			if($DB->query($sql) == true)
			{
				return true;
			}else{
				return $DB->error;
			}
		}
	}
	
	
?>