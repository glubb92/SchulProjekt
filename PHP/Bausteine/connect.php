<?php
	class connectDB
	{
		protected $myDB;

		public function openDB()
		{
			if (!isset($this->myDB))
			{		
				$this->myDB = new mysqli("localhost", "root", NULL, "dbproject");
				if ($this->myDB->connect_error) {
					echo 'Connect Error: '.$this->myDB->connect_error;
					return false;
				}else{
					return true;
				}
			}else{
				return true;
			}
		}
		
		public function query($sql)
		{
			if(!$this->openDB()){
				return 'Connect Error: '.$this->myDB->connect_error;
			}	
			$DB = $this->myDB;
			if($DB->query($sql) == true)
			{
				return true;
			}else{
				return $DB->error;
			}
		}	
	}
	
	
?>