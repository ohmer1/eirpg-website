<?php
  /*
   * PHP version 5
   * 
   * @copyright  Copyright (C) 2008 cedricpc
   * @author     cedricpc <cedricpc@cedricpc.net>
   * @license    http://www.opensource.org/licenses/mit-license.html MIT License
   * @created    Wednesday 13 February 2008 @ 21:30 (CET)
   * @modified   Friday    15 February 2008 @ 02:05 (CET)
   */

  class ew_classement {
      //Variables privées.
      private $flop;      //(Int) Même chose que si dessus mais en mode Flop à condition que le mode Top de soit pas actif.
      private $maxPersos; //(Int) Nombre de personnage par page - la class ew_paginate doit déjà être incluse.
      private $top;       //(Int) Passe en mode Top si sa valeur est > 0 et affiche cette quantité de personnages.
      private $order;     //(Str) Ordre de tri : asc(endant) ou desc(endant).
      private $prefix;    //(Str) Préfixe de la base de donnée de eIRPG.
      private $sort;      //(Str) Critère de trie : id, nom, class, niveau, ttl et so.
      private $arrows;    //(Arr) Tableau contenant les flèches - texte ou image... Clés à définir : up, down et class.
      private $tplList;   //(Arr) Tableau contenant les templates... Clés à définir : start, items, end ; Facultatives : pagination et nbpersos.
      private $db;        //(Obj) Référence vers l'objet de la base de donnée.

      //Variables publiques.
      public $title;      //(Str) Titre de la page.
      public $varPage;    //(Arr) Variables de la page.


      public function __construct($params, $tplList) {
          if (! is_array($params))  $params  = array();

          if (array_key_exists('db', $params)) $this->db = $params['db'];

          $this->tplList   = is_array($tplList) ? $tplList : array();
          $this->top       = isset($params['top']) ? intval($params['top']) : 0;
          $this->flop      = isset($params['flop']) ? intval($params['flop']) : 0;
          $this->sort      = Null;
          $this->order     = Null;
          $this->prefix    = isset($params['prefix']) ? $params['prefix'] : '';
          $this->maxPersos = isset($params['maxPersos']) ? intval($params['maxPersos']) : 30;
          $this->varPage   = array();
          $this->arrows    = isset($params['arrows']) ? $params['arrows'] : array();

          if (! empty($this->top)) {
              $this->flop      = 0;
              $this->title     = 'Top '.$this->top.' des joueurs.';
              $this->varPage[] = 'top='.$this->top;
          }
          elseif (! empty($flop)) {
              $this->title     = 'Flop '.$this->flop.' des joueurs.';
              $this->varPage[] = 'flop='.$this->flop;
          }
          else {
              $this->sort  = isset($params['sort']) ? $params['sort'] : Null;
              $this->order = isset($params['order']) ? $params['order'] : Null;
              $this->title = 'Classement des joueurs';
              if (! empty($this->sort))  $this->varPage[] = 'sort='.$this->sort;
              if (! empty($this->order)) $this->varPage[] = 'order='.$this->order;
          }
      }

      public function loadDB($db) {
          $this->db = $db;
      }

      public function getVars() {
          return implode('&amp;', $this->varPage);
      }

      public function getURI() {
          $vars = $this->getVars();
          return $_SERVER['SCRIPT_NAME'].(! empty($vars) ? '?'.$vars : '');
      }

      public function getPersosList() {
          if ((empty($this->top)) && (empty($this->flop))) {
              $query      = 'SELECT COUNT(*) as `elems` FROM `'.$this->prefix.'Personnages`';
              $result     = $this->db->query($query);
              $nbPerso    = $result->fetch(PDO::FETCH_NUM);

              if ((class_exists('ew_paginate')) && ($this->maxPersos > 0)) {
                  $pages      = new ew_paginate($nbPerso[0], $this->maxPersos);
                  $pagination = $pages->paginate($this->getURI());
              }

              switch ($this->sort) {
                  case 'nom':
                      $orderBy = '`Nom` %1$s';
                      break;
                  case 'class':
                      $orderBy = '`Class` %1$s';
                      break;
                  case 'ttl':
                      $orderBy = '`Next` %1$s';
                      break;
                  case 'so':
                      $orderBy = '`SommeObjets` %1$s';
                      break;
                  case 'id':
                      $orderBy = '`Id_Personnages` %1$s';
                      break;
                  default:
                      $sort    = 'niveau';
                      $orderBy = '`Level` %1$s, `Next` %2$s';
                      break;
              }
              $orderBy = sprintf($orderBy, ($this->order == 'asc' ? 'ASC' : 'DESC'), ($this->order == 'asc' ? 'DESC' : 'ASC')); 

              $query = 'SELECT `Id_Personnages`, `Nom`, `Class`, `p`.`Level`, `Next`, SUM(`o`.`Level`) AS `SommeObjets`
                        FROM `'.$this->prefix.'Personnages` AS `p`
                        LEFT JOIN `'.$this->prefix.'Objets` AS `o` ON `Id_Personnages` = `Pers_Id`
                        GROUP BY `Id_Personnages`
                        ORDER BY '.$orderBy.'
                        '.(isset($pages) ? $pages->get_sql_limit_statement() : 'LIMIT '.$this->maxPersos);

              $items = '';
              foreach ($this->db->query($query) as $row) {
                  $secondes = convSecondes($row['Next']);
                  $searchItems  = array('{id}', '{nom}', '{class}', '{niveau}', '{ttl}', '{so}');
                  $replaceItems = array($row['Id_Personnages'], htmlentities($row['Nom']), htmlentities($row['Class']), $row['Level'], $secondes, $row['SommeObjets']);
                  $items       .= str_ireplace($searchItems, $replaceItems, $this->tplList['items']."\n");
              }
          }
          else {
              $query = 'SELECT `Id_Personnages`, `Nom`, `Class`, `p`.`Level`, `Next`, SUM(`o`.`Level`) AS `SommeObjets`
                        FROM `'.$this->prefix.'Personnages` AS `p`
                        LEFT JOIN `'.$this->prefix.'Objets` AS `o` ON `Id_Personnages` = `Pers_Id`
                        GROUP BY `Id_Personnages`
                        ORDER BY `Level` '.(! empty($this->top) ? 'DESC' : 'ASC').', `Next` '.(! empty($this->top) ? 'ASC' : 'DESC').' 
                        LIMIT '.(! empty($this->top) ? $this->top : $this->flop);

              $items = '';
              foreach ($this->db->query($query) as $row) {
                  $secondes = convSecondes($row['Next']);
                  $searchItems  = array('{id}', '{nom}', '{class}', '{niveau}', '{ttl}', '{so}');
                  $replaceItems = array($row['Id_Personnages'], htmlentities($row['Nom']), htmlentities($row['Class']), $row['Level'], $secondes, $row['SommeObjets']);
                  $items       .= str_ireplace($searchItems, $replaceItems, $this->tplList['items']."\n");
              }
          }

          $search  = array('{title}', '{nbpersos}', '{persos}', '{pagination}', '{pages}', '{aid}', '{anom}', '{aclass}', '{aniveau}', '{attl}', '{aso}');
          $replace = array(
              $this->title,
              (isset($this->tplList['nbpersos']) && isset($nbPersos) ? $this->tplList['nbpersos'] : ''),
              (isset($nbPersos) ? $nbPersos[0] : ''),
              (isset($this->tplList['pagination']) && isset($pagination) ? $this->tplList['pagination'] : ''),
              (isset($pagination) ? $pagination : ''),
              $this->getArrows('id'),
              $this->getArrows('nom'),
              $this->getArrows('class'),
              $this->getArrows('niveau'),
              $this->getArrows('ttl'),
              $this->getArrows('so')
          );
          $return  = str_ireplace($search, $replace, $this->tplList['start']."\n".$items.$this->tplList['end']);

          return $return;
      }

      public function getArrows($sort) {
          $cSort = (empty($this->sort)) || (! preg_match('!^id|nom|class|niveau|ttl|so$!', $this->sort)) ? 'niveau' : $this->sort;
          $uri   = $_SERVER['SCRIPT_NAME'];

          $return  = ' ';
          $return .= ($sort != $cSort) || ($this->order != 'asc') && empty($this->flop) ? '<a class="'.$this->arrows['class'].'" href="'.$uri.'?sort='.$sort.'&amp;order=asc">'.$this->arrows['down'].'</a>' : '';
          $return .= ($sort != $cSort) || ($this->order == 'asc') || (! empty($this->flop)) ? '<a class="'.$this->arrows['class'].'" href="'.$uri.'?sort='.$sort.'&amp;order=desc">'.$this->arrows['up'].'</a>' : '';
              
          return $return;
      }
  }
?>