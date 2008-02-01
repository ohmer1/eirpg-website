<?php
$title = "Accueil";
require('_header.php');
require('MarkDown/markdown.php');
$text = <<<EOF
# Accueil
<div id="accueil" markdown="1">
## introduction
L'abréviation [EIRPG](http://eirpg.com) signifie [EpiKnet](http://www.epiknet.org/) [IDLE Role Playing Game](http://en.wikipedia.org/wiki/IRPG). En d'autres termes, il s'agit d'un jeu de rôle dont le but est de rester sur un canal IRC à ne rien faire ! Certaines actions (message sur le canal, partir du canal ou d'IRC, logout, etc.) entraineront une pénalité suivant le coefficient établit pour ce type d'action. Plus vous restez inactif, plus vous monterez dans les niveaux... Mais sachez que plus vous avancez, plus le temps d'attente augmente - et les pénalités aussi !

## Avant de commencer à jouer...
### Création d'un compte

	/msg IRPG REGISTER <utilisateur> <mot_de_passe> <courriel>

Cette commande vous permet de créer un compte. Tout les caractères - ou presque - à l'exception des espaces sont permis en nom d'utilisateur et mot de passe. Merci de bien vouloir donner une adresse e-mail valide, elle peut nous servir en cas de changement de mot de passe par exemple.

__C'est cette commande que vous devrez faire en tout premier avant de pouvoir créer un personnage !__

### Création d'un personnage 

	/msg IRPG CREATE <nom_du_personnage> <classe>

Cette commande vous permet cette fois-ci de créer un personnage. Comme précédemment, tous les caractères - ou presque - à l'exception des espaces sont permis en nom de personnage. Pour la classe, laissez libre cours à votre imagination ! Les espaces sont autorisés cette fois-ci. Pour ceux qui ne savent pas à quoi cela correspond, c'est en fait une brève description de votre personnage.
Vous devez impérativement être déjà connecté à votre compte avant de pouvoir créer un personnage. (Voir commande ci-dessous.)

## Maintenant, vous êtes prêt à débuter !
### Se connecter à un compte 

	/msg IRPG LOGIN <utilisateur> <mot_de_passe>

Comme vous l'aurez deviné au titre, cette commande permet de se connecter à un compte utilisateur et non pas à un personnage. En effet, si vous possedez plusieurs personnages, vous y serez connectés à tous automatiquement.

*Cette commande ne vous inflige pas de pénalité.*

### Se déconnecter du bot 

	/msg IRPG LOGOUT

Là aussi, rien de très compliqué, cette commande déconnecte tous vos personnages du bot.

*Cette commande inflige à tous vos personnages une pénalité __p20__.*


### Méthode d'avertissement 

	/msg IRPG NOTICE <on/off>

Cette commande vous permet de configurer comment vous souhaitez qu'IRPG vous avertisse d'un changement de niveau, une pénalité, etc.... Si vous voulez les recevoir par notice, mettez on, sinon pour les recevoir par message privé, spécifiez off.
Par défaut, le bot vous avertit par notice

*Cette commande ne vous inflige pas de pénalité.*


### Informations sur votre compte et vos personnages 

	/msg IRPG WHOAMI

Cette commande va vous donner diverses informations tel que le compte sur lequel vous êtes connectés, vos personnages avec leurs niveaux et leurs temps restant avant le prochain...

*Cette commande ne vous inflige pas de pénalité.*


### Objets de vos personnages 

	/msg IRPG ITEMS [personnage]

Cette commande va vous indiquer tous les objets que porte actuellement le personnage indiqué ainsi que leurs niveaux. Si vous ne donnez pas de personnage, cette commande listera les objets de tous vos personnages.

*Cette commande ne vous inflige pas de pénalité.*


### Obtenir son grade (voice, halfop, op) 

	/msg IRPG UP

Cette commande vous mets votre grade : voice, halfop ou op suivant votre niveau. Normalement, vous l'obtenez lors de votre connexion ou d'un changement de niveau. Mais il arrive desfois que vous le perdiez - lors d'un netsplit notamment - et que vous ne changerez pas de niveau avant un moment.

*Cette commande ne vous inflige pas de pénalité.*


### Connaître l'état du mode Bonus 

	/msg IRPG BONUS

Cette commande permet de savoir si le bot vous considère en vu de l'obtention du Bonus Donateurs. Dans l'affirmatif, il vous indique la date d'expiration de ce mode.

*Cette commande ne vous inflige pas de pénalité.*

## Pénalités

Lorsque que vous effectuez une action autre qu'IDLE, comme par exemple partir du canal, quitter le serveur IRC, parler sur le canal, etc.... Tous vos personnages vont se voir ajouter à leurs temps avant le prochain niveau une pénalité en fonction de leurs niveaux.
Les formules sont les suivantes :


| Changer de pseudonyme  | Pénalité désactivée              |
| ---------------------- | --------------------------------:|
| Partir du canal        | `200*(1.14ˆNIVEAU)`              |
| Quitter le serveur IRC | `30*(1.14ˆNIVEAU)`               |
| Se déconnecter du bot  | `20*(1.14ˆNIVEAU)`               |
| Parler sur le canal    | `LONGUEUR_MESSAGE*(1.14ˆNIVEAU)` |
| Notice sur le canal    | `LONGUEUR_MESSAGE*(1.14ˆNIVEAU)` |
| Être kické du canal    | `250*(1.14ˆNIVEAU)`              |


Par exemple, si vous avez un personnage de niveau 30 et que vous partez du canal, il sera pénalisé de 10190 secondes pour atteindre son prochain niveau.

Les pénalités sont abrégées sous cette forme : `p[num]`. Par exemple, un départ du canal équivaut à une p200. Les messages et les notices sont marqués : `p[num]*[longueur du message]`.

</div>
EOF;
echo MarkDown($text);

require('_footer.php');
?>