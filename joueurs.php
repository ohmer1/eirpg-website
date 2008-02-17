<?php
$title = 'Liste des joueurs';

require 'includes/prepend.php';
require 'templates/header.tpl.php';
require 'includes/ew_paginate.php';

?>
<h1>Liste des joueurs</h1>
<div id="users-list">
<?php

$sql = "SELECT COUNT(*) as elems FROM Personnages";
$ft = $db->query($sql);
$num = $ft->fetch(PDO::FETCH_ASSOC);
$pages = new ew_paginate($num['elems'],$ew_config->users_by_page);

echo "<p>".$pages->paginate('joueurs.php')."</p>";
echo "<ul>\n";

$sql = "SELECT p.Nom, p.Class, p.Level, p.Next, SUM( o.Level ) AS 'puissance_totale'
FROM Personnages AS p
LEFT JOIN Objets AS o ON ( p.Id_Personnages = o.Pers_Id )
GROUP BY p.Id_Personnages
ORDER BY p.Id_Personnages ASC\n".$pages->get_sql_limit_statement();
//$query = "SELECT Nom, Class, Level, Next FROM Personnages ORDER BY Id_Personnages ASC ".$pages->get_sql_limit_statement();
foreach ($db->query($sql) as $row) {
	$s = convSecondes($row["Next"]);
	printf ("\t<li>Joueur <a href=\"joueur.php?Nom=%1\$s\">%1\$s</a>, le %2\$s de niveau %3\$d possédant une puissance de %5\$d. Prochain niveau dans %4\$s</li>\n", utf8_encode($row["Nom"]), utf8_encode($row["Class"]),$row["Level"],$s,$row['puissance_totale']);
}
echo "</ul>\n";
?>

<p>
Nombre de joueurs : <?php echo $num['elems'] ?>
</p>
<div>
<?php
require 'templates/footer.tpl.php';
?>