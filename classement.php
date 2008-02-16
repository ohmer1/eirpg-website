<?php
require 'includes/prepend.php';
require 'includes/ew_paginate.php';
require 'includes/ew_classement.php';

if (isset($_GET['top']))   $params['top']   = intval($_GET['top']);
if (isset($_GET['flop']))  $params['flop']  = intval($_GET['flop']);
if (isset($_GET['sort']))  $params['sort']  = $_GET['sort'];
if (isset($_GET['order'])) $params['order'] = $_GET['order'];
$params['arrows']      = array('up' => '&#9660;', 'down' => '&#9650;', 'class' => 'arrow');
$params['db']          =& $db;

$tplList['start']      = '<h1>{title}</h1>
<div id="users-list">
{pagination}<table class="ListePerso"><tr><th>ID{aID}</th><th>Personnage{aNom}</th><th>Class{aClass}</th><th>Niveau{aNiveau}</th><th>Prochain niveau dans{aTTL}</th><th><acronym title="Somme d\'objets">S.O.</acronym>{aSO}</th></tr>';
$tplList['items']      = '<tr><td>{id}</td><td><a href="joueur.php?Nom={Nom}">{Nom}</a></td><td>{Class}</td><td>{Niveau}</td><td>{TTL}</td><td>{SO}</td></tr>';
$tplList['end']        = '</table>
{nbpersos}<div>';
$tplList['pagination'] = "<p>{pages}</p>\n";
$tplList['nbpersos']   = "<p>Nombre de personnages : {persos}</p>\n";

$ew_classement = new ew_classement($params, $tplList);
$title         = $ew_classement->title;

require 'templates/header.tpl.php';
echo $ew_classement->getPersosList().'
    <p><a class="small" href="xml.php?'.$ew_classement->getVars().'">[Obtenir en XML]</a></p>';
require 'templates/footer.tpl.php';
?>