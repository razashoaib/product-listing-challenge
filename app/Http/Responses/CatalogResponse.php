<?php

namespace App\Http\Responses;

class CatalogResponse extends BaseResponse implements ArrayConversion
{
    private $_links;
    private $_embedded;
    private $page_count;
    private $page_size;
    private $total_items;
    private $page;


    /**
     * @return array
     */
    public function asArray(): array
    {
        return [
            '_links'      => $this->_links,
            '_embedded'   => $this->_embedded,
            'page_count'  => $this->page_count,
            'page_size'   => $this->page_size,
            'total_items' => $this->total_items,
            'page'        => $this->page,
        ];
    }
}
