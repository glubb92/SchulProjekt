 <html>
 <?php
	session_start();
?>
<head>
	<link rel="stylesheet" href="../web-assets/css/bootstrap.css" >
	<link rel="stylesheet" href="../web-assets/css/main.css" >
	<link rel="stylesheet" href="../web-assets/yamm/yamm.css" >
	<script src="../web-assets/js/jquery-2.1.4.min.js" ></script>
	<script src="../web-assets/js/bootstrap.min.js" ></script>
	<script src="../web-assets/js/main.js" ></script>
</head>
<?php	
	
	$verbindung = mysqli_connect("localhost",
	"root","root","dbproject")
	or die("Verbindung zur Datenbank konnte nicht hergestellt werden");

	//mysql_select_db("dbproject") or die ("Datenbank konnte nicht ausgewählt werden");

	$username = $_POST["username"];
	$passwort = md5($_POST["password"]);

	$abfrage = "SELECT Name, Passwort FROM tblbenutzer WHERE Name LIKE '".$username."' LIMIT 1";
	$ergebnis = mysqli_query($verbindung,$abfrage);
	$row = mysqli_fetch_array($ergebnis);

	if($row["Passwort"] == $passwort)
		{
		$_SESSION["username"] = $username;
		echo "Login erfolgreich. <br> <a href=\"home.php\"><script>window.location = \"home.php\";</script></a>";
		}
	else
		{
		echo "Login failed. <a href=\"login.html\">Login</a>";
		}

?> 
</html>