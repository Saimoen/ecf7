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
            $projets[] = [
                'id' => $projet->getId(),
                'cdp' => $projet->Chefdeprojet->Collaborateur->getNom(),
                'type' => $projet->getTypeLibelle(),
                'prix' => $projet->getPrix(),
                'statut' => $projet->getStatutLibelle()
            ];
        }
        $this->view->setVar('projets', $projets);
    }

}

