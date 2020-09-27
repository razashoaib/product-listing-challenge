<?php

namespace App\Http\Serializers;

use League\Fractal\Serializer\ArraySerializer;

class PlainArraySerializer extends ArraySerializer
{
    /**
     * Serialize a collection.
     *
     * @param string $resourceKey
     * @param array $data
     *
     * @return array
     */
    public function collection($resourceKey, array $data): array
    {
        return $data;
    }
}
