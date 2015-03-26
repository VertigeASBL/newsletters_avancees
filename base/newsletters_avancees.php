<?php
/**
 * Modification de la structure de la base de données
 *
 * @plugin     Newsletters Avancés
 * @copyright  2015
 * @author     Michel @ Vertige ASBL
 * @licence    GNU/GPL
 */

if (!defined('_ECRIRE_INC_VERSION')) return;


/**
 * Ajouter une colonne "rang" à la table newsletters_liens
 *
 * @pipeline declarer_tables_auxiliaires
 * @param  array $tables_auxiliaires : Données du pipeline
 *
 * @return array Données du pipeline
 */
function newsletters_avancees_declarer_tables_auxiliaires ($tables_auxiliaires) {

    $tables_auxiliaires['spip_newsletters_liens']['field']['rang'] = "bigint(21) DEFAULT '0' NOT NULL";

    return $tables_auxiliaires;
}