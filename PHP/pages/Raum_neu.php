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
			
			$id = "";
			$bezeichnung = "";
			$notiz = "";
			$update = false;
			
			if(isset($_POST['id']) && count($_POST)>0)
			{
				$id = $_POST['id'];
				$bezeichnung = $_POST['bezeichnung'];
				$notiz = $_POST['notiz'];
				$update = true;
			}
			if(isset($_GET['id']) && count($_GET)>0)
			{
				$id = $_GET['id'];
				$bezeichnung = $_GET['bezeichnung'];
				$notiz = $_GET['notiz'];
				$update = true;
			}
			
			echo "
			<section id='content'>
			<form method='POST' action='#' >
				<div class='row'>
					<h1 class='page-header' >Raum hinzufügen</div>
				</div>
				<div class='row'>
					<div class='col-xs-6'>
						<div class='form-group'>
							<label for='bezeichnung'>Bezeichnung</label>
							<input type='text' class='form-control' value='".$bezeichnung."' id='bezeichnung' name='bezeichnung'>
							<input type='hidden'  value='".$id."' id='id' name='idInput'>
							<input type='hidden'  value='".$update."' id='update' name='update'>
						</div>
					</div>
					<div class='col-xs-6'>
						<div class='form-group'>
							<label for='notiz'>Notiz</label>
							<input type='text' class='form-control' value='".$notiz."' id='notiz' name='notiz'>
						</div>
					</div>
				<div class='row'>
					<div class='button-row'>
						<button class='btn btn-default  type='submit' name='OK'>OK</button>
						<a href='Raum.php' class='btn btn-default'>Abbbrechen</a>
					</div>
				</div>
			</form>
			</section>";		
			
			if(isset($_POST['OK']))
			{
				$bezeichnung = $_POST['bezeichnung'];
				$notiz = $_POST['notiz'];
				$id = $_POST['idInput'];
				$update = $_POST['update'];

				if($update== true)
				{
					$set->set_rooms($id, $bezeichnung, $notiz);
				}else{
					$add->add_raum($bezeichnung, $notiz);
				}
				echo 'Hinzugefügt <br> <a href=\'Raum.php\'><script>window.location = \'Raum.php\';</script></a>';
			}		
		} else{
			echo 'Du hast dafÃ¼r keine Rechte! <br> <a href=\'home.php\'><script>window.location = \'Raum.php\';</script></a>';
		}	
	} else{
		echo 'Du bist nicht angemeldet! <br> <a href=\'home.php\'><script>window.location = \'login.html\';</script></a>';
	}	
?>
</body>
</html>