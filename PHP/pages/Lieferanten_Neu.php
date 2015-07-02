<html>
<?php
	session_start();
	if (isset($_SESSION['username'])) {
		include'Menu.php';
		
		include_once '..\Bausteine\insert_tables.php';
		include_once '..\Bausteine\set_tables.php';
		$add = new addDB();
		$set = new setDB();
		
		if (isset($_SESSION['username']) && $_SESSION['username']== 'Admin') {
			
			$id = "";
			$name = "";
			$strasse = "";
			$PLZ = "";
			$ansprechpartner = "";
			$URL = "";
			$update = false;
			
			if(isset($_POST['id']) && count($_POST)>0)
			{
				$id = $_POST['id'];
				$name = $_POST['name'];
				$strasse = $_POST['strasse'];
				$PLZ = $_POST['PLZ'];
				$ansprechpartner = $_POST['ansprechpartner'];
				$URL = $_POST['url'];
				$update = true;
			}
			
			echo "
			<section id='content'>
			<form method='POST' action='#' >
				<div class='row'>
					<h1 class='page-header' >Lieferanten hinzufügen/bearbeiten</div>
				</div>
				<div class='row'>
					<div class='col-xs-6'>
						<div class='form-group'>
							<label for='nameInput'>Name</label>
							<input type='text' class='form-control' value='".$name."' id='nameInput' name='nameInput'>
							<input type='hidden'  value='".$id."' id='id' name='idInput'>
							<input type='hidden'  value='".$update."' id='update' name='update'>
						</div>
					</div>
					<div class='col-xs-6'>
						<div class='form-group'>
							<label for='idInput'>Strasse</label>
							<input type='text' class='form-control' value='".$strasse."' id='StrasseInput' name='StrasseInput'>
						</div>
					</div>
					<div class='col-xs-6'>
						<div class='form-group'>
							<label for='raumInput'>PLZ</label>
							<input type='text' class='form-control' value='".$PLZ."' id='PLZInput' name='PLZInput'>
						</div>
					</div>
					<div class='col-xs-6'>
						<div class='form-group'>
							<label for='raumInput'>Ansprechpartner</label>
							<input type='text' class='form-control' value='".$ansprechpartner."' id='AnsprechparterInput' name='AnsprechparterInput' >
						</div>
					</div>
					<div class='col-xs-6'>
						<div class='form-group'>
							<label for='raumInput'>URL</label>
							<input type='text' class='form-control' value='".$URL."' id='URLInput' name='URLInput' >
						</div>
					</div>
				</div>
				<div class='row'>
					<div class='button-row'>
						<button class='btn btn-default  type='submit' name='OK'>OK</button>
						<a href='Lieferanten.php' class='btn btn-default'>Abbbrechen</a>
					</div>
				</div>
			</form>
			</section>";		
			
			if(isset($_POST['OK']))
			{
				$name = $_POST['nameInput'];
				$strasse = $_POST['StrasseInput'];
				$PLZ = $_POST['PLZInput'];
				$ansprechpartner = $_POST['AnsprechparterInput'];
				$URL = $_POST['URLInput'];
				$id = $_POST['idInput'];
				$update = $_POST['update'];
				if($update== true)
				{
					$set->set_supplier($id, $name, $strasse, $PLZ, $ansprechpartner, $URL );
				}else{
					$add->add_supplier($name, $strasse, $PLZ, $ansprechpartner, $URL );
				}
				echo 'Geänder/Hinzugefügt <br> <a href=\'Lieferanten.php\'><script>window.location = \'Lieferanten.php\';</script></a>';
			}	
		
		} else{
			echo 'Du hast dafür keine Rechte! <br> <a href=\'home.php\'><script>window.location = \'Lieferanten.php\';</script></a>';
		}	
	} else{
		echo 'Du bist nicht angemeldet! <br> <a href=\'home.php\'><script>window.location = \'login.html\';</script></a>';
	}	
?>
</body>
</html>