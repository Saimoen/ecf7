<?php
declare(strict_types=1);

namespace Phalcon\Modules\Frontend\Controllers;

use Phalcon\Models\Projet;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $projets = Projet::find();
        $this->view->setVar( 'projets', $projets);
    }

}

