<?php
declare(strict_types=1);

namespace Phalcon\modules\frontend\controllers;

use Phalcon\Models\Collaborateur;
use Phalcon\Models\Equipe;
use Phalcon\Models\Projet;
use Phalcon\Models\Client;
use Phalcon\Mvc\Controller;


class ClientController extends Controller
{

    public function indexAction()
    {
        $clients = [];
        foreach (Client::find() as $client) {
            $clients[] = [
                'id' => $client->getId(),
                'raison_sociale' => $client->getRaisonSociale(),
                'ridet' => $client->getRidet(),
                'ss2i' => $client->getSs2i(),
            ];
        }
        $this->view->setVar('client', $clients);
    }

}

