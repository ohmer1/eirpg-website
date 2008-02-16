<?php
$title = "Show config";
require 'templates/header.tpl.php';

function p_row($explain,$value,$iscode=false) {
	global $basetab;
	$tab='';
	if ($basetab > 0) {
		do {
			$tab.= "\t";
			$basetab--;
		} while ($basetab > 0);
	}

	$res =  $tab.'<div class="row">'."\n\t".
			$tab.'<div class="left">'."\n\t\t".
			$tab.'<span class="ctitle">'.$explain.'&nbsp;:</span>'."\n";

	$res .= "$tab\t".'</div>'."\n";

	if ($iscode)
		$value = '<code>'.htmlentities($value).'</code>';

	$res .= "\t$tab".
			'<div class="right">'."\n\t\t$tab".
			'<span class="cvalue">'.$value.'</span>'."\n\t$tab";

	$res .= '</div>'."\n$tab".
			'</div>';

	return $res;
}

?>
<div id="content">

	<div class="rowset">
	<h2>Informations</h2>
<?php
$basetab = 2;
echo p_row('Maitre du bot',$ew_config->IRPG->admin);
echo p_row('Purge',$ew_config->IRPG->purge.' jours');
echo p_row('Version',$ew_config->IRPG->version);
?>

	<div class="spacer">&nbsp;</div>
	</div>
	<div class="rowset">
	<h2>Détails sur mod_core</h2>
<?php

echo p_row('Max de perso par user', $ew_config->mod_core->maxPerso);
echo p_row('Penalité au logout', $ew_config->mod_core->penLogout.'*('.$ew_config->mod_core->expPenalite.'^level)',true);

?>

	<div class="spacer">&nbsp;</div>
	</div>
	<div class="rowset">
	<h2>Détails sur mod_idle</h2>
	<p>Module qui calcul l'idle des joueurs.</p>

<?php

echo p_row('Calcul du temps d\'idle', ''.$ew_config->mod_idle->idleBase.'*'.$ew_config->mod_idle->expLvlUp.'^level',true);

?>
		<div class="spacer">&nbsp;</div>
	</div>
	<div class="rowset">
	<h2>Détails sur mod_penalites</h2>
	<p>Module qui gère les pénalités à appliquer</p>

<?php

echo p_row('Pénalité privmsg', '('.
		$ew_config->mod_penalites->penPrivmsg.'*Longueur du message) * ('.
		$ew_config->mod_penalites->expPenalite.'^level)',true);
echo p_row('Pénalité notice', '('.
		$ew_config->mod_penalites->penNotice.'*Longueur du message) * ('.
		$ew_config->mod_penalites->expPenalite.'^level)',true);
echo p_row('Pénalité nick', '('.
		$ew_config->mod_penalites->penNick.'*('.
		$ew_config->mod_penalites->expPenalite.'^level)',true);
echo p_row('Pénalité quit', '('.
		$ew_config->mod_penalites->penQuit.'*('.
		$ew_config->mod_penalites->expPenalite.'^level)',true);
echo p_row('Pénalité part', '('.
		$ew_config->mod_penalites->penPart.'*('.
		$ew_config->mod_penalites->expPenalite.'^level)',true);
echo p_row('Pénalité kick', '('.
		$ew_config->mod_penalites->penKick.'*('.
		$ew_config->mod_penalites->expPenalite.'^level)',true);

?>
		<div class="spacer">&nbsp;</div>
	</div>

	<div class="rowset">
	<h2>Détails sur mod_ohvstatus</h2>
	<p>Ce module gère les modes à appliquer aux utilisateurs selon leur niveau dans le jeu.</p>

<?php

echo p_row('Status du mode Op', (($ew_config->mod_ohvstatus->op == 1) ? 'Actif':'Désactivé'));
echo p_row('Status du mode Halfop', (($ew_config->mod_ohvstatus->hop == 1) ? 'Actif':'Désactivé'));
echo p_row('Status du mode Voice', (($ew_config->mod_ohvstatus->voice == 1) ? 'Actif':'Désactivé'));
echo p_row('Niveau requis pour être OP', $ew_config->mod_ohvstatus->oplvl);
echo p_row('Niveau requis pour être Halfop', $ew_config->mod_ohvstatus->hoplvl);
echo p_row('Niveau requis pour être Voice', $ew_config->mod_ohvstatus->voicelvl);

