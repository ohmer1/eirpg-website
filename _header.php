<?php
    require_once '_init.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title><?php echo EW_GLOBALTITLE ?> - <?php echo $title ?></title>
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

	table.ListePerso {
		width: 800px;
	}
	table.ListePerso td, table.ListePerso th {
		padding: 0 10px;
		border: 1px #CCC solid;
		text-align: center;
	}

       a.arrow { text-decoration: none; }

	a.small {
		color: #999;
		font-size: small;
		text-decoration: none;
	}
	/* ]]> */
	</style>
	
	<base href="<?php echo $ew_config->baseurl ?>" />
</head>
<body>
<div id="menu-top">
<ul>
	<li class="premier"><a href="index.php">Accueil</a></li>
	<li><a href="classement.php?top=10">Le top 10</a></li>
	<li><a href="classement.php?flop=10">Le flop 10</a></li>
	<li><a href="classement.php">Classement des personnages</a></li>
</ul>
</div>
