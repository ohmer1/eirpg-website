<?php
if (!isset($_GET['Nom']) || empty($_GET['Nom'])) {
	die('tatata');
}
$title = 'Information du joueur '.$_GET['Nom'];
require('_header.php');

$info = getInfoByPerso($_GET['Nom']);
$pid = $info['Id_Personnages'];
if ($pid === false) {
	die('mauvais retour de getinfo');
}
?>

<h1><?php echo $title?></h1>
<div id="player_info">
<p>
<?php
printf("\tPrésence irc: %s<br />\n",$info['Nick'].'!'.$info['UserHost']);
printf("\tNom du personnage: %s<br />\n",utf8_encode($info['Nom']));
printf("\tClasse: %s<br />\n",utf8_encode($info['Class']));
printf("\tNiveau: %s<br />\n",$info['Level']);
printf("\tNiveau suivant: %s<br />\n",convSecondes($info["Next"]));
printf("\tCréé le: %s<br />\n",$info['Created']);
printf("\tDernier login: %s<br />\n",$info['LastLogin']);
printf("\tIdle pendant: %s\n<br />",convSecondes($info['Idled']));
?>
</p>
</div>

<?php
$query = "SELECT o.LObj_Id, o.Level, lo.Name, lo.EstUnique FROM Objets as o, ListeObjets as lo WHERE o.Pers_Id=:Perso_id AND lo.Id_ListeObjets = o.LObj_Id";
$sth = $db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY, PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => TRUE));
if (!$sth) {
	error_sql($db->errorInfo());
}
$sth->execute(array(':Perso_id'=>$pid));
$allObj = $sth->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Liste des objets de <?php echo $_GET['Nom'] ?></h2>
<div id="obj_list">
<p>Nombre d'objets : <?php echo count($allObj) ?></p>
<ul>
<?php
$total = 0;
foreach($allObj as $objet) {
	$est_unique = ($objet['EstUnique'] == 'O') ? " class=\"unique\"":'';
	echo '<li><strong'.$est_unique.'>'.utf8_encode($objet['Name']).'</strong> de niveau <strong>'.$objet['Level']."</strong></li>\n\t";
	$total+= $objet['Level'];
}
?>
</ul>
<p>
Puissance cumulée : <?php echo $total ?>
</p>
</div>

<?php
require '_footer.php';
?>