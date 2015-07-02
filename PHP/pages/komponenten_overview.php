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
	<div class="row">
		<form action="search_komponente.php" method="post">
			<div class="col-xs-10 col-sm-4">
				<input class="form-control" id="search" name="search"/>
				<input type="hidden" class="form-control" name="komponentenArt" value="<?php echo $compArt; ?>"/>
			</div>
			<div class="col-xs-2 col-sm-2">
				<button type="submit" id="searchBtn" class="btn btn-default" ><span class="glyphicon glyphicon-search"></span> Suche</button>
			</div>
		</form>
	</div>
	<div class="row">
		<div class="xs-col-12">
			<table class="zui-table zui-table-rounded">
				<thead>
					<tr>
					<?php
						$headerValid = true;
						$firstData = false;
						$anzahlRows = 0;
						echo "<th>Info</th>";
						while($headerValid){
							$anzahlRows++;
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
						$anzahlRows--;
					?>
					</tr>
				</thead>
				<tbody>
						<?php
							$currentKomp = "-";
							$counter=0;
							while($komponente = mysqli_fetch_assoc($komponenten) ){
								$counter++;
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
											if($counter < $anzahlRows){
												echo "<td>&nbsp;</td>";
											}
											echo "</tr><tr>";
											$counter=0;
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
		</div>
	</div>
<?php
		}
	} else{
		echo "Du bist nicht angemeldet! <br> <a href=\"home.php\"><script>window.location = \"login.html\";</script></a>";
	}	
?>