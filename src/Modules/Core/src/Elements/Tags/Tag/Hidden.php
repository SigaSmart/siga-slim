<?php

namespace Makes\Tags\Tag;

/**
 * Description of Hidden
 *
 * @author Claudio Campos
 */
class Hidden extends Tags {

    protected $tag = '<input type="hidden" name="%s" %s />';
    protected $ignores=[
        '1'=>'readonly',
        '2'=>'required',
        '3'=>'placeholder',
        '4'=>'title',
    ];
    public function validate() {
        if (!isset($this->attrs[0])):
            throw new \Exception("Attribute name not found");
        endif;

        if (!is_string($this->attrs[0])):
            throw new \Exception("Attribute name must be string");
        endif;
    }

    public function __toString() {
        return sprintf($this->tag, $this->attrs[0], $this->optional_attrs);
    }

    public function getIgnores(){
        return $this->ignores;
    }
}
