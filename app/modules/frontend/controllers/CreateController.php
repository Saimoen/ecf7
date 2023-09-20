<?php
declare(strict_types=1);

namespace Phalcon\modules\frontend\controllers;

use Phalcon\Models\Collaborateur;
use Phalcon\Models\Equipe;
use Phalcon\Models\EquipeMembers;
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

    public function equipeAction()
    {
        if ($this->request->isPost()) {
            $cdp = $this->request->getPost('cdp');
            $libelle = $this->request->getPost('libelle');
            $membres = $this->request->getPost('membre'); // Récupérez les membres sélectionnés sous forme de tableau

            // Créez une nouvelle équipe
            $newEquipe = (new Equipe())
                ->setIdChef($cdp)
                ->setLibelle($libelle);

            $newEquipe->save();
                // L'équipe a été sauvegardée avec succès
                // Maintenant, associez les membres à l'équipe
                foreach ($membres as $membreId) {
                    // Créez une nouvelle relation entre l'équipe et le membre
                    $equipeMembre = new EquipeMembers();
                    $equipeMembre->setIdEquipe($newEquipe->getId()); // Utilisez la méthode appropriée pour obtenir l'ID de l'équipe
                    $equipeMembre->setIdDeveloppeur($membreId);
                    $equipeMembre->save();
                }


                // Redirigez l'utilisateur vers une autre page ou affichez un message de succès
                return $this->response->redirect('/ecf7/equipe');
            } else {
                // Il y a eu une erreur lors de la sauvegarde de l'équipe
                // Affichez les messages d'erreur de validation
                foreach ($newEquipe->getMessages() as $message) {
                    $this->flash->error($message);
                }
            }
        }

}

