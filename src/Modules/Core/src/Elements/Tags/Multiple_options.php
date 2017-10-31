<?php

namespace SIGA\Core\Elements\Tags;

/**
 * Description of Multiple_options
 *
 * @author Claudio Campos
 */
class Multiple_options implements OptionsInterface {

    private $options = [];
    private $resultOption = [];
    private $result = [];
    private $value;

    public function __construct(array $options = []) {
        if ($options) {
            $this->options = $options;
        }
    }

    public function __toString() {
        if (isset($this->options['value_options']) || isset($this->options['options_group'])):
            if (isset($this->options['value_empty'])):
                $this->resultOption[] = sprintf('<option selected value="">%s</option>', $this->options['value_empty']);
            endif;
            if (isset($this->options['options_group'])):
                return $this->options_group($this->options['options_group']);
            else:
                return $this->value_options($this->options['value_options']);
            endif;

        endif;
        return ' ' . implode(' ', $this->result);
    }

    public function setOptions( $options,  $values = []) {
        if (isset($values[1])):
            $i = 1;
            foreach (explode(",", $values[1]) as $value):
                $this->value[$i++] = $value;
            endforeach;

        endif;
        $this->options = $options;
    }

    private function options_group( $groups) {
        foreach ($groups as $keyop => $group):
            if (is_array($group)):
                $this->result[] = sprintf('<optgroup label="%s">%s</optgroup>', $keyop, $this->value_options($group['value_options']));
                $this->resultOption = [];
            endif;
        endforeach;

        return implode(PHP_EOL, $this->result);
    }

    private function value_options( $options) {

        if ($options):
            foreach ($options as $key => $value):
                if (array_search($key, $this->value)):
                    $this->resultOption[] = sprintf('<option selected value="%s">%s</option>', $key, $value);
                else:

                    $this->resultOption[] = sprintf('<option value="%s">%s </option>', $key, $value);
                endif;
            endforeach;
        endif;
        return implode(PHP_EOL, $this->resultOption);
    }

}
