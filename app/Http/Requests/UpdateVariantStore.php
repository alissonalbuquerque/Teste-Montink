<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateVariantStore extends FormRequest
{
   /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_id'  => ['required', 'integer'],
            'price'       => ['required', 'numeric'],
            'size'        => ['required', 'string', Rule::in(['P', 'M', 'G', 'GG'])],
            'color'       => ['required', 'string', Rule::in(['red', 'green', 'blue'])],
            'quantity'    => ['required', 'integer', 'min:1'],
        ];
    }
}