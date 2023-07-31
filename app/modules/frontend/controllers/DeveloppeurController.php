<?php
declare(strict_types=1);

namespace Phalcon\modules\frontend\controllers;

use Phalcon\Models\Developpeur;
use Phalcon\Mvc\Controller;

class DeveloppeurController extends Controller
{

    public function indexAction()
    {
        $developpeurs = [];
        foreach (Developpeur::find() as $developpeur) {
            $developpeurs[] = [
                'id' => $developpeur->getId(),
                'competence' => $developpeur->getCompetence(),
                'ip' => $developpeur->getIndiceProduction(),
                'composant' => $developpeur->getComposants(),
                'modules' => $developpeur->getModules(),
                'applications' => $developpeur->getApplications()
            ];
        }
        $this->view->setVar('developpeur', $developpeurs);
    }

}

