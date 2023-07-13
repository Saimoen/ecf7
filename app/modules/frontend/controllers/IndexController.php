<?php
declare(strict_types=1);

namespace Phalcon\Modules\Frontend\Controllers;

use Phalcon\Models\Projet;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $projets = Projet::find();
        $statutProjet = Projet::findFirst();
        $this->view->statut = $statutProjet;

        $developpeurs = Projet::find();
        $this->view->developpeurs = $developpeurs;



        /**
         * @var $chunkedProjets
         * Permet de séparer mes données en 3 pour l'affichage dans mes 3 colonnes
         */

        $chunkedProjets = array_chunk($projets->toArray(), (int)ceil(count($projets) / 3));

        $this->view->setVar('projets1', $chunkedProjets[0]);
        $this->view->setVar('projets2', $chunkedProjets[1]);
        $this->view->setVar('projets3', $chunkedProjets[2]);
        $this->view->setVar('developpeur', $developpeur);


    }

//    Custom Validator

}

