<?php

namespace App\Http\Responses;

class VideoPreviewResponse extends BaseResponse implements ArrayConversion
{
    private $videos_url;

    /**
     * @return array
     */
    public function asArray(): array
    {
        return [
            'videos_url' => $this->videos_url,
        ];
    }
}
