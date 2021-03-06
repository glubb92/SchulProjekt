<html>
<?php
	include_once"../bausteine/get_tables.php";
	session_start();
	if (isset($_SESSION['username'])) {
		include"Menu.php";
		$valid = true;
		if( isset($_GET['komponentenart'])){
		
			if( isset($_GET['komponentenart'])){
				$compArt = $_GET['komponentenart'];
			}else{
				$valid = false;
				$compArt = -1;
			}
			if( isset($_GET['komponentenid'])){
				$compID = $_GET['komponentenid'];
			}else{
				$valid = false;
				$compID = -1;
			}
			
			if($valid){
				$db = new getDB();
				$ds = $db->get_all_attributes_with_values($compID,$compArt);
				$komponentenDS = $db->get_Komponent($compID);
				$komponenten = mysqli_fetch_array($komponentenDS);
				?>
				
					<section id="content">
						<div class="row">
							<h1 class="page-header" ><?php echo $komponenten['ArtBez']." ".$komponenten['Bezeichnung'] ?></div>
						</div>
						<div class="row">
				<?php
					for($i = 5;$i < mysqli_num_fields( $komponentenDS );$i++){
				?>
						<div class="col-xs-6">
							<div class="panel panel-default">
								<div class="panel-heading overview-heading"><?php echo  mysqli_fetch_field_direct($komponentenDS, $i)->name ?></div>
								<div class="panel-body">
									<?php echo $komponenten[$i]?> &nbsp;
								</div>
							</div>
						</div>
				<?php
					}
				?>
					<?php
						while($attribut = mysqli_fetch_assoc($ds)){
						
					?>
							<div class="col-xs-6">
								<div class="panel panel-default">
									<div class="panel-heading overview-heading"><?php echo $attribut['Bezeichnung'] ?></div>
									<div class="panel-body">
										<?php if($attribut['Wert'] != ''){echo $attribut['Wert']." ".$attribut['Einheit'];} ?>&nbsp;
									</div>
								</div>
							</div>
					<?php
						}
					?>
						</div>
					<?php
						$teilkomponenten = $db->get_Teilkomponenten($compID);
						if($db->affected_rows()!=0){
					?>
						<div class="row">
							<div class="col-xs-6">
								<div class="panel panel-default">
									<div class="panel-heading overview-heading">Teilkomponenten</div>
									<div class="panel-body">
										<ul>
						<?php
							while($teilkomponente = mysqli_fetch_assoc($teilkomponenten)){
							
						?>					<li>
												<?php if($teilkomponente['kompBezeichnung'] != ''){echo "<a href=\"komponenten_anzeigen.php?komponentenart=".$teilkomponente['art_id']."&komponentenid=".$teilkomponente['teilkomponenten_id']."\" >".$teilkomponente['kompBezeichnung']." - ".$teilkomponente['artBezeichnung']." Vorgang: ".$teilkomponente['vorgangBezeichnung']."</a>";} ?>&nbsp;
											</li>
						<?php
							}
						?>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<?php
							}
						?>
						<?php
							$parentkomponenten = $db->get_Parentkomponenten($compID);
							if($db->affected_rows()!=0){
						?>
							<div class="row">
								<div class="col-xs-6">
									<div class="panel panel-default">
										<div class="panel-heading overview-heading">Übergeordnete Komponenten</div>
										<div class="panel-body">
											<ul>
							<?php
								while($parentkomponente = mysqli_fetch_assoc($parentkomponenten)){
								
							?>					<li>
													<?php if($parentkomponente['kompBezeichnung'] != ''){echo "<a href=\"komponenten_anzeigen.php?komponentenart=".$parentkomponente['art_id']."&komponentenid=".$parentkomponente['komponenten_id']."\" >".$parentkomponente['kompBezeichnung']." - ".$parentkomponente['artBezeichnung']." Vorgang: ".$parentkomponente['vorgangBezeichnung']."</a>";} ?>&nbsp;
												</li>
							<?php
								}
							?>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<?php
								}
							?>
						<div class="row">
							<div class="button-row">
								<?php
								if (isset($_SESSION['username']) && $_SESSION['username'] == 'Admin')
								echo'<a href="komponenten_neu.php?komponentenart='.$compArt.'&komponentenid='.$compID.'" class="btn btn-default">Bearbeiten</a>'
								?>
								<a href="komponenten_overview.php?komponentenart=<?php echo $compArt ?>" class="btn btn-default">Zurück</a>
							</div>
						</div>
					</section>
				<?php
			}
			
		}
		
		
	} else{
		echo "Du bist nicht angemeldet! <br> <a href=\"home.php\"><script>window.location = \"login.html\";</script></a>";
	}	
?>
</body>
</html>