<?php

namespace Makes\Tags\Tag;

/**
 * Description of Text
 *
 * @author Claudio Campos
 */
class File extends Tags {

    protected $tagLabel = '<label class="label"><span class="legend">%s</span><input type="file" name="%s" %s></label>';
    protected $tag = '<input type="file" name="%s" %s>';
    protected $ignores = [
        '1' => 'value_options',
        '2' => 'value_empty',
        '3' => 'rows',
        '4' => 'coll',
    ];

    public function __toString() {
        if (isset($this->attrs[1]) && !empty($this->attrs[1])):
            return sprintf($this->tagLabel, $this->attrs[1], $this->attrs[0], $this->optional_attrs);
        endif;
        return sprintf($this->tag, $this->attrs[0], $this->optional_attrs);
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
