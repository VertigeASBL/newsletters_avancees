<?php

/**
 * Saisies du formulaire d'édition des newsletters avancées
 *
 * @return array
 *     Tableau des saisies du formulaire
 */
function formulaires_editer_newsletter_avancee_saisies_dist ($id_newsletter='new', $retour='') {

    $saisies = array(
        array(
            'saisie' => 'liste',
            'options' => array(
                'nom' => 'selection_editoriale',
                'label' => _T('newsletters_avancees:label_selection_editoriale'),
            ),
            'saisies' => array(
                array(
                    'saisie' => 'selecteur_article',
                    'options' => array(
                        'nom' => 'article',
                        'label' => _T('newsletters_avancees:label_article'),
                    ),
                ),
            ),
        ),
    );

    return $saisies;
}

/**
 * Chargement du formulaire d'édition des newsletters avancées
 *
 * Déclarer les champs postés et y intégrer les valeurs par défaut
 *
 * @return array
 *     Environnement du formulaire
 */
function formulaires_editer_newsletter_avancee_charger_dist ($id_newsletter='new', $retour='') {

    $charger = charger_fonction('charger', 'formulaires/editer_newsletter');

    $valeurs = $charger($id_newsletter, $retour);

    include_spip('action/editer_liens');

    $articles_lies = objet_trouver_liens(array('newsletter' => $id_newsletter), array('article' => '*'));

    $valeurs['selection_editoriale'] = array_map(function ($article) {
        return array(
            'article' => "article|" . $article['id_objet'],
        );
    }, $articles_lies);

    return $valeurs;
}

/**
 * Vérifications du formulaire d'édition des newsletters avancées
 *
 * Vérifier les champs postés et signaler d'éventuelles erreurs
 *
 * @return array
 *     Tableau des erreurs
 */
function formulaires_editer_newsletter_avancee_verifier_dist ($id_newsletter='new', $retour='') {

    $erreurs = array();

    return $erreurs;

}

/**
 * Traitement du formulaire d'édition des newsletters avancées
 *
 * Traiter les champs postés
 *
 * @return array
 *     Retours des traitements
 */
function formulaires_editer_newsletter_avancee_traiter_dist ($id_newsletter='new', $retour='') {

    $retour = array(
        'editable' => 'oui',
        'message_ok' => 'ok',
    );

    return $retour;
}
