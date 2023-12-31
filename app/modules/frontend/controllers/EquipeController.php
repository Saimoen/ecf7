<?php
declare(strict_types=1);

namespace Phalcon\modules\frontend\controllers;

use Phalcon\Models\Developpeur;
use Phalcon\Models\Equipe;
use Phalcon\Models\Chefdeprojet;
use Phalcon\Models\EquipeMembers;
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
                'cdp' => ($equipe->Chefdeprojet && $equipe->Chefdeprojet->Collaborateur) ? $equipe->Chefdeprojet->Collaborateur->getNom() : '',
                'libelle' => $equipe->getLibelle()
            ];
        }
        $membres = [];
        foreach (Developpeur::find() as $membre) {
            if ($membre) {
                $membres[] = [
                    'id' => $membre->getId(),
                    'developpeur' => $membre->Collaborateur->getNom(),
                ];
            }
        }
        $cdp = [];
        foreach (Chefdeprojet::find() as $chef) {
            $cdp[] = [
                'id' => $chef->getId(),
                'cdp' => $chef->Collaborateur->getNom()
            ];
        }
        $this->view->setVar('equipe', $equipes);
        $this->view->setVar('membre', $membres);
        $this->view->setVar('cdp', $cdp);
    }

    public function editEquipeAction()
    {
        $cdp = [];
        foreach (Chefdeprojet::find() as $chef) {
            $cdp[] = [
                'id' => $chef->getId(),
                'cdp' => $chef->Collaborateur->getNom()
            ];
        }

        $idEquipe = $this->request->getQuery('id');

        $equipeMembres = EquipeMembers::find([
            'conditions' => 'id_equipe = :id_equipe:',
            'bind' => ['id_equipe' => $idEquipe]
        ]);

        $selectedMembres = [];
        foreach ($equipeMembres as $equipeMembre) {
            $selectedMembres[] = $equipeMembre->getIdDeveloppeur();
        }

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
        <div class="mb-3">
            <label for="membres" class="form-label">Membres de l\'équipe</label>
            <input type="checkbox" name="membres[]" class="form-select">
                ';
                // Boucle pour afficher les options du select avec les valeurs du tableau $selectedMembres
                foreach ($selectedMembres as $membreId) {
                    $selected = (in_array($membreId, $selectedMembres)) ? 'selected' : '';
                    // Vous devez récupérer les données du membre depuis la base de données
                    // et afficher son nom et prénom ici.
                    $membre = Developpeur::findFirst([
                        'conditions' => 'id = :id:',
                        'bind' => ['id' => $membreId]
                    ]);
                    if ($membre) {
                        $formEditEquipe .= '
                        <option value="' . $membre->Collaborateur->getId() . '" ' . $selected . '>' . $membre->Collaborateur->getNom() . ' ' . $membre->Collaborateur->getPrenom() . '</option>';
                    }
                }
                $formEditEquipe .= '
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
    ';
            } else {
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
            $membres = $this->request->getPost('membres');

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

    public function showAction()
    {
        // Get the team ID from the URL query parameter
        $idEquipe = $this->request->getQuery('id');

        // Check if the ID is valid and non-empty
        if (!empty($idEquipe) && is_numeric($idEquipe)) {
            // Find the team by its ID in the database
            $equipe = Equipe::findFirst([
                'conditions' => 'id = :id:',
                'bind' => ['id' => $idEquipe]
            ]);

            // Check if the team exists
            if ($equipe) {
                // Retrieve the list of team members associated with this team
                $membres = EquipeMembers::find([
                    'conditions' => 'id_equipe = :id_equipe:',
                    'bind' => ['id_equipe' => $idEquipe]
                ]);

                // Display the team details
                $detailEquipe = '<h3>Détails de l\'équipe : ' . $equipe->getLibelle() . '</h3>';
                $detailEquipe .= '<table class="table table-striped"><tbody>';
                $detailEquipe .= '<tr><th scope="row">Libelle</th><td>' . $equipe->getLibelle() . '</td></tr>';
                $detailEquipe .= '<tr><th scope="row">Chef de projet</th><td>' . $equipe->Chefdeprojet->Collaborateur->getNom() . '</td></tr>';
                $detailEquipe .= '<tr><th scope="row">Membres de l\'équipe</th><td>';


                // Loop through the members and display their names
                foreach ($membres as $membre) {
                    $detailEquipe .= $membre->Developpeur->Collaborateur->getNom() . '<br>';
                }

                $detailEquipe .= '</td></tr></tbody></table>';

                // Echo the team details
                echo $detailEquipe;
            } else {
                // Team with the specified ID does not exist
                $this->flash->error('L\'équipe avec cet ID n\'existe pas.');
            }
        } else {
            // Invalid or empty team ID
            $this->flash->error('ID d\'équipe invalide.');
        }

        // Redirect the user to the list of teams or another page
        // ...
    }








}

