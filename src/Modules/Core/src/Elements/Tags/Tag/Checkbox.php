<?php

namespace Makes\Tags\Tag;

/**
 * Description of Checkbox
 *
 * @author Claudio Campos
 */
class Checkbox extends Tags {

    protected $tagLabel = 'input-checkbok-label';
    protected $tag = 'input-checkbok';
    protected $ignores = [
        '1' => 'value_options',
        '2' => 'value_empty',
        '3' => 'rows',
        '4' => 'coll',
        '5' => 'placeholder',
        '6' => 'readonly'
    ];

    public function __toString() {
        return \Makes\Tpl::get($this->tag, [$this->attrs[0], $this->optional_attrs, $this->attrs[1]]);
    }

    public function validate() {
        if (!isset($this->attrs[0])):
            throw new \Exception("Attribute name not found");
        endif;

        if (!is_string($this->attrs[0])):
            throw new \Exception("Attribute name must be string");
        endif;

        if (!isset($this->attrs[1])):
            throw new \Exception("Attribute rotulo not found");
        endif;

        if (!is_string($this->attrs[1])):
            throw new \Exception("Attribute rotulo must be string");
        endif;
    }

    public function getIgnores() {
        return $this->ignores;
    }

}
