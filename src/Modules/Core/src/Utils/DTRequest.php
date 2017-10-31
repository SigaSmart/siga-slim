<?php

namespace SIGA\Core\Utils;

use Psr\Http\Message\RequestInterface;

class DTRequest {

    private $colss;

    /**
     * @var RequestInterface
     */
    private $request;
    public $sort;
    public $sortCol;
    public $sortDir;
    public $paginate;
    public $page;
    public $start;
    public $length;
    public $search;
    public $searchTerms;
    public $searchColumns;
    public $columns;
    public $draw;

    public function __construct(RequestInterface $request, $colss) {
        $this->colss = $colss;
        
        $this->request = $request;
        
        $params =  $this->request->getQueryParams();

        $this->sort = !empty($params['columns'][$params['order'][0]['column']]);

        $col = $params['columns'][$params['order'][0]['column']];

        $this->sortCol = (!empty($col['name'])) ? $col['name'] : $col['data'];

        $this->sortDir = ($params['order'][0]['dir'] === 'asc') ? 'asc' : 'desc';

        $this->paginate = (isset($params['start']) && isset($params['length']) && (int) $params['length'] !== -1);

        $this->page = ($this->paginate) ? ($params['start'] / $params['length']) + 1 : 1;

        $this->start = $params['start'];

        $this->length = $params['length'];

        $this->draw = (int) $params['draw'];

        $this->search = !empty($params['search']['value']);

        $this->searchTerms = explode(" ", strtolower($params['search']['value']));

        $this->columns = collect($params['columns'])
                ->map(function ($col) {
            return !empty($col['name']) ? $col['name'] : $col['data'];
        });

        $this->searchColumns = collect($params['columns'])
                ->filter(function($col) {
                    return $col['searchable'] === 'true';
                })
                ->map(function ($col) {
            return !empty($col['name']) ? $col['name'] : $col['data'];
        });
        
    }

    public function data_output($columns, $data) {
        $out = array();

        for ($i = 0, $ien = count($data); $i < $ien; $i++) {
            $row = array();

            for ($j = 0, $jen = count($columns); $j < $jen; $j++) {
                $column = $columns[$j];

                // Is there a formatter?
                if (isset($column['formatter'])) {
                    $row[$column['dt']] = $column['formatter']($data[$i][$column['name']], $data[$i]);
                } else {
                    $row[$column['dt']] = $data[$i][$columns[$j]['name']];
                }
            }

            $out[] = $row;
        }

        return $out;
    }

    public function queryDt($builder, $recordsTotal, $recordsFiltered, $colunas) {

        $i = 0;
        if (!empty($this->searchTerms[0])):
            foreach ($colunas as $coluna) {
                if ($i):
                    $builder->orWhere($coluna, 'like', "%{$this->searchTerms[0]}%");
                else:
                    $builder->where($coluna, 'like', "%{$this->searchTerms[0]}%");
                endif;
                $i++;
            }
            $recordsTotal = $builder->count();
            $recordsFiltered = $builder->count();
        endif;
        $builder->offset($this->start)->limit($this->length);
        if ($this->sortCol):
            if (isset($colunas[$this->sortCol])):
                $builder->orderBy($colunas[$this->sortCol], $this->sortDir);
            endif;

        endif;
        $lists = $builder->get($colunas);
        $data = $this->data_output($this->colss, $lists);
        $output = array(
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => $data
        );
        return $output;
    }

}
