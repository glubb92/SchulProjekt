 <?php
	session_start();
?>

<?php
	$verbindung = mysqli_connect("localhost",
	"root","root","dbproject");
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
		echo "Login erfolgreich. <br> <a href=\"home.php\"><script>window.location = \"localhost/home.php\";</script></a>";
		}
	else
		{
		echo "Login failed. <a href=\"login.html\">Login</a>";
		}

?> 