<html>
<?php
	session_start();
	if (isset($_SESSION['username'])) {
		include"Menu.php";
	} else{
		echo "Du bist nicht angemeldet! <br> <a href=\"home.php\"><script>window.location = \"login.html\";</script></a>";
	}	
?>
</body>
</html>