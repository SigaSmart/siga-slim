<?php

namespace SIGA\Core\Elements\Tags;

/**
 * Description of TagsHtml
 *
 * @author Claudio Campos
 */
class TagsHtml {

  
    public function __call( $name,  $arguments) {
        return $this->createTags($name, $arguments);
    }

    public static function __callStatic( $name,  $arguments) {
        return self::createTags($name, $arguments);
    }

    protected static function createTags( $name,  $arguments) {
        $class = sprintf("SIGA\Core\Elements\Tags\Tag\%s", ucfirst($name));

        $reflection = new \ReflectionClass($class);

        return $reflection->newInstanceArgs($arguments);
    }

}
