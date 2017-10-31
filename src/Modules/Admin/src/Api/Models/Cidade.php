<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Admin\Api\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Description of Cidade
 *
 * @author caltj
 */
class Cidade extends Model {

    protected $fillable = [
        'title', 'uf', 'ibge', 'xpais', 'cep'
    ];
    protected $hidden = [];

    public function jQueryDataTable(\Psr\Http\Message\RequestInterface $request) {

        $colss = [
            ['name' => 'title', 'dt' => 0],
            ['name' => 'uf', 'dt' => 1],
            ['name' => 'ibge', 'dt' => 2],
            ['name' => 'xpais', 'dt' => 3],
            ['name' => 'cep', 'dt' => 4],
        ];
        $recordsTotal = $this->query()->count();
        $recordsFiltered = $this->query()->count();
        
        $DT = new \SIGA\Core\Utils\DTRequest($request, $colss);
        $colunas = $this->fillable;
        $builder = $this->query();
        $i = 0;
        if (!empty($DT->searchTerms[0])):
            foreach ($colunas as $coluna) {
                if ($i):
                    $builder->orWhere($coluna, 'like', "%{$DT->searchTerms[0]}%");
                else:
                    $builder->where($coluna, 'like', "%{$DT->searchTerms[0]}%");
                endif;
                $i++;
            }
            $recordsTotal = $builder->count();
            $recordsFiltered = $builder->count();
        endif;
        $builder->offset($DT->start)->limit($DT->length);
        if ($DT->sortCol):
            if (isset($colunas[$DT->sortCol])):
                $builder->orderBy($colunas[$DT->sortCol], $DT->sortDir);
            endif;

        endif;

        $lists = $builder->get($colunas);
        $data = $DT->data_output($colss, $lists);
        $output = array(
            "draw" => $request->getParam('draw'),
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => $data,
            "searchColumns" => $DT->searchColumns,
            "search" => $DT->search,
            "sort" => $DT->sort,
            "searchTerms" => $DT->searchTerms,
            "length" => $DT->length,
            "page" => $DT->page,
            "paginate" => $DT->paginate,
            "sortDir" => $DT->sortDir,
            "sortCol" => $DT->sortCol,
            "columns" => $DT->columns,
            "start" => $DT->start,
        );
        return $output;
    }

}
