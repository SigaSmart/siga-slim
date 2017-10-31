<?php

namespace SIGA\Core\Elements\Tags\Tag;

/**
 * Description of A
 *
 * @author Claudio Campos
 */
class I extends Tags {

    protected $tag = '<i class="%s"></i>';

    public function validate() {
        if (!isset($this->attrs[0])):
            throw new \Exception("Attribute href not found");
        endif;

        if (!is_string($this->attrs[0])):
            throw new \Exception("Attribute href must be string");
        endif;

    }

    public function __toString() {
        return sprintf($this->tag, $this->attrs[0]);
    }

    public function exibe() {
        return sprintf($this->tag, $this->attrs[0]);
    }

}
