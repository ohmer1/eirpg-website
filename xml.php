<?php
    require_once '_init.php';
    require_once 'includes/ew_paginate.php';
    require_once 'includes/ew_classement.php';

    if (isset($_GET['top']))   $params['top']   = intval($_GET['top']);
    if (isset($_GET['flop']))  $params['flop']  = intval($_GET['flop']);
    if (isset($_GET['sort']))  $params['sort']  = $_GET['sort'];
    if (isset($_GET['order'])) $params['order'] = $_GET['order'];
    $params['arrows']      = array('up' => '&#9660;', 'down' => '&#9650;', 'class' => 'arrow');
    $params['db']          =& $db;

    $tplList['start']      = '<?xml version="1.1" encoding="UTF-8" standalone="yes" ?>
<eirpg>
  <title>{title}</title>';
    $tplList['items']      = '  <personnage>
    <id>{ID}</id>
    <nom>{Nom}</nom>
    <class>{Class}</class>
    <niveau>{Niveau}</niveau>
    <ttl>{TTL}</ttl>
    <so>{SO}</so>
  </personnage>';
    $tplList['end']        = '</eirpg>';

    $ew_classement = new ew_classement($params, $tplList);
    echo $ew_classement->getPersosList();
?>