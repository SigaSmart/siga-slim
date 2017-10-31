<?php

namespace Makes\Tags\Tag;

/**
 * Description of Number
 *
 * @author Claudio Campos
 */
class Number extends Tags {

    protected $tagLabel = '<input type="number" name="%s" %s>';
    protected $tag = '<input type="number" name="%s" %s>';
    protected $ignores = [
        '1' => 'value_options',
        '2' => 'value_empty',
        '3' => 'rows',
        '4' => 'coll',
    ];

    public function __toString() {
        return \Makes\Tpl::get($this->tag, [$this->attrs[0], $this->optional_attrs]);
    }

    public function validate() {
        if (!isset($this->attrs[0])):
            throw new \Exception("Attribute name not found");
        endif;

        if (!is_string($this->attrs[0])):
            throw new \Exception("Attribute name must be string");
        endif;
    }

    public function getIgnores() {
        return $this->ignores;
    }

}
