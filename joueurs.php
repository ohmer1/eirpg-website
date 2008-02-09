<?php
$title = 'Liste des joueurs';

require('_header.php');
require('includes/ew_paginate.php');

?>
<h1>Liste des joueurs</h1>
<div id="users-list">
<?php

$sql = "SELECT COUNT(*) as elems FROM Personnages";
$ft = $db->query($sql);
$num = $ft->fetch(PDO::FETCH_ASSOC);
$pages = new ew_paginate($num['elems']);


echo "<ul>\n";
$query = "SELECT Nom, Class, Level, Next FROM Personnages ORDER BY Id_Personnages ASC ".$pages->get_sql_limit_statement();
foreach ($db->query($query) as $row) {
	$s = convSecondes($row["Next"]);
	printf ("\t<li>Joueur <a href=\"joueur.php?Nom=%1\$s\">%1\$s</a>, le %2\$s de niveau %3\$d. Prochain niveau dans %4\$s</li>\n", utf8_encode($row["Nom"]), utf8_encode($row["Class"]),$row["Level"],$s);
}
echo "</ul>\n";
?>

<p>
Nombre de joueurs : <?php echo $num['elems'] ?>
</p>
<div>
<?php
require('_footer.php');
?>