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
				<input type='submit' class='btn btn-default' name='search' value='Suchen'>
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
		echo"<thead><tr><th>ID</th><th>Name</th><th>Straße</th><th>PLZ</th><th>Ansprechpartner</th><th>URL</th>";
		if (isset($_SESSION['username']) && $_SESSION['username']== 'Admin') {
			echo"<th></th>";}
		echo"</tr></thead><tbody>";
		while ($row = $res->fetch_array())
		{
			echo "<tr><form method='POST' action='Lieferanten_Neu.php'>";
			echo "<td><input type='hidden' name='id' value='".$row['Lieferant_ID']."'>".$row['Lieferant_ID']."</input></td>";
			echo "<td><input type='hidden' name='name' value='".$row['Name']."'>".$row['Name']."</input></td>";	
			echo "<td><input type='hidden' name='strasse' value='".$row['Strasse']."'>".$row['Strasse']."</input></td>";
			echo "<td><input type='hidden' name='PLZ' value='".$row['PLZ']."'>".$row['PLZ']."</input></td>";
			echo "<td><input type='hidden' name='ansprechpartner' value='".$row['Ansprechpartner']."' >".$row['Ansprechpartner']."</input></td>";
			echo "<td><a href='https://".$row['URL']."'><input type='hidden' name='url' value='".$row['URL']."' >".$row['URL']."</input></a></td>";
			if (isset($_SESSION['username']) && $_SESSION['username']== 'Admin') {
			echo "<td><input type='submit' name='edit' class='btn btn-default' value='Bearbeiten'></td>";}
			echo "</form></tr>";
		}
		echo"</tbody></table>";
	} else{
		echo "Du bist nicht angemeldet! <br> <a href=\"home.php\"><script>window.location = \"login.html\";</script></a>";
	}	
?>
</body>
</html>