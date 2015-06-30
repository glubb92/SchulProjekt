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
	}
	
	
?>