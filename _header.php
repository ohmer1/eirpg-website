<?php
error_reporting(E_ALL);
function convSecondes($sec) {
	if ($sec == 0) {
		return "00:00:00";
	} else {
		return sprintf("%d jour%s, %02d:%02d:%02d", $sec/86400,intval($sec/86400)==1?"":"s", ($sec%86400)/3600,($sec%3600)/60,$sec%60);
	}
}

function error_sql($error) {
	echo "\nPDO::errorInfo():<br/>\n";
	print_r($error);
	die;
}

$dbhost = "localhost";
$dbuser = "eirpg";
$dbpass = "pass";
$dbname = "eirpg";

$db = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>EIRPG - <?php echo $title ?></title>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="irpg,eirpg,irc,network,rpg" />
	<style type="text/css" media="screen">
	/* <![CDATA[ */
	div#menu-top {
		padding: 5px;
		border: 1px solid #000;
		margin-bottom: 25px;
	}
	div#menu-top ul {
		margin-left: 0;
		padding-left: 0;
		display: inline;
	}
	div#menu-top ul li {
		margin-left: 0;
		padding: 3px 15px;
		border-left: 1px solid #000;
		list-style: none;
		display: inline;
    }
	div#menu-top ul li.premier {
		margin-left: 0;
		border-left: none;
		list-style: none;
		display: inline;
	}
	.unique {
		color: purple;
	}
	/* ]]> */
	</style>
	
	<base href="http://xrogaan.oh-my-songs.com/irpg/" />
</head>
<body>
<div id="menu-top">
<ul>
	<li class="premier"><a href="index.php">Accueil</a></li>
	<li><a href="top10.php">Le top 10</a></li>
	<li><a href="joueurs.php">Liste des joueurs</a></li>
</ul>
</div>
