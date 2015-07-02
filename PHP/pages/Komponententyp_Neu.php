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
			
			$bezeichnung = "";
			$update = false;
			
			if(isset($_POST['id']) && count($_POST)>0)
			{
				$bezeichnung = $_POST['bezInput'];
				$update = true;
			}
			
			echo "
			<section id='content'>
			<form method='POST' action='#' >
				<div class='row'>
					<h1 class='page-header' >Komponententyp hinzufügen/bearbeiten</div>
				</div>
				<div class='row'>
					<div class='col-xs-6'>
						<div class='form-group'>
							<label for='nameInput'>Bezeichnung</label>
							<input type='text' class='form-control' value='".$bezeichnung."' id='bezInput' name='kompbez'>
							<input type='hidden'  value='".$update."' id='update' name='update'>
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
				$bezeichnung = $_POST['bezeichnungInput'];
				$update = $_POST['update'];
				if($update== true)
				{
					$set->set_component_type($bezeichnung);
				}else{
					$add->add_supplier($bezeichnung);
				}
				echo 'Geänder/Hinzugefügt <br> <a href=\'Komponententypen.php\'><script>window.location = \'Komponententypen.php\';</script></a>';
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