<?php
declare(strict_types=1);

namespace Phalcon\modules\frontend\controllers;

use Phalcon\Models\Collaborateur;
use Phalcon\Models\Equipe;
use Phalcon\Models\Projet;
use Phalcon\Mvc\Controller;

class ProjetController extends Controller
{

    public function indexAction()
    {
        $projets = [];
        foreach (Projet::find() as $projet) {
            $projets = [
                'id_developpeur' => $projet->getIdDeveloppeur(),
                'id_module' => $projet->getIdModule(),
                'id_application' => $projet->getIdModule(),
                'id_composant' => $projet->getIdComposant(),
                'id_chef_de_projet' => $projet->getIdChefDeProjet(),
                'type' => $projet->getType(),
                'id_client' => $projet->getIdClient(),
                'prix' => $projet->getPrix(),
                'statut' => $projet->getStatut(),
            ];
        }
        $this->view->setVar('projet', $projets);
    }

}

