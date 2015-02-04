<?php
	
	//Połączenie z mysql i wybranie bazy
	$link = mysql_connect("$dbhost", "$dbuser", "$dbpassword");
	mysql_query("SET NAMES utf8");
	mysql_select_db("$baza", $link);
	
	echo "<h2 class=\"shop-heading\">Wybierz usługę</h2>";
	

	$sql     = "Select * from sms_shop ORDER BY id ASC";

	//Pobranie odpowieniej paczki
	
	$result = mysql_query($sql, $link);

	while ($row = mysql_fetch_array($result)) {  
		$id     	= $row['id'];
		$bgcol  	= $row['color'];
		$nazwa    	= $row['name'];
		$opis		= $row['description'];
		$cena 		= $row['sms_price'];
		$cur 		= "PLN";
		$svr_id		= $row['svr_id'];
		$znizka		= $row['discount'];
		$nrsms		= $row['sms_numer'];
		$trescsms   = $row['sms_tresc'];
		$csms		= $row['sms_price'];

?> 
		
	<div class='shop-item cf' style='background-color:#<?php echo "$bgcol"; ?>'>
		<h3><?php echo "$nazwa"; ?><span class="discount"><?php echo "$znizka" ?></span></h3>
		<p><?php echo "$opis"; ?></p>
		<a href='#popup<?php echo "$id"; ?>' rel='modal:open' class='shop-buy'>Kup<div class='shop-price'><?php echo "$cena $cur"; ?></div></a>
	</div>
	
	<div class='modals'>
		<div id='popup<?php echo "$id"; ?>' class='modal'>
			<div id='payment<?php echo "$id"; ?>'>
				<h2><?php echo "$nazwa";?></h2>
				<p>Wyślij sms o treści: <b><?php echo "$trescsms"; ?></b> na numer <b><?php echo "$nrsms"; ?></b>. Koszt: <b><?php echo "$csms"; ?> zł</b> brutto.<br>
					<form method="post" action="index.php?action=shop&buy=aktywuj#content">
						<input type="hidden" name="check_code" value="1">
						<input type="hidden" name="usluga" value="<?php echo "$id"; ?>">
						<input name="code" value="Wpisz kod SMS" onblur="if(this.value=='') this.value='Wpisz kod SMS';" onfocus="if(this.value=='Wpisz kod SMS') this.value='';" type="text"><br>
						<input name="nick" value="Wpisz swój nick" onblur="if(this.value=='') this.value='Wpisz swój nick';" onfocus="if(this.value=='Wpisz swój nick') this.value='';" type="text"><br>
						<button>Wyślij</button>
					</form><br>
				Korzystanie z serwisu oznacza akceptację <a href="index.php?action=rules" target="_blank">Regulaminu</a> serwera.<br>
				Reklamacje składamy tutaj: <a href="http://www.homepay.pl/reklamacje/" target="_blank">www.Homepay.pl</a><br>
				Usługa dostepna w sieciach: Orange, Plus GSM, T-Mobile, Play.<br>
				Płatności obsługuje firma:<br>
				<a href="https://ssl.homepay.pl/stawki-prowizji/" target="_blank"><img src="https://ssl.homepay.pl/files/img/logo_na_tle.png"/></a><br>
				<a href="#" class="btn" rel="modal:close">Zamknij okno</a>
				</p>
			</div>
		</div>
	</div>	
			
		
<?php
	}
	mysql_close($link);
?>