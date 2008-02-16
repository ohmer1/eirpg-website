<?php
  error_reporting(E_ALL);

  require_once 'includes/functions.php';
  require_once 'includes/ew_config.php';

  $ew_config = new ew_config(require 'config.inc.php',true);
  $eb_config = new ew_config(parse_ini_file($ew_config->config_file,true));

  $ew_config->merge($eb_config);

  unset($eb_config);

  $db = new PDO('mysql:host='.$ew_config->SQL->host.';dbname='.$ew_config->SQL->base, $ew_config->SQL->login, $ew_config->SQL->password);

  $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);

  define('EW_GLOBALTITLE',$ew_config->overall_title);
?>