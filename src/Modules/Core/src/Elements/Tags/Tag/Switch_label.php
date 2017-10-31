<?php

namespace Makes\Tags\Tag;

/**
 * Description of Switch_label
 *
 * @author Claudio Campos
 */
class Switch_label extends Tags {

    protected $tag = '<label class="switch" data-on-label="%s"  data-off-label="%s"> <input type="checkbox" name="%s" %s/></label>';
    protected $ignores = [
        '1' => 'value_options',
        '2' => 'value_empty',
        '3' => 'rows',
        '4' => 'coll',
        '5' => 'placeholder',
        '6' => 'readonly'
    ];

    public function __toString() {
          return sprintf($this->tag, $this->attrs[0],$this->attrs[1],$this->attrs[2], $this->optional_attrs);
    }

    public function validate() {
        if (!isset($this->attrs[0])):
            throw new \Exception("Attribute data label on not found");
        endif;

        if (!is_string($this->attrs[0])):
            throw new \Exception("Attribute data label on must be string");
        endif;

        if (!isset($this->attrs[1])):
            throw new \Exception("Attribute data label off not found");
        endif;

        if (!is_string($this->attrs[1])):
            throw new \Exception("Attribute data label off must be string");
        endif;
        if (!isset($this->attrs[2])):
            throw new \Exception("Attribute name not found");
        endif;

        if (!is_string($this->attrs[2])):
            throw new \Exception("Attribute name must be string");
        endif;
    }

    public function getIgnores() {
        return $this->ignores;
    }

}
