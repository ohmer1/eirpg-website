<?php
$title = 'Liste des joueurs';
require('_header.php');
?>
<h1>Liste des joueurs</h1>
<div id="users-list">
<ul>
<?php

$query = "SELECT Nom, Class, Level, Next FROM Personnages ORDER BY Id_Personnages ASC";
foreach ($db->query($query) as $row) {
	$s = convSecondes($row["Next"]);
	printf ("\t<li>Joueur <a href=\"joueur.php?Nom=%1\$s\">%1\$s</a>, le %2\$s de niveau %3\$d. Prochain niveau dans %4\$s</li>\n", utf8_encode($row["Nom"]), utf8_encode($row["Class"]),$row["Level"],$s);
}

?>
</ul>
<div>
<?php
require('_footer.php');
?>