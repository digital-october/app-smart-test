<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class IndexProductsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'search_terms' => ['string', 'nullable'],
            'page_size' => ['int', 'between:5,50', 'nullable'],
            'page' => ['int', 'min:1', 'nullable'],
        ];
    }
}
