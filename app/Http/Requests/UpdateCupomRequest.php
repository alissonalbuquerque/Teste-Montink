<?php

namespace App\Http\Requests;

use App\Rules\AfterOrEqualDateValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCupomRequest extends FormRequest
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
            'code'          => ['required', 'string', 'min:1', 'max:255'],
            'start_date'    => ['required', 'date'],
            'end_date'      => ['required', 'date', AfterOrEqualDateValidation::create($this->start_date)],
            'minimal_value' => ['required', 'numeric'],
            'percentage'    => ['required', 'integer', 'between:1,100'],
            'active'        => ['required', 'boolean', Rule::in([0,1])],
        ];
    }
}
