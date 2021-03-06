<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Clients\Api\V1\Models;

use Illuminate\Database\Eloquent\Model;
use SIGA\Core\Elements\Tags\TagsHtml;
use Psr\Http\Message\RequestInterface;

/**
 * Description of Client
 *
 * @author caltj
 */
class Client extends Model {

    protected $fillable = [
        'id', 'empresa', 'first_name', 'last_name', 'cover', 'status'
    ];

    public function jQueryDataTable(RequestInterface $request) {
        $colss = [
            ['name' => 'first_name', 'dt' => 0],
            ['name' => 'status', 'dt' => 1,
                'formatter' => function( $d, $row ) {
                    return TagsHtml::status($d)->exibe($row, 'admin/clients');
                }],
            ['name' => 'id', 'dt' => 2,
                'formatter' => function( $d ) {
                    $I_Edit = TagsHtml::i('fa fa-pencil')->exibe();
                    $I_Delete = TagsHtml::i('fa fa-trash')->exibe();
                    $Btns[] = TagsHtml::a(base_url(sprintf("admin/clients/%s/edit", $d)), $I_Edit)->attributes(
                                    [
                                        'class' => 'btn btn-primary btn-flat btn-sm'
                            ])->exibe();
                    $Btns[] = TagsHtml::a(base_url(sprintf("admin/clients/%s/delete", $d)), $I_Delete)->attributes(
                                    [
                                        'class' => 'btn btn-danger btn-flat btn-sm dt_delete_action'
                            ])->exibe();
                    return implode('', $Btns);
                }]
        ];

        $recordsTotal = $this->query()->count();
        $recordsFiltered = $this->query()->count();

        $builder = $this->query();
        $colunas = $this->fillable;
        $DT = new \SIGA\Core\Utils\DTRequest($request, $colss);
        $output = $DT->queryDt($builder, $recordsTotal, $recordsFiltered, $colunas);
        $output["draw"] = $request->getParam('draw');
        return $output;
    }

}
