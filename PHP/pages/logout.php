 <html>
 <?php
	session_start();
	
	session_destroy();
	
	echo "<a href=\"login.html\">Zum Login</a>";
	 echo "Ausgelogt! <br> <a href=\"home.php\"><script>window.location = \"login.html\";</script></a>";
?> 
</html>