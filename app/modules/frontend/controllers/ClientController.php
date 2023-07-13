<?php
declare(strict_types=1);

namespace Phalcon\modules\frontend\controllers;

use Phalcon\Models\Client;
use Phalcon\Mvc\Controller;

class ClientController extends Controller
{

    public function indexAction($client = null)
    {
        $clients = Client::find();
        $this->view->setVar( 'clients', $clients);
    }

}

