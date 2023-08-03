<?php
declare(strict_types=1);

namespace Phalcon\modules\frontend\controllers;

use Phalcon\Models\Chefdeprojet;
use Phalcon\Mvc\Controller;

class ChefdeprojetController extends Controller
{

    public function indexAction()
    {
        $cdp = [];
        foreach (Chefdeprojet::find() as $chef) {
            $cdp[] = [
                'id' => $chef->getId(),
                'nomCollabo' => $chef->Collaborateur->getNom(),
                'boost' => $chef->getBoostProduction(),
            ];
        }
        $this->view->setVar('cdp', $cdp);
    }

    public function createAction() {
        echo 'Test !';
    }

}

