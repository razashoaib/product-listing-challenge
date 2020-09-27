<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation for query string parameters
     *
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'gender'    => 'required|string',
            'page'      => 'required|integer',
            'page_size' => 'required|integer',
            'sort'      => 'optional|string'
        ];
    }
}
