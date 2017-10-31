<?php

namespace Makes\Tags\Tag;

/**
 * Description of Checkbox
 *
 * @author Claudio Campos
 */
class Radio extends Tags {

    protected $tagLabel = '<label class="radio ct-blue label"><input type="radio" name="%s" %s><i></i>%s</label>';
    protected $tag = ' <input type="radio" name="%s" %s>';
    protected $ignores = [
        '1' => 'value_options',
        '2' => 'value_empty',
        '3' => 'rows',
        '4' => 'coll',
        '5' => 'placeholder',
        '6' => 'readonly'
    ];

    public function __toString() {
        if(isset($this->attrs[1])):
            return sprintf($this->tagLabel, $this->attrs[0], $this->optional_attrs, $this->attrs[1]);
        else:
            return sprintf($this->tag, $this->attrs[0], $this->optional_attrs);
        endif;
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
