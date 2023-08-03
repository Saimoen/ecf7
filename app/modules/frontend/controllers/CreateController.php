<?php
declare(strict_types=1);

namespace Phalcon\modules\frontend\controllers;

use Phalcon\Models\Collaborateur;
use Phalcon\Models\Equipe;
use Phalcon\Models\Projet;
use Phalcon\Models\Client;
use Phalcon\Mvc\Controller;


class CreateController extends Controller
{

    public function indexAction()
    {
    }

    public function collaborateurAction()
    {
        if($this->request->isPost()) {
            $competence = $this->request->getPost('niveau_competence');
            $nom = $this->request->getPost('nom');
            $prenom = $this->request->getPost('prenom');
            $prime = $this->request->getPost('prime');
            $newCollaborateur = (new Collaborateur())
                ->setNiveauCompetence($competence)
                ->setNom($nom)
                ->setPrenom($prenom)
                ->setPrimeEmbauche($prime);
            if ($newCollaborateur->save()) {
                // Le collaborateur a été sauvegardé avec succès
                // Vous pouvez rediriger l'utilisateur vers une autre page ou afficher un message de succès
                return $this->response->redirect('/ecf7/');
            } else {
                // Il y a eu une erreur lors de la sauvegarde du collaborateur
                // Affichez les messages d'erreur de validation
                foreach ($newCollaborateur->getMessages() as $message) {
                    $this->flash->error($message);
                }
            }
        }
    }
}