?>
		<div class="spacer">&nbsp;</div>
	</div>

	<div class="rowset">
	<h2>Détails sur mod_quests</h2>
	<p>Ce module gère les quêtes.</p>

<?php
/*
[mod_quests]

probaAllQuete = "500"	;Probabilité qu'une quete se declare toutes les 15 secondes. ex: 1 chance sur 500 qu'une quete se declare.
probaQueteA = "80"		;Probabilité en % qu'une quete aventure se declare. ex.: 80% de chance qu'un quete aventure se declare et 20% une quete royaume
*/
echo p_row('Temps min. d\'une <acronym title="Quete d\'Aventure">QA</acronym>',
		convSecondes($ew_config->mod_quests->tempsQueteA));
echo p_row('Temps min. d\'une <acronym title="Quete de Royaume">QR</acronym>',
		convSecondes($ew_config->mod_quests->tempsQueteR));
echo p_row('Recompense en % d\'une <acronym title="Quete de d\'Aventure">QA</acronym>',
		$ew_config->mod_quests->recompenseA);
echo p_row('Recompense en % d\'une <acronym title="Quete de Royaume">QR</acronym>',
		$ew_config->mod_quests->recompenseR);
echo p_row('Recompense en % d\'une <acronym title="Quete du Survivant">QS</acronym>',
		$ew_config->mod_quests->recompenseS);
echo p_row('Penalité minimal pour le participant d\'une quete',
		$ew_config->mod_quests->MinPenalite);
echo p_row('Penalité maximal pour le participant d\'une quete',
		$ew_config->mod_quests->MaxPenalite);
echo p_row('Penalité minimal pour tout le monde lorsqu\'une <acronym title="Quete de Royaume">QR</acronym> est ratée',
		$ew_config->mod_quests->MinPenaliteAll);
echo p_row('Penalité maximal pour tout le monde lorsqu\'une <acronym title="Quete de Royaume">QR</acronym> est ratée',
		$ew_config->mod_quests->MaxPenaliteAll);
echo p_row('Nombre de participants minimal prenant part à une quête',
		$ew_config->mod_quests->nbrParticipants);
echo p_row('Level min. d\'un personnage pour participer à une <acronym title="Quete d\'Aventure">QA</acronym>',
		$ew_config->mod_quests->lvlMinimumA);
echo p_row('Level min. d\'un personnage pour participer à une <acronym title="Quete de Royaume">QR</acronym>',
		$ew_config->mod_quests->lvlMinimumR);
echo p_row('Level min. d\'un personnage pour participer à une <acronym title="Quete du Survivant">QS</acronym>',
		$ew_config->mod_quests->lvlMinimumS);
echo p_row('Temps min. d\'idle d\'un personnage pour participer à une <acronym title="Quete d\'Aventure">QA</acronym>',
		convSecondes($ew_config->mod_quests->tempsMinIdleA));
echo p_row('Temps min. d\'idle d\'un personnage pour participer à une <acronym title="Quete de Royaume">QR</acronym>',
		convSecondes($ew_config->mod_quests->tempsMinIdleR));
echo p_row('Temps min. d\'idle d\'un personnage pour participer à une <acronym title="Quete du Survivant">QS</acronym>',
		convSecondes($ew_config->mod_quests->tempsMinIdleS));
echo p_row('Probabilité qu\'une quete se déclare toutes les 15 secondes',
		"1 chance sur ".$ew_config->mod_quests->probaAllQuete." qu'une quête se déclare.");
echo p_row('Probabilité qu\'une <acronym title="Quete d\'Aventure">QA</acronym> se déclare',
		$ew_config->mod_quests->probaQueteA.'% de chance qu\'une <acronym title="Quete d\'Aventure">QA</acronym> se déclare et '.
		(100-$ew_config->mod_quests->probaQueteA).'% pour une <acronym title="Quete de Royaume">QR</acronym>');

?>
		<div class="spacer">&nbsp;</div>
	</div>
</div>
<?php
require 'templates/footer.tpl.php';
?>