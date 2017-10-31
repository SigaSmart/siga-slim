<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Migrations\Commands;

use Phinx\Console\Command\Status;

/**
 * Description of StatusCommand
 *
 * @author caltj
 */
class StatusCommand extends Status{

    protected function configure() {
        parent::configure();
        $this->setName('migration:status');
    }

}
