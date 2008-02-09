<?php
error_reporting(E_ALL);

require 'includes/functions.php';
require 'includes/ew_config.php';

$eb_config = new ew_config(parse_ini_file("/home/xrogaan/EIRPG-6.0/irpg.conf",true));

$db = new PDO('mysql:host='.$eb_config->SQL->host.';dbname='.$eb_config->SQL->base, $eb_config->SQL->login, $eb_config->SQL->password);

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
