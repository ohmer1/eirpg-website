<?php
error_reporting(E_ALL);

require 'includes/functions.php';
require 'includes/ew_config.php';

$ew_config = new ew_config(require 'config.inc.php',true);
$eb_config = new ew_config(parse_ini_file($ew_config->config_file,true));

$ew_config->merge($eb_config);

unset($eb_config);

//$db = new PDO('mysql:host='.$ew_config->SQL->host.';dbname='.$ew_config->SQL->base, $ew_config->SQL->login, $ew_config->SQL->password);

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
	acronym {
		cursor: help;
		border-top: 1px dashed #999;
	}
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

	div.rowset {
		width: 800px;
		margin-bottom: 1em;
		padding: 0.5em;
		padding-bottom: 2em;
		background-color: #FFF7E8;
		border: 1px solid #7E7E7E;
	}
	
	div.row {
		clear: both;
		padding-top: 10px;
		background-color: transparent;
	}

	div.row div.left {
		width: 255px;
		margin: 0 auto 0 8px;
		padding:0;
	}

	div.row div.right {
		margin: 0 8px 0 auto;
		padding:0;
		width: 590px;
	}

	div.row span.ctitle {
		float:left;
		font-weight: bold;
		width: 100%;
		text-align: right;
		border-bottom: 1px dashed #999;
	}
	
	div.row span.cvalue {
		float:left;
		margin-left: 10px;
		width: 515px;
		text-align: left;
	}
	
	div.row span.cvalue code {
		background-color: #FFE3AF;
	}
	
	form div.spacer { clear: both; }
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
