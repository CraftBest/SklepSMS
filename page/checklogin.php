<?php 
session_start(); 

$nickname = $_POST['myusername'];
$password = $_POST['mypassword'];

if($nickname == $nick && $password == $pass) {
	$_SESSION['myusername'] = $nickname;
	header("location:./index.php?action=voucher");
} else {
	echo "<article class=\"cf\">
		<h2><a href=\"#\">Niepowodzenie!</a></h2>
		<p align=\"justify\">Podany login lub haslo jest niepoprawne!</b></p>					
	</article>";
}

?>