<?php

namespace SIGA\Core\Elements\Tags\Tag;

/**
 * Description of A
 *
 * @author Claudio Campos
 */
class Edit extends Tags {

    protected $tag = '<a  href="%s" %s>%s</a>';

    public function validate() {
        if (!isset($this->attrs[0])):
            throw new \Exception("Attribute href not found");
        endif;

        if (!is_string($this->attrs[0])):
            throw new \Exception("Attribute href must be string");
        endif;

        if (!isset($this->attrs[1])):
            throw new \Exception("Attribute anchor not found");
        endif;

        if (!is_string($this->attrs[1])):
            throw new \Exception("Attribute anchor must be string");
        endif;
    }

    public function __toString() {
        return sprintf($this->tag, $this->attrs[0], $this->optional_attrs, $this->attrs[1]);
    }

    public function exibe() {
        return sprintf($this->tag, $this->attrs[0], $this->optional_attrs, $this->attrs[1]);
    }

}
