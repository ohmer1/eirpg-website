<?php

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

function getInfoByPerso ($perso) {
	global $db;
	$query = "SELECT p.* FROM Personnages as p WHERE p.Nom = :Nom";
	$sth = $db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	if (!$sth) {
		error_sql($db->errorInfo());
	}
	$sth->execute(array(':Nom'=>$perso));
	$result = $sth->fetch(PDO::FETCH_ASSOC);
	if ($result) {
		$query = "SELECT Nick, UserHost FROM IRC WHERE Pers_Id = :Perso_id";
		$st = $db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
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

class paginator {

	public $limit_by_page=10;
	public $elements=0;
	public $page_variable="p";
	public $current_page=1;
	public $number_of_pages;
	
	function get_sql_limit_statement() {
		$max = $this->current_page*$this->limit_by_page;
		$min = $max-$this->limit_by_page;
		return "LIMIT $min, $max";
	}

	function paginate($pageurl) {
		$this->number_of_pages = ceil($this->elements / $this->limit_by_page);
		if ($number_of_pages == 1) {
			return "Page : 1.";
		} else {
			$i=1;
			$txt = '&lt; <a href="'.$pageurl.'?'.$paginate_var.($current_page-1).'">précédent</a> | ';
			while($i < $number_of_pages) {
				if ($i == $current_page) {
					$txt.= "page $i, ";
				} else {
					$txt.= '<a href="'.$pageurl.'?'.$paginate_var.$i.'" class="paginator">page '.$i.'</a>, ';
				}
				$i++;
			}
			return substr($txt,0,-2).'.';
		}
	}

}
?>