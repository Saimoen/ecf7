<?php
declare(strict_types=1);

namespace Phalcon\modules\frontend\controllers;

use Phalcon\Models\Collaborateur;
use Phalcon\Models\Equipe;
use Phalcon\Models\Projet;
use Phalcon\Mvc\Controller;

class CollaborateurController extends Controller
{

    public function indexAction()
    {
        $collaborateurs = [];
        foreach (Collaborateur::find() as $collaborateur) {
            $collaborateurs[] = [
                'id' => $collaborateur->getId(),
                'nom' => $collaborateur->getNom(),
                'prenom' => $collaborateur->getPrenom(),
                'competence' => $collaborateur->getNiveauCompetence(),
                'prime' => $collaborateur->getPrimeEmbauche()
            ];
        }
        $this->view->setVar('collaborateur', $collaborateurs);
    }

}

