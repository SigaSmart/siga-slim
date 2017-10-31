<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Core\Utils;

/**
 * Description of Util
 *
 * @author caltj
 */
class Util {

    private $c;

    public function __construct($c) {
        
        $this->c = $c;
    }

    public function form_read($post) {
        //$res=str_replace ( ",", "", $post );
        return @number_format($post, 2, ",", ".");
    }

    public function form_w($post) {
        $source = array('.', ',');
        $replace = array('', '.');
        $valor = str_replace($source, $replace, $post); //remove os pontos e substitui a virgula pelo ponto
        return $valor; //retorna o valor formatado para gravar no banco
    }

    public function Calcular($v1, $v2, $op) {
        $v1 = str_replace(".", "", $v1);
        $v1 = str_replace(",", ".", $v1);
        $v2 = str_replace(".", "", $v2);
        $v2 = str_replace(",", ".", $v2);
        switch ($op) {
            case "+":
                $r = $v1 + $v2;
                break;
            case "-":
                $r = $v1 - $v2;
                break;
            case "*":
                $r = $v1 * $v2;
                break;
            case "%":
                $bs = $v1 / 100;
                $j = $v2 * $bs;
                $r = $v1 + $j;
                break;
            case "/":
                @$r = @$v1 / $v2;
                break;
            case "tj":
                $bs = $v1 / 100;
                $j = $v2 * $bs;
                $r = $j;
                break;
            default :
                $r = $v1;
                break;
        }
        $ret = @number_format($r, 2, ",", ".");
        return $ret;
    }

    public function margem_lucro($post) {
        $c = $this->form_valor(array('capital' => $post['custo'], 'calculo' => "100", 'operacao' => "/")); // valor($v1, 100, "/");
        $df = $this->form_valor(array('capital' => $post['venda'], 'calculo' => $post['custo'], 'operacao' => "-")); //valor($v2, $v1, "-");
        return $this->form_valor(array('capital' => $df, 'calculo' => $c, 'operacao' => "/")); ///($df, $c, "/");
    }

}
