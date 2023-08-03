<?php
declare(strict_types=1);

namespace Phalcon\modules\frontend\controllers;

use Phalcon\Models\Collaborateur;
use Phalcon\Models\Equipe;
use Phalcon\Models\Chefdeprojet;
use Phalcon\Mvc\Controller;

class EquipeController extends Controller
{

    public function indexAction()
    {
        $equipes = [];
        foreach (Equipe::find() as $equipe) {
            $equipes[] = [
                'id' => $equipe->getId(),
                'cdp' => $equipe->Chefdeprojet->Collaborateur->getNom(),
                'libelle' => $equipe->getLibelle()
            ];
        }
        $this->view->setVar('equipe', $equipes);
    }

}

