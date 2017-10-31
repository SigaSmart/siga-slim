<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Core\Elements\Tags;

/**
 *
 * @author caltj
 */
interface OptionsInterface {

    public function __toString();

    public function setOptions( $options,  $attrs);
}
