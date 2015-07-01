<html>
<?php
	session_start();
		include'..\Bausteine\get_tables.php';
		$get = new getDB();
	if (isset($_SESSION['username'])) {
		include"Menu.php";
		
		$suchtmp ='Suchbegriff';
		
		echo"<form method='POST' action='#'>
		<div style='max-width: 50%;'>
			<div class='form-group'>
				<input type='text' class='form-control' id='nameInput' name='nameInput' placeholder='".$suchtmp."'>
				<input type='submit' name='search' value='Suchen'>
			</div>
		</div>
		</form>";
					
		$res = $get->get_supplier();
		
		if(isset($_POST) && count($_POST)>0)
		{
			$suchtmp = $_POST['nameInput'];
			$res = $get->search_supplier($suchtmp);
			echo "Ergebnisse für: ". $suchtmp;
		}
		
		
		echo"<table class='zui-table zui-table-rounded' >";
		echo"<thead><tr><th>Name</th><th>Straße</th><th>PLZ</th><th>Ansprechpartner</th><th>URL</th></tr></thead><tbody>";
		while ($row = $res->fetch_array())
		{
			echo "<tr>";
			echo "<td>".$row['Name']."</td>";
			echo "<td>".$row['Strasse']."</td>";
			echo "<td>".$row['PLZ']."</td>";
			echo "<td>".$row['Ansprechpartner']."</td>";
			echo "<td><a href='".$row['URL']."'>".$row['URL']."</a></td>";
			echo "</tr>";
		}
		echo"</tbody></table>";
	} else{
		echo "Du bist nicht angemeldet! <br> <a href=\"home.php\"><script>window.location = \"login.html\";</script></a>";
	}	
?>
</body>
</html>