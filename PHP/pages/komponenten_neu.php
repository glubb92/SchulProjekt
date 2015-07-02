<html>
<?php
	include_once "../bausteine/get_tables.php";
	session_start();
	if (isset($_SESSION['username'])) {
		include_once"Menu.php";
		$valid = true;
		if( isset($_GET['komponentenid'])){
		
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
				$raueme = $db->get_rooms();
				$lieferanten = $db->get_supplier();
				$komponentenDS = $db->get_Komponent($compID);
				$komponenten = mysqli_fetch_array($komponentenDS);
				$ds = $db->get_all_attributes_with_values($compID,$compArt);
?>
				
					<section id="content">
						<div class="row">
							<h1 class="page-header" ><?php echo $komponenten['ArtBez']." ".$komponenten['Bezeichnung'] ?></div>
						</div>
						<form action="saveKomponente.php" method="post">
							<input type="hidden" name="kompID" value="<?php echo $compID ?>" />
							<input type="hidden" name="kompArtID" value="<?php echo $compArt ?>" />
							<div class="row">
							
				<?php
					for($i = 4;$i < mysqli_num_fields( $komponentenDS )-2;$i++){
				?>
						<div class="col-xs-6">
							<div class="form-group">
								<label for="<?php echo  mysqli_fetch_field_direct($komponentenDS, $i)->name ?>">
									<?php echo  mysqli_fetch_field_direct($komponentenDS, $i)->name ?>
								</label>
								<input type="text" class="form-control" name ="<?php echo  mysqli_fetch_field_direct($komponentenDS, $i)->name ?>" 
								id="<?php echo  mysqli_fetch_field_direct($komponentenDS, $i)->name ?>" 
								placeholder="<?php echo  mysqli_fetch_field_direct($komponentenDS, $i)->name?>" 
								value="<?php echo  $komponenten[$i]; ?>" />
							</div>
						</div>
				<?php
					}
				?>
				
						<div class="col-xs-6">
							<div class="form-group">
								<label for="bspInput">Raum</label>
								<select class="form-control" name="raum" >
								<?php
									while($raum = mysqli_fetch_assoc($raueme)){
								?>
									<option value="<?php echo $raum['Raum_ID'] ?>" <?php if($komponenten[9] == $raum['Bezeichnung']){echo "selected";}?> ><?php echo $raum['Bezeichnung']." ".$raum['Notiz'] ?></option>
								<?php
									}
								?>
								</select>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="form-group">
								<label for="bspInput">Lieferant</label>
								<select class="form-control" name="lieferant" >
								<?php
									while($lieferant = mysqli_fetch_assoc($lieferanten)){
								?>
									<option value="<?php echo $lieferant['Lieferant_ID']; ?>" <?php if($komponenten[10]== $lieferant['Name']){echo "selected";}?>><?php echo $lieferant['Name']; ?></option>
								<?php
									}
								?>
								</select>
							</div>
						</div>
						
						
					<?php
						while($attribut = mysqli_fetch_assoc($ds)){
					?>
						<div class="col-xs-6">
							<div class="form-group">
								<label for="<?php echo $attribut['AttrID'] ?>"><?php echo $attribut['Bezeichnung']." in ".$attribut['Einheit'] ?></label>
								<input type="text" class="form-control" name ="<?php echo $attribut['AttrID'] ?>" 
								id="<?php echo $attribut['AttrID'] ?>" placeholder="<?php echo $attribut['Bezeichnung']?>" value="<?php if(isset($attribut['Wert'])){echo $attribut['Wert'];} ?>" />
							</div>
						</div>
					<?php
						}
					?>
							</div>
						<div class="row">
							<div class="button-row">
								<button type="submit" class="btn btn-default">Speichern</button>
								<a href="komponenten_anzeigen.php?komponentenart=<?php echo $compArt?>&komponentenid=<?php echo $compID?>" class="btn btn-default">Zurück</a>
							</div>
						</div>
						</form>
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