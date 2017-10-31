<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Migrations\Commands;

use Phinx\Console\Command\Status;

/**
 * Description of MakeCommand
 *
 * @author caltj
 */
class MakeCommand extends Status{

    protected function configure() {
        parent::configure();
        $this->setName('migration:controller');
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        file_put_contents("test.txt", "gfdgdg");
        $output->write('file_put_contents("test.txt", "gfdgdg")');

    }

}
