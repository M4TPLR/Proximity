<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'title' => 'required|alpha_num|max:255',
            'description' => 'required|string',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'imgurl' => 'image'
        ];
        //add required to imgurl
    }
}
