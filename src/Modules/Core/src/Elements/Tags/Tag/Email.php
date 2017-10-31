<?php

namespace SIGA\Tags\Tag;

/**
 * Description of Email
 *
 * @author Claudio Campos
 */
class Email extends Tags {

    protected $tagLabel = '%s<input type="text" name="%s" %s>';
    protected $tag = '<input type="text" name="%s" %s>';
    protected $ignores = [
        '1' => 'value_options',
        '2' => 'value_empty',
        '3' => 'rows',
        '4' => 'coll',
    ];

    public function __toString() {
        if (isset($this->attrs[3])):
            return sprintf($this->tagLabel, $this->attrs[3], $this->attrs[1], $this->optional_attrs);
        endif;
        return sprintf($this->tag, $this->attrs[1], $this->optional_attrs);
    }

    public function validate() {
        if (!isset($this->attrs[1])):
            throw new \Exception("Attribute name not found");
        endif;

        if (!is_string($this->attrs[1])):
            throw new \Exception("Attribute name must be string");
        endif;
    }

    public function getIgnores() {
        return $this->ignores;
    }

}
