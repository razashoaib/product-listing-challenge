<?php

namespace App\Http\Utilities;

class Helpers
{
    /**
     * Sort the given product array based on video count (mutable function)
     *
     * @param array $products
     * @return array
     */
    public static function sortProductsWrtVideoCount(array $products): array
    {
        if (isset($products['_embedded']['product'])) {
            usort($products['_embedded']['product'], static function ($a, $b) {
                return $a['video_count'] > $b['video_count'] ? -1 : 1;
            });
        }

        return $products;
    }
}
