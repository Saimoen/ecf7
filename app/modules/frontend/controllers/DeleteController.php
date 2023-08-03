<?php
declare(strict_types=1);

namespace Phalcon\modules\frontend\controllers;

use Phalcon\Models\Chefdeprojet;
use Phalcon\Models\Collaborateur;
use Phalcon\Models\Equipe;
use Phalcon\Mvc\Controller;


class DeleteController extends Controller
{

    public function indexAction()
    {
    }

    public function equipeAction()
    {
        if ($this->request->isGet()) {
            // Récupérer l'ID de l'équipe depuis le paramètre de requête dans l'URL
            $idEquipe = $this->request->getQuery('id');

            // Vérifier si l'ID est valide et non vide
            if (!empty($idEquipe) && is_numeric($idEquipe)) {
                // Chercher l'équipe par son ID dans la base de données
                $equipe = Equipe::findFirst([
                    'conditions' => 'id = :id:',
                    'bind' => ['id' => $idEquipe]
                ]);

                // Vérifier si l'équipe existe
                if ($equipe) {
                    // Supprimer l'equipe de la base de données
                    if ($equipe->delete()) {
                        // L'equipe a été supprimée avec succès
                        $this->response->redirect('/ecf7/');
                        echo 'Equipe supprimée';
                    } else {
                        // Il y a eu une erreur lors de la suppression de l'équipe
                        $this->response->redirect('/ecf7/');
                        echo 'Erreur lors de la suppression de la suppression du collaborateur';
                    }
                } else {
                    // L'équipe avec l'ID spécifié n'existe pas
                    $this->response->redirect('/ecf7/');
                    echo 'Le collaborateur avec ID spécifié existe pas';
                }
            } else {
                // L'ID de l'équipe n'est pas valide
                $this->response->redirect('/ecf7/');
            }

            // Rediriger l'utilisateur vers la liste des équipes
            return $this->response->redirect('/ecf7/equipe');
        }
    }

    public function chefdeprojetAction()
    {
        if ($this->request->isGet()) {
            // Récupérer l'ID du collaborateur depuis le paramètre de requête dans l'URL
            $idCollaborateur = $this->request->getQuery('id');

            // Vérifier si l'ID est valide et non vide
            if (!empty($idCollaborateur) && is_numeric($idCollaborateur)) {
                // Chercher le collaborateur par son ID dans la base de données
                $collaborateur = Chefdeprojet::findFirst([
                    'conditions' => 'id = :id:',
                    'bind' => ['id' => $idCollaborateur]
                ]);

                // Vérifier si le collaborateur existe
                if ($collaborateur) {
                    var_dump($collaborateur);
                    // Supprimer le collaborateur de la base de données
                    if ($collaborateur->delete()) {
                        // Le collaborateur a été supprimé avec succès
                        $this->response->redirect('/ecf7/');
                        echo 'Equipe supprimée';
                    } else {
                        // Il y a eu une erreur lors de la suppression du collaborateur
                        $this->response->redirect('/ecf7/');
                        echo 'Erreur lors de la suppression de la suppression du collaborateur';
                    }
                } else {
                    // Le collaborateur avec l'ID spécifié n'existe pas
                    $this->response->redirect('/ecf7/');
                    echo 'Le collaborateur avec ID spécifié existe pas';
                }
            } else {
                // L'ID du collaborateur n'est pas valide
                $this->response->redirect('/ecf7/');
            }

            // Rediriger l'utilisateur vers la liste des collaborateurs ou une autre page
            return $this->response->redirect('/ecf7/');
        }
    }

}

