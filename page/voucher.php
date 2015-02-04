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

		function randomkeys($length) {
			$pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
			for($i=0;$i<$length;$i++) {
				$key .= $pattern{rand(0,35)};
			} return $key;
		}
		
		$ilosc 		= $_POST['ilosc'];
		$yes 		= $_POST['yes'];
		$id_uslugi 	= $_POST['id_uslugi'];
		$length 	= "8"; 

		if($yes == 1) {
			
			
			echo "<article class=\"cf\">
				<h2><a href=\"#\">Generator Kodow!</a></h2>
				<p align=\"justify\">";
			
			echo "Wygenerowane Kody:<br><br> ";
			
			$i2 = 0;
			for($i=0;$i<$ilosc;$i++){
				$i2++;
				$kodzik = randomkeys($length); 
				$kodzik = strtoupper($kodzik);
				mysql_query("INSERT INTO `sms_voucher` (`id`, `id_uslugi`, `kod` ,`status`) VALUES (NULL , '$id_uslugi', '$kodzik',  '1')");
				echo "<b>$i2.</b> $kodzik <br>";
			}
			
			echo "<br>Kody Wygenerowane Pomyslnie!</b></p>
			</article>";
			
		} else {
			echo "<article class=\"cf\">
				<h2><a href=\"#\">Generowanie Kodow</a></h2>		
				<center><h3>Generuj vouchery!</h3><center>
				<p style=\"text-align: center;\">
				<form action=\"\" method=\"post\">
					<input type=\"hidden\" name=\"yes\" value=\"1\">
					<input type=\"text\" name=\"ilosc\" placeholder=\"Ilosc kodow?\"><br>
					<input type=\"text\" name=\"id_uslugi\" placeholder=\"ID usługi?\"><br><br>
					<button>Wygeneruj</button>
				</form>
				</p><br>
			</article>";
			
			echo "<article class=\"cf\">
					<h2><a href=\"#\">Lista Usług</a></h2>
					<table class=\"craft-table\">
						<tr>
							<th>ID</th>
							<th>Nazwa</th>
							<th>Nr SMS</th>
							<th>Tresc SMS</th>
							<th>Cena SMS</th>
							<th>Usuń</th>
						</tr>";
					
			$sql     = "Select * from sms_shop oRDER BY id ASC";
			$result2 = mysql_query($sql, $link);

			while ($row = mysql_fetch_array($result2)) {  
				$id 		 = $row['id'];
				$name		 = $row['name'];
				$sms_nr		 = $row['sms_numer'];
				$sms_tresc	 = $row['sms_tresc'];
				$sms_cena	 = $row['sms_price'];

				echo "<tr>
						<td>$id</td>
						<td>$name</td>
						<td>$sms_nr</td>
						<td>$sms_tresc</td>
						<td>$sms_cena</td>
						<td><a href=\"index.php?action=usun&id=$id\" class=\"btn\">Usuń</a></td>
					</tr>";
				
			} mysql_close($link);
			
			echo "</table>
				<br>
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