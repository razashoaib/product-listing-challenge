<?php

namespace App\Http\Transformers;

use App\Http\Responses\CatalogResponse;
use App\Http\Responses\ProductResponse;
use League\Fractal\TransformerAbstract;

class CatalogTransformer extends TransformerAbstract
{
    /**
     * @param CatalogResponse $catalog
     * @return array
     */
    public function transform(CatalogResponse $catalog): array
    {
        $productArray = [];
        foreach ($catalog->_embedded['product'] as $prod) {
            $product = new ProductResponse();
            foreach ($prod as $key => $innerVal) {

                if (property_exists(ProductResponse::class, $key)) {
                    $product->$key = $innerVal;
                }
            }

            $productArray['product'][] = $product->asArray();
        }
        $catalog->_embedded = $productArray;

        return $catalog->asArray();
    }
}
