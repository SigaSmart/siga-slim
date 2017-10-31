<?php

namespace SIGA\Tags\Tag;

/**
 * Description of Label
 *
 * @author Claudio Campos
 */
class Label extends Tags {

    private $tag = '<label %s>%s</label>';
    protected $ignores = [];

    public function __toString()  {
        return sprintf($this->tag, $this->optional_attrs, $this->attrs[1]);
    }

    public function validate() {
        if (!isset($this->attrs[1])):
            throw new \Exception("Value not found");
        endif;

        if (!is_string($this->attrs[1])):
            throw new \Exception("Value must be string");
        endif;
    }

    public function getIgnores() {
        return $this->ignores;
    }

}
