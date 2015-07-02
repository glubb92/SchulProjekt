<?php
	include_once "../bausteine/get_tables.php";
	session_start();
	if (isset($_SESSION['username'])) {
		$valid = true;
		include_once"Menu.php";
		if( isset($_GET['komponentenart'])){
			$compArt = $_GET['komponentenart'];
		}else{
			$valid = false;
			$compArt = -1;
		}
		
		if($valid){
			$db = new getDB();
			
			$komponenten = $db->get_All_Komponenten_With_Attributes($compArt);
			
			$komponenten2 = $db->get_KomponentenArt($compArt);
			$header = mysqli_fetch_assoc($komponenten2);
			echo "<section id='content'>
			<div class='row'>
				<h1 class='page-header' >".$header['ArtBez']."</h1>
			</div>";		
	?>
		
		<table class="zui-table zui-table-rounded">
			<thead>
				<tr>
				<?php
					$headerValid = true;
					$firstData = false;
					echo "<th>Info</th>";
					while($headerValid){
						$komponente = mysqli_fetch_assoc($komponenten);
						if($komponente['Komponent_ID'] != ""){
							$headerValid = false;
							$firstData = true;
							$firstDS = $komponente;
						}
						
						if($headerValid){
							echo "<th>".$komponente['Bezeichnung']."</th>";
						}
					}
				?>
				</tr>
			</thead>
			<tbody>
					<?php
						$currentKomp = "-";
						while($komponente = mysqli_fetch_assoc($komponenten) ){
							if($firstData){
								$firstData = false;
								echo "<tr>";
								echo "<td><a href=\"komponenten_anzeigen.php?komponentenart=".$compArt."&komponentenid=".$firstDS['Komponent_ID']."\">".$firstDS['Bezeichnung_Komponente']." ".$firstDS['Hersteller']."</a></td>";
								echo "<td>".$firstDS['Wert']." ".$firstDS['Einheit']."</td>";
								$currentKomp= $komponente['Komponent_ID'];
							}
							
								if($komponente['Komponent_ID'] != $currentKomp){
									if($currentKomp == "-"){
										echo "<tr>";
									}else{
										echo "</a></tr><tr>";
									}
									$currentKomp = $komponente['Komponent_ID'];
									echo "<td><a href=\"komponenten_anzeigen.php?komponentenart=".$compArt."&komponentenid=".$komponente['Komponent_ID']."\">".$komponente['Bezeichnung_Komponente']." ".$komponente['Hersteller']."</a></td>";
									echo "<td>".$komponente['Wert']." ".$komponente['Einheit']."</td>";
								}else{
									echo "<td>".$komponente['Wert']." ".$komponente['Einheit']."</td>";
								}
						}
						if($firstData){
							echo "<tr>";
							echo "<td><a href=\"komponenten_anzeigen.php?komponentenart=".$compArt."&komponentenid=".$firstDS['Komponent_ID']."\">".$firstDS['Bezeichnung_Komponente']." ".$firstDS['Hersteller']."</a></td>";
							echo "<td>".$firstDS['Wert']." ".$firstDS['Einheit']."</td>";
						}
					?>
						</a></tr>
			</tbody>
		</table>
<?php
		}
	} else{
		echo "Du bist nicht angemeldet! <br> <a href=\"home.php\"><script>window.location = \"login.html\";</script></a>";
	}	
?>