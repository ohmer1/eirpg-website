<?php
$title = 'Top 10 des joueurs';
require('_header.php');
?>
<h1>Top 10 joueurs</h1>
<div id="top-list">
<ul>
<?php
$query = "SELECT Nom, Class, Level, Next FROM Personnages ORDER BY Level DESC, Next ASC LIMIT 10";
foreach ($db->query($query) as $row) {
	$s = convSecondes($row["Next"]);
	printf ("\t<li>Joueur <a href=\"joueur.php?Nom=%1\$s\">%1\$s</a>, le %2\$s de niveau %3\$d. Prochain niveau dans %4\$s</li>\n", $row["Nom"], $row["Class"],$row["Level"],$s);
}

?>
</ul>
</div>
<?php
require('_footer.php');
?>
