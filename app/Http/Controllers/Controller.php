<?php

namespace App\Http\Controllers;

use App\Http\Responses\BaseResponse;
use App\Http\Serializers\PlainArraySerializer;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $fractalManager;

    /**
     * Get Fractal Manager.
     *
     * @return Manager
     */
    private function getFractalManager(): Manager
    {
        if (!isset($this->fractalManager)) {
            $this->fractalManager = new Manager();
            $this->fractalManager->setSerializer(new PlainArraySerializer());
        }

        return $this->fractalManager;
    }

    /**
     * Single item response.
     *
     * @param BaseResponse $model
     * @param TransformerAbstract $transformer
     * @return JsonResponse
     */
    protected function itemResponse(BaseResponse $model, TransformerAbstract $transformer): JsonResponse
    {
        $resource = new Item($model, $transformer);

        return response()->json($this->getFractalManager()->createData($resource)->toArray());
    }
}
