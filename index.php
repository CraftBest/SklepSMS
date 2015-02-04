<!DOCTYPE html>
<html>
 	<head>
		<title>CraftBest - Magia Minecrafta w jednym miejscu!</title>
		<meta charset="utf-8">
		<meta name="description" content="CraftBest - najlepsze polskie serwery Minecraft. Skyblock, RPG, Survival, Freebuild, VampireZ, Hide'n'Seek, Paintball, QuakeCraft. Wszystko u nas!">
		<meta name="keywords" content="nonpremium,minecraft,serwer,CraftBest,pvp,minigames,minigry,skyblock,freebuild,frakcje,gildie,survival games,hide and seek,polski serwer,creative,najlepszy serwer,dobry serwer">
		<meta name="copyright" content="CraftBest">
		<meta name="language" content="PL">
		<META NAME="Robots" CONTENT="All" />
		<link href="css/normalize.css" rel="stylesheet">	
		<link href='http://fonts.googleapis.com/css?family=Istok+Web:400,700,400italic,700italic|Enriqueta:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
		<link href="css/main.css" rel="stylesheet">
		<link href="images/favicon.ico" rel="shortcut icon">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<!--<script src="js/api.js"></script>-->
		<script src="js/bjqs-1.3.min.js"></script>
		<script src="js/script.js"></script>
	</head>

	
	<body class="bg1">
		<div class="wrap">
			<header class="cf">
				<h1><a href="index.php"><img src="images/craftbest1.png" alt="CraftBest"></a></h1>
				<nav>			 
					<ul class="cf">
						<li>
							<a href="#"><span></span></a>
						</li>
						<li>
							<a href="index.php">
							<span class="fa fa-home"></span>Gł&oacute;wna</a>
						</li>
						<li>
							<a href="http://forum.craftbest.pl">
							<span class="fa fa-comments"></span>Forum</a>
						</li>
						<li>
							<a href="#">
							<span class="fa fa-list-ul"></span>Komendy</a>
						</li>
						<li>
							<a href="http://forum.craftbest.pl/Forum-poradniki">
							<span class="fa fa-book"></span>Poradniki</a>
						</li>
						<li>
							<a href="index.php?action=rules">
							<span class="fa fa-warning"></span>Regulamin</a>
						</li>
						<li>
							<a href="#">
							<span class="fa fa-envelope"></span>Kontakt</a>
						</li>          
					</ul>
				</nav>
			</header>
			
			<div class="container cf">
				<div id="slider">
					<ul class="bjqs">
					
						<?php
							require("include/config.php");
							//Połączenie z mysql i wybranie bazy
							$link = mysql_connect("$dbhost", "$dbuser", "$dbpassword");
							mysql_query("SET NAMES utf8");
							mysql_select_db("$baza", $link);

							//Pobranie odpowieniej paczki
							$sql     = 'Select * from sms_sliders';
							$result2 = mysql_query($sql, $link);

							while ($row = mysql_fetch_array($result2)) {  
								$img_path     	 = $row['img_path'];
								$href 			 = $row['href'];
								$description	 = $row['description'];
							?> 
						<li>
							<img src='<?php echo "$img_path"?>' />
							<h3><a href='<?php echo "$href"?>'><?php echo "$description"?></a></h3>			
						</li>								
						<?php }	mysql_close($link);	?>
						
						
					</ul>
				</div>
				
				<div class="content" id="content">
					<?php 
						$action = $_GET['action'];
						$buy = $_GET['buy'];
						$data = $_GET['data'];
			
						if(!empty($action)) {
							if(!empty($buy)) {
								if(is_file("uslugi/$buy.php")) include "uslugi/$buy.php";
								else echo "<br />Nie odnaleziono takiej strony!";
							} elseif(!empty($data)) {
								if(is_file("admin/$data.php")) include "admin/$data.php";
								else echo "<br />Nie odnaleziono takiej strony!";
							} elseif(!empty($action)) {
								if(is_file("page/$action.php")) include "page/$action.php";
								else echo "<br />Nie odnaleziono takiej strony!";
							}
						} else include "include/shop.php";
					?>
				</div>
				
				<div class="sidebar">
					<div class="social-networks">
						<a href="#" class="fb">FB</a>
						<a href="#" class="yt">YT</a>
						<a href="#" class="ts">TS</a>
					</div>
					
					<div class='server-state'>
						<div class='server-state-ip'><a href='#'>IP: <?php echo "$svr_ip";?></a></div>
						<?php
							$data = json_decode(file_get_contents('http://mcapi.ca/v2/query/info/?ip=' . $svr_ip), true);
						?>
						<div class='server-state-desc'><font color='#83c03c'>Online <?php echo $data['players']['online']. '/' .$data['players']['max']; ?></font></div>
					</div>
					
					<div class="social-fb">
						<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fcraftbestreaktywacja&amp;width=286&amp;height=258&amp;colorscheme=dark&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false&amp;locale=pl_PL" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:286px; height:258px;" allowTransparency="true"></iframe>
					</div>
					
					<div class="latest-vips">
						<h4>Ostatnio zakupione Uslugi</h4>
						<ul>
							<?php
							//Połączenie z mysql i wybranie bazy
							$link = mysql_connect("$dbhost", "$dbuser", "$dbpassword");
							mysql_query("SET NAMES utf8");
							mysql_select_db("$baza", $link);

							//Pobranie odpowieniej paczki
							$sql     = "Select * from  sms_history WHERE `status`=1 ORDER BY id DESC LIMIT 5";
							$result2 = mysql_query($sql, $link);

							while ($row = mysql_fetch_array($result2)) {  
								$nick     	 = $row['nick'];
								$zusluga 	 = $row['usluga'];
								$zusluga	 = str_replace('<b>', '', $zusluga);
								$zusluga	 = str_replace('</b>', '', $zusluga);
							?> 
								<li title="<?php echo "$zusluga"?>" class="masterTooltip"><?php echo "$nick"?></li>
							<?php }	mysql_close($link);	?>
							
						</ul>
					</div>  				
				</div>
			</div>
			
			<footer>
				<div class="modals">
					<div id="coder" class="modal">
						<p>Assembly x86,C/C++,PHP,Squirrel,Linux<br/>Kontakt: brak</p>
					</div>
				</div>
				<div class="copyright">CopyRight &copy; 2011-<?php echo date("Y");?> CraftBest.pl - Kopiowanie Zabronione!</div>
				<div class="creator">CMS: <a href="mailto:rafal.olszewski@thestreamroom.pl">lukaszfr</a></div>
				<div class="creator label label-black">Realizacja <a href="mailto:rafal.olszewski@thestreamroom.pl">Rafał Olszewski</a></div>
			</footer>
		</div>
	</body>

</html>