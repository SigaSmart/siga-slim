<?php

namespace SIGA\Core\Elements\Tags\Tag;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Status
 *
 * @author caltj
 */
class Status extends Tags {

    protected $tag = '<div class="btn-group">
                  <button type="button" class="btn btn-{{8}} btn-flat">{{1}}</button>
                  <button type="button" class="btn btn-{{8}} btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li class="{{2}}"><a href="{{6}}">{{4}} Ativar</a></li>
                    <li class="{{3}}"><a href="{{7}}">{{5}} Desativar</a></li>
                  </ul>
                </div>';

    public function validate() {
        if (!isset($this->attrs[0])):
            throw new \Exception("Attribute href not found");
        endif;
    }

    public function __toString() {
        return sprintf($this->tag, $this->attrs[0], $this->optional_attrs, $this->attrs[1]);
    }

    public function exibe($row,$route) {
        $ativo = $this->attrs[0];
        $this->attrs['{{8}}'] = 'danger';
        $this->attrs['{{1}}'] = 'Desativado';
        $this->attrs['{{2}}'] = 'ativar';
        $this->attrs['{{3}}'] = 'disabled';
        $this->attrs['{{4}}'] = '';
        $this->attrs['{{5}}'] = \SIGA\Core\Elements\Tags\TagsHtml::i('fa fa-check');
        $this->attrs['{{6}}'] = base_url(sprintf("%s/%s/ativar",$route,$row->id));
        $this->attrs['{{7}}'] = '#';
        if ($ativo) {
            $this->attrs['{{8}}'] = 'success';
            $this->attrs['{{1}}'] = 'Ativo';
            $this->attrs['{{2}}'] = 'disabled';
            $this->attrs['{{3}}'] = 'ativar';
            $this->attrs['{{4}}'] = \SIGA\Core\Elements\Tags\TagsHtml::i('fa fa-check');
            $this->attrs['{{5}}'] = '';
            $this->attrs['{{6}}'] = "#";
            $this->attrs['{{7}}'] = base_url(sprintf("%s/%s/desativar",$route,$row->id));
        }
        return str_replace(array_keys($this->attrs), array_values($this->attrs),$this->tag);
    }

}
