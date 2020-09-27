<?php

namespace Tests\Unit;

use App\Http\Utilities\Helpers;
use PHPUnit\Framework\TestCase;

class UnitTest extends TestCase
{
    /**
     * Test sorting w.r.t the video count.
     *
     * @return void
     */
    public function testSortingWRTVideoPreviewFunction(): void
    {

        $productArray = json_decode('{"_embedded":{"product":[{"video_count":0,"price":90,"markdown_price":90,"special_price":0,"sku":"AS787AA18GUV","name":"Logo Fleece Sweater"},{"video_count":0,"price":120,"markdown_price":120,"special_price":0,"sku":"CM638AA10YRL","name":"Huntington Tee"},{"video_count":1,"price":40,"markdown_price":40,"special_price":0,"sku":"AS787AA33QMG","name":"The Crew Tee"},{"video_count":1,"price":200,"markdown_price":200,"special_price":0,"sku":"LO854AC01OJE","name":"Quilted Soft Cross-Body Bag"},{"video_count":0,"price":99.95,"markdown_price":99.95,"special_price":0,"sku":"LE893AA32UKH","name":"710 Super Skinny Jeans"}]}}', true);

        $sortedProductArray = Helpers::sortProductsWrtVideoCount($productArray);

        self::assertEquals(0, $productArray['_embedded']['product'][0]['video_count']);
        self::assertEquals('AS787AA18GUV', $productArray['_embedded']['product'][0]['sku']);
        self::assertEquals(0, $productArray['_embedded']['product'][1]['video_count']);
        self::assertEquals('CM638AA10YRL', $productArray['_embedded']['product'][1]['sku']);

        self::assertEquals(1, $sortedProductArray['_embedded']['product'][0]['video_count']);
        self::assertEquals(1, $sortedProductArray['_embedded']['product'][1]['video_count']);
        self::assertEquals(0, $sortedProductArray['_embedded']['product'][2]['video_count']);
        self::assertEquals(0, $sortedProductArray['_embedded']['product'][3]['video_count']);
    }
}
