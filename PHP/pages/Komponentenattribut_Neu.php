<html>
<?php
	session_start();
	if (isset($_SESSION['username'])) {
		include_once'Menu.php';
		
		include_once '..\Bausteine\insert_tables.php';
		include_once '..\Bausteine\set_tables.php';
		$add = new addDB();
		$set = new setDB();
		
		if (isset($_SESSION['username']) && $_SESSION['username']== 'Admin') {
						
			echo "
			<section id='content'>
			<form method='POST' action='#' >
				<div class='row'>
					<h1 class='page-header' >Komponentenattribut hinzufügen</div>
				</div>
				<div class='row'>
					<div class='col-xs-6'>
						<div class='form-group'>
							<label for='nameInput'>Bezeichnung</label>
							<input type='text' class='form-control' id='bezInput' name='kompbez'>
						</div>
					</div>
					<div class='col-xs-6'>
						<div class='form-group'>
							<label for='nameInput'>Einheit</label>
							<input type='text' class='form-control' id='einheitInput' name='einheit'>
						</div>
					</div>
				</div>
				<div class='row'>
					<div class='button-row'>
						<button class='btn btn-default  type='submit' name='OK'>OK</button>
						<a href='home.php' class='btn btn-default'>Abbbrechen</a>
					</div>
				</div>
			</form>
			</section>";		
			
			if(isset($_POST['OK']))
			{
				
				$add->add_component_attribute($_POST["kompbez"], $_POST['einheit']);
				
				echo 'Hinzugefügt <br>';
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