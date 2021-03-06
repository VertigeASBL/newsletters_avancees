<?php
/**
 * Fichier gérant l'installation et désinstallation du plugin Newsletter avancées
 *
 * @plugin     Newsletter avancées
 * @copyright  2015
 * @author     Michel @ Vertige ASBL
 * @licence    GNU/GPL
 * @package    SPIP\Newsletters_avancees\Installation
 */

if (!defined('_ECRIRE_INC_VERSION')) return;


/**
 * Fonction d'installation et de mise à jour du plugin Newsletter avancées.
 *
 * @param string $nom_meta_base_version
 *     Nom de la meta informant de la version du schéma de données du plugin installé dans SPIP
 * @param string $version_cible
 *     Version du schéma de données dans ce plugin (déclaré dans paquet.xml)
 * @return void
**/
function newsletters_avancees_upgrade($nom_meta_base_version, $version_cible) {
    $maj = array();

    $maj['create'][] = array('maj_tables', array('spip_newsletters_liens'));

    include_spip('base/upgrade');
    maj_plugin($nom_meta_base_version, $version_cible, $maj);
}


/**
 * Fonction de désinstallation du plugin Newsletter avancées.
 *
 * @param string $nom_meta_base_version
 *     Nom de la meta informant de la version du schéma de données du plugin installé dans SPIP
 * @return void
**/
function newsletters_avancees_vider_tables($nom_meta_base_version) {

    include_spip('base/abstract_sql');

    sql_alter("TABLE spip_newsletters_liens DROP rang");

    effacer_meta($nom_meta_base_version);
}