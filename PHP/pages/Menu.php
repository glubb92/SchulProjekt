<html>
 <?php
	session_start();
?>
	<head>
		<title>IT-Verwaltung</title>
		<link rel='stylesheet' href='../web-assets/css/bootstrap.css' >
		<link rel='stylesheet' href='../web-assets/css/main.css' >
		<link rel='stylesheet' href='../web-assets/yamm/yamm.css' >s
		<link rel="stylesheet" type="text/css" href="../web-assets/css/tabledesign.css" />
		<script src='../web-assets/js/jquery-2.1.4.min.js' ></script>
		<script src='../web-assets/js/bootstrap.min.js' ></script>
		<script src='../web-assets/js/main.js' ></script>

		<link rel='icon' type = 'image/vnd.microsoft.icon' href= '/favicon.ico' >
	</head>
	<body>
	<?php
	if (isset($_SESSION['username'])) {
	echo"
	<div class='alibi-header'></div>
		<nav class='navbar yamm navbar-default  navbar-fixed-top custom-nav'>
		  <div class='container-fluid'>
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class='navbar-header'>
			  <button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#bs-example-navbar-collapse-1' aria-expanded='false'>
				<span class='sr-only'>Toggle navigation</span>
				<span class='icon-bar'></span>
				<span class='icon-bar'></span>
				<span class='icon-bar'></span>
			  </button>
			  <a class='navbar-brand' href='home.php'><img src='../web-assets/img/logo-neu.png'/></a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>
			  <ul class='nav navbar-nav'>
				<li>
				<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>Raum</a>
					  <ul class='dropdown-menu submenu-dropdown'>
						<li class><a href='Raum.php'><span class='glyphicon glyphicon-search' aria-hidden='true'></span> Suche</a></li>
						<li><a href='Raum_neu.php'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> Neu</a></li>
					  </ul>
				</li>
				<li class='dropdown yamm-fw'>
					<a href='Hardware.php' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>Hardware <span class='caret'></span></a>
					<ul class='dropdown-menu'>
						<li>
							<div class='yamm-content'> 
								<div class='row'> 
									<div class='col-xs-12'>
										<div class='btn-group btn-group-submenu'>
											<ul class='submenu-list'>
												<li>
													<div class='btn-group'>
													  <button type='button' class='btn btn-default dropdown-toggle btn-submenu' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
														PC
													  </button>
													  <ul class='dropdown-menu submenu-dropdown'>
														<li class><a href='#'><span class='glyphicon glyphicon-search' aria-hidden='true'></span> Suche</a></li>
														<li><a href='#'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> Neu</a></li>
													  </ul>
													</div>
												</li>
												<li>
													<div class='btn-group'>
														<button type='button' class='btn btn-default dropdown-toggle btn-submenu' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
															Bildschirm
														</button>
														<ul class='dropdown-menu submenu-dropdown'>
															<li class><a href='#'><span class='glyphicon glyphicon-search' aria-hidden='true'></span> Suche</a></li>
															<li><a href='#'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> Neu</a></li>
														</ul>
													</div>
												</li>
												<li>
													<div class='btn-group'>
														<button type='button' class='btn btn-default dropdown-toggle btn-submenu' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
															Drucker
														</button>
														<ul class='dropdown-menu submenu-dropdown'>
															<li class><a href='#'><span class='glyphicon glyphicon-search' aria-hidden='true'></span> Suche</a></li>
															<li><a href='#'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> Neu</a></li>
														</ul>
													</div>
												</li>
												<li>
													<div class='btn-group'>
														<button type='button' class='btn btn-default dropdown-toggle btn-submenu' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
															Tastatur
														</button>
														<ul class='dropdown-menu submenu-dropdown'>
															<li class><a href='#'><span class='glyphicon glyphicon-search' aria-hidden='true'></span> Suche</a></li>
															<li><a href='#'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> Neu</a></li>
														</ul>
													</div>
												</li>
												<li>
													<div class='btn-group'>
														<button type='button' class='btn btn-default dropdown-toggle btn-submenu' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
															Maus
														</button>
														<ul class='dropdown-menu submenu-dropdown'>
															<li class><a href='#'><span class='glyphicon glyphicon-search' aria-hidden='true'></span> Suche</a></li>
															<li><a href='#'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> Neu</a></li>
														</ul>
													</div>
												</li>
												<li>
													<div class='btn-group'>
														<button type='button' class='btn btn-default dropdown-toggle btn-submenu' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
															Festplatten
														</button>
														<ul class='dropdown-menu submenu-dropdown'>
															<li class><a href='#'><span class='glyphicon glyphicon-search' aria-hidden='true'></span> Suche</a></li>
															<li><a href='#'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> Neu</a></li>
														</ul>
													</div>
												</li>
												<li>
													<div class='btn-group'>
														<button type='button' class='btn btn-default dropdown-toggle btn-submenu' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
															Kabel
														</button>
														<ul class='dropdown-menu submenu-dropdown'>
															<li class><a href='#'><span class='glyphicon glyphicon-search' aria-hidden='true'></span> Suche</a></li>
															<li><a href='#'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> Neu</a></li>
														</ul>
													</div>
												</li>
												<li>
													<div class='btn-group'>
														<button type='button' class='btn btn-default dropdown-toggle btn-submenu' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
															Whiteboard
														</button>
														<ul class='dropdown-menu submenu-dropdown'>
															<li class><a href='#'><span class='glyphicon glyphicon-search' aria-hidden='true'></span> Suche</a></li>
															<li><a href='#'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> Neu</a></li>
														</ul>
													</div>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</li>
					</ul>
				</li>
				<li>
				<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>Software</a>
					  <ul class='dropdown-menu submenu-dropdown'>
						<li class><a href='Software.php'><span class='glyphicon glyphicon-search' aria-hidden='true'></span> Suche</a></li>
						<li><a href='Software_Neu.php'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> Neu</a></li>
					  </ul>
				</li>
				<li><a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>Lieferanten</a>
					  <ul class='dropdown-menu submenu-dropdown'>
						<li class><a href='Lieferanten.php'><span class='glyphicon glyphicon-search' aria-hidden='true'></span> Suche</a></li>
						<li><a href='Lieferanten_Neu.php'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> Neu</a></li>
					  </ul></li>
			</ul>
			<ul class='nav navbar-nav navbar-right'>
				<!--<li><form action method='post' action=\"logout.php\" ><a  type='submit' name = 'btnLogout' value = 'Logout' >Logout</a> </form></li>	-->
				<li><a href='logout.php'>Logout</a></li>
			</ul>
			</div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>
		";
		 } else{
		 echo "Du bist nicht angemeldet! <br> <a href=\"home.php\"><script>window.location = \"login.html\";</script></a>";
		 }
		?>
<!--	</body>
</html> -->