<html>
 <?php
	session_start();
	if (isset($_SESSION['username'])) {
		include"Menu.php";

		echo"<section id='content'>
			<div class='row'>
				<h1 class='page-header' >Startseite</div>
			</div>
			<div class='row'>
				<div class='col-xs-6'>
					<a href='Raum.php' class='thumbnail home-tile'>
						<img src='../web-assets/img/Home_page_64.png' alt='Raum'><br/><h2>Raum</h2>
					</a>
				</div>
				<div class='col-xs-6'>
					<a href='Hardware.php' class='thumbnail home-tile'>
						<img src='../web-assets/img/PC_computer_with_monitor_64.png' alt='Hardware'><br/><h2>Hardware</h2>
					</a>
				</div>
				<div class='col-xs-6'>
					<a href='Software.php' class='thumbnail home-tile'>
						<img src='../web-assets/img/Diskette_save_interface_symbol_64.png' alt='Software'><br/><h2>Software</h2>
					</a>
				</div>
				<div class='col-xs-6'>
					<a href='Lieferanten.php' class='thumbnail home-tile'>
						<img src='../web-assets/img/Cargo_Truck_64.png' alt='Lieferanten'><br/><h2>Lieferanten</h2>
					</a>
				</div>
			</div>
		</section>";
		 } else{
		 echo "Du bist nicht angemeldet! <br> <a href=\"home.php\"><script>window.location = \"login.html\";</script></a>";
		 }
		?>
	</body>
</html>