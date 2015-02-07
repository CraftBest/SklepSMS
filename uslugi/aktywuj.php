
<?php 
	require("include/config.php");
	require("include/time.php");
	
	if($_POST&&$_POST['check_code']) {
		$code	= $_POST['code'];
		$id		= $_POST['usluga'];
		$nick 	= $_POST['nick'];
		$today = date("Y/m/d");
		
	
		//Połączenie z mysql i wybranie bazy
		$link = mysql_connect("$dbhost", "$dbuser", "$dbpassword");
		mysql_query("SET NAMES utf8");
		mysql_select_db("$baza", $link);

		//Pobranie odpowieniej paczki
		$sql     = "Select * from sms_shop WHERE `id` =\"$id\"";
		$result2 = mysql_query($sql, $link);
		
		while ($row = mysql_fetch_array($result2)) { 
			$sms_hpay_id	= $row['sms_hpay_id'];
			$name 			= $row['name'];
			$number			= $row['sms_numer'];
			$cmd1			= $row['cmd1'];
			$cmd2			= $row['cmd2'];
			$cmd3			= $row['cmd3'];
			$cmd4			= $row['cmd4'];
			$cmd5			= $row['cmd5'];
			$cmd6			= $row['cmd6'];
			$cmd1 			= str_replace('[nick]', $nick, $cmd1);
			$cmd2 			= str_replace('[nick]', $nick, $cmd2);
			$cmd3 			= str_replace('[nick]', $nick, $cmd3);
			$cmd4 			= str_replace('[nick]', $nick, $cmd4);
			$cmd5 			= str_replace('[nick]', $nick, $cmd5);
			$cmd6 			= str_replace('[nick]', $nick, $cmd6);
		}	
		
		$sql     = "Select * from sms_voucher WHERE `kod` =\"$code\"";
		$result3 = mysql_query($sql, $link);
					
		while ($row = mysql_fetch_array($result3)) { 
			$kod_id = $row['id'];
			$id_uslugi = $row['id_uslugi'];
			$status = $row['status'];
			$kod 	= $row['kod'];
		}

		define( 'MQ_SERVER_ADDR', "$svr_ip" );
		define( 'MQ_SERVER_PORT', "$svr_rcon_port" );
		define( 'MQ_SERVER_PASS', "$svr_rcon_pass" );
		define( 'MQ_TIMEOUT', 2 );

		require __DIR__ . '/MinecraftRcon.class.php';

		function console($command) {
			$Rcon = new MinecraftRcon;
			$Rcon->Connect( MQ_SERVER_ADDR, MQ_SERVER_PORT, MQ_SERVER_PASS, MQ_TIMEOUT );
			$Data = $Rcon->Command( "$command" );
		} mysql_close($link);
	
		if(!preg_match("/^[A-Za-z0-9]{8}$/",$code)) echo "
				<article class=\"cf\">
					<h2><a href=\"#\">Niepoprawny kod!</a></h2>
					<p align=\"justify\">Prosze wprowadzic kod w poprawnej formie!</p>					
				</article>";
		else {
			if($api == "hpay"){
				$handle=fopen("http://homepay.pl/API/check_code.php?usr_id=".$config_homepay_usr_id."&acc_id=".$sms_hpay_id."&code=".$code,'r');
			} elseif($api == "profit") {
				$handle=fopen('http://profitsms.pl/check.php?apiKey='.$apiKey.'&code='.$code.'&smsNr='.$number,'r'); 
			}
			
			$check=fgets($handle,8);
			fclose($handle);
			
			if($check=="1") {
				console("$cmd1");
				console("$cmd2");
				console("$cmd3");
				console("$cmd4");
				console("$cmd5");
				console("$cmd6");
				
				echo "<article class=\"cf\">
					<h2><a href=\"#\">Usluga zakupiona!</a></h2>
					<p align=\"justify\">Zakupiona usługa<b> $name</b> na nick<b> $nick</b>  została pomyślnie aktywowana!<br> Przejdz do <a href=\"index.php?page=shop#content\">sklepu</a> aby coś kupić...<br></p>					
				</article>";
			
				//Połaczenie sql 
				$connection = @mysql_connect("$dbhost", "$dbuser", "$dbpassword");
				$db = @mysql_select_db("$baza", $connection);
				$code2	= $_GET['code2'];
				
				mysql_query("INSERT INTO `sms_history`(`svr_id`, `status`, `kod`, `usluga`, `nick`, `data`, `godzina`) VALUES ('$svr_name', '$check', '$code', '$name', '$nick','$today', '$godzina') AND '$code2'");
				mysql_query("$code2");
				mysql_close($connection); 
			
			} elseif($check=="0") { 								
				if($status == "1" AND $id_uslugi == "$id") {
					console("$cmd1");
					console("$cmd2");
					console("$cmd3");
					console("$cmd4");
					console("$cmd5");
					console("$cmd6");
					
					$link = mysql_connect("$dbhost", "$dbuser", "$dbpassword");
					mysql_query("SET NAMES utf8");
					mysql_select_db("$baza", $link);
					
					mysql_query("UPDATE `sms_voucher` SET `status` =  '0' WHERE `id` =\"$kod_id\"");
					mysql_query("INSERT INTO `sms_history`(`svr_id`, `status`, `kod`, `usluga`, `nick`, `data`, `godzina`) VALUES ('$svr_name', '1', '$code', '$name', '$nick','$today', '$godzina')");
					mysql_close($link); 
				
					echo "<article class=\"cf\">
						<h2><a href=\"#\">Voucher Zrealizowano!</a></h2>
						<p align=\"justify\">Pomyślnie zrealizowano voucher!</p>					
					</article>";
					
				} else {
					echo "<article class=\"cf\">
						<h2><a href=\"#\">Niepoprawny kod!</a></h2>
						<p align=\"justify\">Podany kod jest błędny! Sprawdź go i spróbuj ponownie!</p>					
					</article>";
				}				
			} else { 	
				echo "Czegos brakuje!";
			}
		} 
	}  
?>