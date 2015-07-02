<?php
	class connectDB
	{
		protected $myDB;

		public function openDB()
		{
			if (!isset($this->myDB))
			{		
				$this->myDB = new mysqli("localhost", "root", "", "dbproject");
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
			$res = $DB->query($sql);
			if($DB->connect_errno == 0)
			{
				return $res;
			}else{
				return $DB->error;
			}
		}	
		
				
		public function queryDML($sql)
		{
			if(!$this->openDB()){
				return 'Connect Error: '.$this->myDB->connect_error;
			}	
			$DB = $this->myDB;
			$res = $DB->query($sql);
			if($DB->connect_errno == 0)
			{
				return $this->myDB->insert_id ;
			}else{
				return $DB->error;
			}
		}

		public function affected_rows(){
			return $this->myDB->affected_rows ;
		}		
	}
	
	
?>