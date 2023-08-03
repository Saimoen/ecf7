<?php
declare(strict_types=1);

namespace Phalcon\modules\frontend\controllers;

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
                'id_chef' => $equipe->getIdChef(),
                'cdp' => $equipe->Chefdeprojet->Collaborateur->getNom(),
                'libelle' => $equipe->getLibelle()
            ];
        }
        $cdp = [];
        foreach (Chefdeprojet::find() as $chef) {
            $cdp[] = [
                'id' => $chef->getId(),
                'cdp' => $chef->Collaborateur->getNom()
            ];
        }
        $this->view->setVar('equipe', $equipes);
        $this->view->setVar('cdp', $cdp);
    }

    public function editEquipeAction()
    {
        $equipes = [];
        foreach (Equipe::find() as $equipe) {
            $equipes[] = [
                'id' => $equipe->getId(),
                'id_chef' => $equipe->getIdChef(),
                'cdp' => $equipe->Chefdeprojet->Collaborateur->getNom(),
                'libelle' => $equipe->getLibelle()
            ];
        }
        $cdp = [];
        foreach (Chefdeprojet::find() as $chef) {
            $cdp[] = [
                'id' => $chef->getId(),
               'cdp' => $chef->Collaborateur->getNom()
            ];
        }

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
                $selectedChefId = $equipe->getIdChef();
                $selectedLibelle = $equipe->getLibelle();
                $formEditEquipe = '
        <h3>Modifier l\'équipe sélectionnée :</h3>
        <form action="/ecf7/equipe/saveEquipe" method="post">
        <input type="hidden" name="id" value="' . $idEquipe . '">
            <div class="mb-3">
                <label for="cdp" class="form-label">Chef de projet</label>
                <select class="form-select" name="cdp" aria-label="Default select example">
                    ';
                // Boucle pour afficher les options du select avec les valeurs du tableau $cdp
                foreach ($cdp as $chef) {
                    $selected = ($chef['id'] === $selectedChefId) ? 'selected' : '';
                    $formEditEquipe .= '
                        <option value="' . $chef['id'] . '" ' . $selected . '>' . $chef['cdp'] . '</option>';
                }
                $formEditEquipe .= '
                </select>
            </div>
            <div class="mb-3">
                <label for="libelle" class="form-label">Libellé</label>
                <input type="text" name="libelle" class="form-control" id="libelle" placeholder="--Nom d\'équipe--" value="' . $selectedLibelle . '">
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    ';   } else {
                // L'équipe avec l'ID spécifié n'existe pas
                // Vous pouvez afficher un message d'erreur ou effectuer d'autres actions en cas d'équipe introuvable
                echo 'Équipe introuvable.';
                // Rediriger l'utilisateur vers la liste des équipes ou une autre page
                return $this->response->redirect('chemin/vers/la/liste/des/equipes');
            }
        } else {
            // L'ID de l'équipe n'est pas valide
            // Vous pouvez afficher un message d'erreur ou effectuer d'autres actions en cas d'ID invalide
            echo 'ID d\'équipe invalide.';
            // Rediriger l'utilisateur vers la liste des équipes ou une autre page
            $this->saveEquipeAction();
            return $this->response->redirect('/ecf7/');
        }
        echo $formEditEquipe;
        echo $idEquipe;
    }

    public function saveEquipeAction()
    {
        if ($this->request->isPost()) {
            $idEquipe = $this->request->getPost('id');
            $idChef = $this->request->getPost('cdp');
            $libelle = $this->request->getPost('libelle');

            // Vérifier que l'ID de l'équipe est valide et non vide
            if (!empty($idEquipe) && is_numeric($idEquipe)) {
                // Chercher l'équipe par son ID dans la base de données
                $equipe = Equipe::findFirst([
                    'conditions' => 'id = :id:',
                    'bind' => ['id' => $idEquipe]
                ]);

                // Vérifier si l'équipe existe
                if ($equipe) {
                    // Mettre à jour les propriétés de l'équipe avec les nouvelles valeurs
                    $equipe->setIdChef($idChef);
                    $equipe->setLibelle($libelle);

                    // Sauvegarder les modifications dans la base de données
                    if ($equipe->save()) {
                        // Rediriger l'utilisateur vers une autre page pour afficher un message de succès
                        echo 'L\'équipe a été modifiée avec succès.';
                        return $this->response->redirect('/ecf7/equipe');
                    } else {
                        // Il y a eu une erreur lors de la sauvegarde de l'équipe
                        echo 'Une erreur est survenue lors de la modification de l\'équipe.';
                    }
                } else {
                    // L'équipe avec l'ID spécifié n'existe pas
                    echo 'Équipe introuvable.';
                }
            } else {
                // L'ID de l'équipe n'est pas valide
                echo 'ID d\'équipe invalide.';
            }

            // Rediriger l'utilisateur vers la liste des équipes ou une autre page
            return $this->response->redirect('/ecf7/');
        }
    }



}

