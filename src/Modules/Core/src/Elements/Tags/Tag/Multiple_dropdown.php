<?php

namespace Makes\Tags\Tag;

/**
 * Description of Multiple_dropdown
 *
 * @author Claudio Campos
 */
class Multiple_dropdown extends Tags {

//<label class="label"><span class="legend">%s</span><select name="%s" %s>%s</select></label>
    protected $tagLabel = '<label class="label"><span class="legend">%s</span><select multiple="multiple" name="%s[]" %s>%s</select></label>';
    protected $tag = '<select name="%s[]" %s>%s</select>';
    protected $ignores = [
        '1' => 'readonly',
        '2' => 'value',
        '3' => 'rows',
        '4' => 'coll'
    ];

    public function __toString() {
        if (isset($this->attrs[2]) && !empty($this->attrs[2])):
            return sprintf($this->tagLabel, $this->attrs[2], $this->attrs[0], $this->optional_attrs, $this->optional_options);
        endif;
        return sprintf($this->tag, $this->attrs[0], $this->optional_attrs, $this->optional_options);
    }

    public function validate() {
        if (!isset($this->attrs[0])):
            throw new \Exception("Attribute name not found");
        endif;

        if (!is_string($this->attrs[0])):
            throw new \Exception("Attribute name must be string");
        endif;
    }

    public function multiple_options( $options) {
        $this->optionsClass=new \Makes\Tags\Multiple_options();
        $this->optionsClass->setOptions($options, $this->attrs);
        $this->optional_options = (string) $this->optionsClass;
        return $this;
    }

    public function getIgnores() {
        return $this->ignores;
    }

}
