<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Core\Utils;

/**
 * Description of Alert
 *
 * @author caltj
 */
class Alert {

    private $c;

    public function __construct($c) {

        $this->c = $c;
    }

    public function msg($default = "") {
        $msg = $this->c->flash;
        if ($msg->getMessages()):
            if (isset($msg->getMessages()['success'])):
                return array_pop($msg->getMessages()['success']);
            endif;
            if (isset($msg->getMessages()['warning'])):
                return array_pop($msg->getMessages()['warning']);
            endif;
            if (isset($msg->getMessages()['info'])):
                return array_pop($msg->getMessages()['info']);
            endif;
            if (isset($msg->getMessages()['error'])):
                return array_pop($msg->getMessages()['error']);
            endif;
        endif;
        return $default;
    }

    public function alerts() {
        $msg = $this->c->flash;
        if ($msg->getMessages()):
            if (isset($msg->getMessages()['success'])):
                $html = '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                %s
              </div>';
                return sprintf($html, array_pop($msg->getMessages()['success']));
            endif;
            if (isset($msg->getMessages()['warning'])):
                $html = '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                %s
              </div>';
                return sprintf($html, array_pop($msg->getMessages()['warning']));
            endif;
            if (isset($msg->getMessages()['info'])):
                $html = '<div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-info"></i> Alert!</h4>
                %s
              </div>';
                return sprintf($html, array_pop($msg->getMessages()['info']));
            endif;
            if (isset($msg->getMessages()['error'])):
                $html = '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                %s
              </div>';
                return sprintf($html, array_pop($msg->getMessages()['error']));
            endif;
        endif;
    }

}
