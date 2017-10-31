<?php

namespace SIGA\Core\Elements\Tags;

/**
 * Description of Attr
 *
 * @author Claudio Campos
 */
class Attrs implements AttrsInterface {

    private $attrs = [];
    private $singletonAttr = [1=>'checked',2=>'readonly',3=>'required'];
    public function __construct(array $attrs = []) {
        if ($attrs):
            $this->attrs = $attrs;
        endif;
    }

    public function __toString() {
        $result = [];
        foreach ($this->attrs as $key => $value):
            if(array_search($key, $this->singletonAttr)):
                 $result[] =  $value;
                else:
                 $result[] = sprintf('%s="%s"', $key, $value);
            endif;
           
        endforeach;
        
        return ' '. implode(' ', array_filter($result));
    }

    public function setAttr( $attrs) {
        $this->attrs = $attrs;
    }

}
