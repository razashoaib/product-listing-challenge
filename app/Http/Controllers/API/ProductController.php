<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductsRequest;
use App\Http\Responses\CatalogResponse;
use App\Http\Responses\VideoPreviewResponse;
use App\Http\Services\HttpClientService;
use App\Http\Transformers\CatalogTransformer;
use App\Http\Transformers\VideoPreviewTransformer;
use App\Http\Utilities\Helpers;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    private $httpClientService;
    private $catalogResponse;
    private $videoPreviewResponse;

    public function __construct(CatalogResponse $catalogResponse,
                                HttpClientService $httpClientService,
                                VideoPreviewResponse $videoPreviewResponse)
    {
        $this->catalogResponse = $catalogResponse;
        $this->httpClientService = $httpClientService;
        $this->videoPreviewResponse = $videoPreviewResponse;
    }

    /**
     * Get all catalog products based on query strings
     *
     * @param ProductsRequest $request
     * @return JsonResponse
     */
    protected function getProducts(ProductsRequest $request): JsonResponse
    {
        $params = $request->all();
        $response = $this->httpClientService->makeGetRequest('catalog/products', $params);

        // Sort the products w.r.t video count
        $response = Helpers::sortProductsWrtVideoCount($response);

        foreach ($response as $key => $val) {
            if (property_exists(CatalogResponse::class, $key)) {
                $this->catalogResponse->$key = $val;
            }
        }
        return $this->itemResponse($this->catalogResponse, new CatalogTransformer());
    }

    /**
     * Get Video preview links for products
     *
     * @param $productId
     * @return JsonResponse
     */
    protected function getProductVideoPreview($productId): JsonResponse
    {
        $response = $this->httpClientService->makeGetRequest("catalog/products/$productId/videos");
        foreach ($response['_embedded'] as $key => $val) {
            if (property_exists(VideoPreviewResponse::class, $key)) {
                $this->videoPreviewResponse->$key = $val;
            }
        }
        return $this->itemResponse($this->videoPreviewResponse, new VideoPreviewTransformer());
    }
}
