<?php
declare(strict_types=1);

namespace Phalcon\Modules\Frontend\Controllers;

use Phalcon\Models\Projet;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $projets = [];
        foreach (Projet::find() as $projet) {
            $projets[] = [
                'id' => $projet->getId(),
                'cdp' => $projet->getIdChefDeProjet(),
                'type' => $projet->getTypeLibelle(),
                'prix' => $projet->getPrix(),
                'statut' => $projet->getStatutLibelle()
            ];
        }
        $this->view->setVar('projets', $projets);
    }

//    Custom Validator

}

