<html>
<?php
	session_start();
	if (isset($_SESSION['username'])) {
		include'Menu.php';
		include'..\Bausteine\insert_tables.php';
		// include'..\Bausteine\get_tables.php';
		$add = new addDB();
		// $get = new getDB();
		if (isset($_SESSION['username']) && $_SESSION['username']== 'Admin') {
		echo "
		<section id='content'>
			<div class='row'>
				<h1 class='page-header' >Lieferanten hinzufügen</div>
			</div>
			<div class='row'>
				<div class='col-xs-6'>
					<div class='form-group'>
						<label for='nameInput'>Name</label>
						<input type='text' class='form-control' id='nameInput' >
					</div>
				</div>
				<div class='col-xs-6'>
					<div class='form-group'>
						<label for='idInput'>Strasse</label>
						<input type='text' class='form-control' id='StrasseInput' >
					</div>
				</div>
				<div class='col-xs-6'>
					<div class='form-group'>
						<label for='raumInput'>PLZ</label>
						<input type='text' class='form-control' id='PLZInput' >
					</div>
				</div>
				<div class='col-xs-6'>
					<div class='form-group'>
						<label for='raumInput'>Ansprechpartnern</label>
						<input type='text' class='form-control' id='AnsprechparterInput' >
					</div>
				</div>
				<div class='col-xs-6'>
					<div class='form-group'>
						<label for='raumInput'>URL</label>
						<input type='text' class='form-control' id='URLInput' >
					</div>
				</div>
			</div>
			<div class='row'>
				<div class='button-row'>
					<a href='#' class='btn btn-default'>Hinzufügen</a>
					<a href='home.php' class='btn btn-default'>Abbbrechen</a>
				</div>
			</div>
		</section>";		
			
		} else{
			echo 'Du hast dafür keine Rechte! <br> <a href=\'home.php\'><script>window.location = \'Lieferanten.php\';</script></a>';
		}	
	} else{
		echo 'Du bist nicht angemeldet! <br> <a href=\'home.php\'><script>window.location = \'login.html\';</script></a>';
	}	
?>
</body>
</html>