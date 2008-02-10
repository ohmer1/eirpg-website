<?php

function convSecondes($sec) {
	if ($sec == 0) {
		return "00:00:00";
	} else {
		return sprintf("%d jour%s, %02d:%02d:%02d", $sec/86400,intval($sec/86400)<=1?"":"s", ($sec%86400)/3600,($sec%3600)/60,$sec%60);
	}
}

function error_sql($error) {
	echo "\nPDO::errorInfo():<br/>\n";
	print_r($error);
	die;
}

function getInfoByPerso ($perso) {
	global $db;
	$query = "SELECT p.* FROM Personnages as p WHERE p.Nom = :Nom";
	$sth = $db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY, PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => TRUE));
	if (!$sth) {
		error_sql($db->errorInfo());
	}
	$sth->execute(array(':Nom'=>$perso));
	$result = $sth->fetch(PDO::FETCH_ASSOC);
	if ($result) {
		$query = "SELECT Nick, UserHost FROM IRC WHERE Pers_Id = :Perso_id";
		$st = $db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY, PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => TRUE));
		if (!$st) {
			error_sql($db->errorInfo());
		}
		$st->execute(array('Perso_id'=>$result['Id_Personnages']));
		$r2 = $st->fetch(PDO::FETCH_ASSOC);
		if ($r2)
			$result = array_merge($result,$r2);
		else
			$result = array_merge($result,array('Nick'=>'<strong>&lt;&lt;offline&gt;&gt;</strong>','UserHost'=>''));
	}
	return $result;
}

?>