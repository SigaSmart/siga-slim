<?php

namespace SIGA\Core\Elements\Tags\Tag;

/**
 * Description of Tags
 *
 * @author Claudio Campos
 */
abstract class Tags implements TagsInterface {

    /**
     * @var \Makes\Config
     */
    protected $attrs;
    public $optional_attrs;
    public $optional_options;
    protected $attributesClass;
    protected $optionsClass;

    public function __construct($attrs, $options = []) {
        $this->attrs = func_get_args();
        $this->attrs = array_values($this->attrs);
        $this->validate();
    }

    public function attributes($attributes) {
        $this->attributesClass = new \SIGA\Core\Elements\Tags\Attrs();
        $this->attributesClass->setAttr($attributes);
        $this->optional_attrs = (string) $this->attributesClass;
        return $this;
    }

    public function strpos_array($haystack, $needles) {
        if (is_array($needles)) {
            foreach ($needles as $str) {
                if (is_array($str)) {
                    $pos = strpos_array($haystack, $str);
                } else {
                    $pos = strpos($haystack, $str);
                }
                if ($pos !== FALSE) {
                    return $pos;
                }
            }
        } else {
            return strpos($haystack, $needles);
        }
    }

}
