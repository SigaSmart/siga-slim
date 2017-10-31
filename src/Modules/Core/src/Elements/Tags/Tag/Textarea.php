<?php

namespace Makes\Tags\Tag;

/**
 * Description of Textarea
 *
 * @author Claudio Campos
 */
class Textarea extends Tags {

    protected $tagLabel = '<label class="label"><span class="legend">%s</span><textarea name="%s" %s>%s</textarea></label>';
    protected $tag = '<textarea name="%s" %s>%s</textarea>';
    protected $ignores = [
        '1' => 'value_options',
        '2' => 'value_empty'
    ];

    public function __toString() {
        if (isset($this->attrs[2]) && !empty($this->attrs[2])):
            return sprintf($this->tagLabel, $this->attrs[2], $this->attrs[0], $this->optional_attrs, $this->attrs[1]);
        endif;
        return sprintf($this->tag, $this->attrs[0], $this->optional_attrs, $this->attrs[1]);
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
