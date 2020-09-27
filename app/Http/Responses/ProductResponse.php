<?php

namespace App\Http\Responses;

class ProductResponse extends BaseResponse implements ArrayConversion
{
    // We are just interested in the following fields for now
    private $video_count;
    private $price;
    private $markdown_price;
    private $special_price;
    private $sku;
    private $name;
    private $color_name_brand;
    private $short_description;
    private $color_hex;
    private $_embedded;

    /**
     * @return array
     */
    public function asArray(): array
    {
        return [
            'video_count'       => $this->video_count,
            'price'             => $this->price,
            'markdown_price'    => $this->markdown_price,
            'special_price'     => $this->special_price,
            'sku'               => $this->sku,
            'name'              => $this->name,
            'color_name_brand'  => $this->color_name_brand,
            'short_description' => $this->short_description,
            'color_hex'         => $this->color_hex,
            '_embedded'         => $this->_embedded
        ];
    }
}
