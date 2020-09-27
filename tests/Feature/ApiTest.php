<?php

namespace Tests\Feature;

use App\Http\Responses\CatalogResponse;
use App\Http\Responses\VideoPreviewResponse;
use Tests\TestCase;

class ApiTest extends TestCase
{
    /**
     * Catalog Products Api
     *
     * @return void
     */
    public function testCatalogProductsApi(): void
    {
        $response = $this->get('/api/products?page=1&page_size=10&gender=male');

        $response->assertJsonStructure(array_keys(app(CatalogResponse::class)->asArray()));
        $response->assertStatus(200);
    }

    /**
     * Video Url Api for product
     *
     * @return void
     */
    public function testVideoPreviewApi(): void
    {
        $response = $this->get('/api/products/NU695AA89XMC/videos');

        $response->assertJsonStructure(array_keys(app(VideoPreviewResponse::class)->asArray()));
        $response->assertStatus(200);
    }
}
