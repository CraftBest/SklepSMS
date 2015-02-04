<?php 
	session_start();
	require "include/config.php";
	$logged = 0;
	
	if(isset($_SESSION['myusername'])) {
		$logged = 1;
	}
	
	if($logged == "1") {	
		$success 		= $_POST['success'];
		$name 			= $_POST['name'];
		$desc 			= $_POST['desc'];
		$sms_id			= $_POST['sms_id'];
		$sms_numer		= $_POST['sms_numer'];
		$sms_tresc		= $_POST['sms_tresc'];
		$sms_cena		= $_POST['sms_cena'];
		$color 			= $_POST['color'];
		$cmd1			= $_POST['cmd1'];
		$cmd2			= $_POST['cmd2'];
		$cmd3			= $_POST['cmd3'];
		$cmd4			= $_POST['cmd4'];
		$cmd5			= $_POST['cmd5'];
		$cmd6			= $_POST['cmd6'];
		
		if($success == "1") {
			$link = mysql_connect("$dbhost", "$dbuser", "$dbpassword");
			mysql_query("SET NAMES utf8");
			mysql_select_db("$baza", $link);
			mysql_query("INSERT INTO `sms_shop`(`name`, `description`, `sms_numer`, `sms_tresc`, `sms_hpay_id`, `sms_price`, `color`, `cmd1`, `cmd2`, `cmd3`, `cmd4`, `cmd5`, `cmd6`) VALUES ('$name', '$desc', '$sms_numer', '$sms_tresc', '$sms_id', '$sms_cena', '$color', '$cmd1', '$cmd2', '$cmd3', '$cmd4', '$cmd5', '$cmd6')");			
			mysql_close($link); 
			
			echo "<article class=\"cf\">
				<h2><a href=\"#\">Pomyślnie dodano!</a></h2>
				<p style=\"text-align: center;\">Usługa została pomyślnie dodana! Kliknij <a href=\"index.php?page=dodaj\">tutaj</a> aby dodac kolejne usługi!</p><br>
			</article>";
			
		} else {
			echo"<article class=\"cf\">
					<h2><a href=\"#\">Dodaj usługe</a></h2>
					<form action=\"\" method=\"post\" >
						<table class=\"craft-table\">
							<tr>
							   <th>Opcja</th>
							   <th>Wartość</th>
							</tr>
							<tr>
								<td>Nazwa</td>
								<td><input name=\"name\"></input></td>
							</tr>	
							<tr>
								<td>Opis</td>
								<td><input name=\"desc\"></input></td>
							</tr>	
							<tr>
								<td>SMS ID</td>
								<td><input name=\"sms_id\"></input></td>
							</tr>		
							<tr>
								<td>Numer</td>
								<td><input name=\"sms_numer\"></input></td>
							</tr>	
							<tr>
								<td>Tresc</td>
								<td><input name=\"sms_tresc\"></input></td>
							</tr>	
							<tr>
								<td>Cena</td>
								<td><input name=\"sms_cena\"></input></td>
							</tr>
							<tr>
								<td>Kolor</td>
								<td><input name=\"color\"></input></td>
							</tr>
							<tr>
								<td>Komenda 1</td>
								<td><input name=\"cmd1\"></input></td>
							</tr>
							<tr>
								<td>Komenda 2</td>
								<td><input name=\"cmd2\"></input></td>
							</tr>
							<tr>
								<td>Komenda 3</td>
								<td><input name=\"cmd3\"></input></td>
							</tr>
							<tr>
								<td>Komenda 4</td>
								<td><input name=\"cmd4\"></input></td>
							</tr>
							<tr>
								<td>Komenda 5</td>
								<td><input name=\"cmd5\"></input></td>
							</tr>
							<tr>
								<td>Komenda 6</td>
								<td><input name=\"cmd6\"></input></td>
							</tr>
						</table><br>
						<input type=\"hidden\" name=\"success\" value=\"1\">
						<center><button>Dodaj</button></center><br>
					</form>
				</article>";
		}
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