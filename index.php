<?php
$title = "Accueil";
require 'includes/prepend.php';
require 'MarkDown/markdown.php';

$tpl = new Ew_Template();
$tpl->addFile('begin','header.tpl.php');
$tpl->addFile('end','header.tpl.php');
$tpl->addFile('index','index.tpl.php');

$tpl->ew_config =& $ew_config;

echo MarkDown($tpl->render('index'));
?>