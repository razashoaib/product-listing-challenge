<?php

namespace App\Http\Transformers;

use App\Http\Responses\VideoPreviewResponse;
use League\Fractal\TransformerAbstract;

class VideoPreviewTransformer extends TransformerAbstract
{
    /**
     * @param VideoPreviewResponse $videoPreviewResponse
     * @return array
     */
    public function transform(VideoPreviewResponse $videoPreviewResponse): array
    {
        return $videoPreviewResponse->asArray();
    }
}
