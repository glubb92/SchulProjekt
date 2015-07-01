<html>
<?php
	
	session_start();
	if (isset($_SESSION['username'])) {
		include"Menu.php";
		include"../Bausteine/get_tables.php";
		
	} else{
		echo "Du bist nicht angemeldet! <br> <a href=\"home.php\"><script>window.location = \"login.html\";</script></a>";
	}	
?>
<body>
	<?php
		$db = new getDB();
		$Out = $db->get_rooms( );
	?>
	<section id="content">
			<div class="row">
				<h1 class="page-header" >Raumliste</div>
			</div>
			<div class="row">
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					<div class="panel panel-default">
						<?php
						while($Data = $Out->fetch_assoc())
						{
							echo '
								<div class="panel-heading" role="tab" id="heading'.$Data["Raum_ID"].'">
									<h4 class="panel-title">
										<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$Data["Raum_ID"].'" aria-expanded="true" aria-controls="collapseOne">
											'.'Raum: '.$Data["Bezeichnung"].' - '.$Data["Notiz"].' <span class="badge">25</span>
										</a>
									</h4>
								</div>
								<div id="collapse'.$Data["Raum_ID"].'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading'.$Data["Raum_ID"].'">
									<div class="panel-body">
										<div class="panel-group" id="accordion2" role="tablist" aria-multiselectable="true">';
											$comp = $db->get_components_by_room($Data["Raum_ID"]);
											while($Data2 = $comp->fetch_assoc())
											{
												echo'<div class="panel panel-default">
													<div class="panel-heading" role="tab" id="headingTwo">
														<h4 class="panel-title">
															<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
																'.$Data2["ArtBezeichnung"].' <span class="badge">25</span>
															</a>
														</h4>
													</div>
													<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
														<div class="panel-body">
															<ul>
																<li><a href="#">iiyama 38</a></li>
																<li><a href="#">iiyama 39</a></li>
																<li><a href="#">iiyama 40</a></li>
																<li><a href="#">...</a></li>
															</ul>
														</div>
													</div>
												</div>';
											}
											
											
										echo '</div>
									</div>
								</div>';
						}
						?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="button-row">
					<a href="bearbeiten.html" class="btn btn-default">Bearbeiten</a>
					<a href="#" class="btn btn-default">Zurück</a>
				</div>
			</div>
</section>

</body>

</html>