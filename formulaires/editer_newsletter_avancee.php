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

    if (saisies_liste_verifier('selection_editoriale'))
        return array();

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

    if (saisies_liste_traiter('selection_editoriale'))
        return array('editable' => 'oui');

    include_spip('action/editer_liens');

    $traiter = charger_fonction('traiter', 'formulaires/editer_newsletter');
    $retour = $traiter($id_newsletter, $retour);

    if ($id_newsletter === 'new') {
        $id_newsletter = $retour['id_newsletter'];
    }

    /* Pas besoin de défaire d'éventuels liens existants, puisque la
       fonction traiter du formulaire d'édition de newsletters de base
       s'en charge déjà */
    $selection_editoriale = _request('selection_editoriale');

    foreach ($selection_editoriale as $i => $article) {
        $id_article = str_replace('article|', '', $article['article'][0]);
        objet_associer(array('newsletter' => $id_newsletter),
                       array('article' => $id_article),
                       array('rang' => $i));
    }

    return $retour;
}
