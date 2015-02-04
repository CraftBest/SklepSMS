<?php 
	session_start();
	require "include/config.php";
	$logged = 0;
	
	if(isset($_SESSION['myusername'])) {
		$logged = 1;
	}
	
	if($logged == "1") {
		$link = mysql_connect("$dbhost", "$dbuser", "$dbpassword");
		mysql_query("SET NAMES utf8");
		mysql_select_db("$baza", $link);
		
		$id = $_GET["id"];
		mysql_query("DELETE FROM `sms_shop` WHERE `id` = \"$id\"");
		mysql_close($link); 
		
		echo "<article class=\"cf\">
			<h2><a href=\"#\">Usunięto!</a></h2>
			<p style=\"text-align: center;\">Usługa została pomyślnie usunięta!</p><br>
		</article>";
		
	} else {
		echo "<article class=\"cf\">
			<h2><a href=\"#\">Logowanie</a></h2>		
			<center><h3>Zaloguj się</h3><center>
			<p style=\"text-align: center;\">
			<form action=\"index.php?action=checklogin\" method=\"post\">
				<input name=\"myusername\" placeholder=\"Login\" type=\"text\"><br>
				<input name=\"mypassword\" placeholder=\"Haslo\" type=\"password\"><br>
				<button>Zaloguj</button>
			</form>
			</p><br>
		</article>";
	}
?>