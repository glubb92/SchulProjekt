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
							if(isset($Data["Notiz"])) $raumbez = $Data["Bezeichnung"].' - '.$Data["Notiz"];
							else $raumbez = $Data["Bezeichnung"];
							
							echo '
								<div class="panel-heading" role="tab" id="heading'.$Data["Raum_ID"].'">
									<h4 class="panel-title">
										<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$Data["Raum_ID"].'" aria-expanded="false" aria-controls="collapse'.$Data["Raum_ID"].'">
											'.'Raum: '.$raumbez.' <span class="badge">25</span>
										</a>
									</h4>
								</div>
								<div id="collapse'.$Data["Raum_ID"].'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading'.$Data["Raum_ID"].'">
									<div class="panel-body">
										<div class="panel-group" id="accordion2" role="tablist" aria-multiselectable="true">';
											$comp = $db->get_components_by_room($Data["Raum_ID"]);
											$art = "Start";
											$hat_inventar = false;
											while($Data2 = $comp->fetch_assoc())
											{
												$hat_inventar = true;
												if($art != $Data2["ArtBezeichnung"])
												{
													if($art != "Start")
													{
														echo'
																	</ul>
																</div>
															</div>
														</div>';
													}
													$id = $Data["Raum_ID"].'-'.$Data2["KompID"];
													$art = $Data2["ArtBezeichnung"];
													echo'<div class="panel panel-default">
														<div class="panel-heading" role="tab" id="heading'.$id.'">
															<h4 class="panel-title">
																<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion2" href="#collapse'.$id.'" aria-expanded="false" aria-controls="collapse'.$id.'">
																	'.$Data2["ArtBezeichnung"].' <span class="badge">25</span>
																</a>
															</h4>
														</div>
														<div id="collapse'.$id.'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'.$id.'">
															<div class="panel-body">
																<ul>';
												}
												
												
												echo'<li><a href="Komponenten_neu.php?komponentenart='.$Data2["ArtID"].'&komponententid='.$Data2["KompID"].'">'.$Data2["KompBezeichnung"].'</a></li>';
																
											}
											if($hat_inventar == true)
											{
												echo'
														</ul>
													</div>
												</div>
											</div>';
											}
										echo'</div>
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