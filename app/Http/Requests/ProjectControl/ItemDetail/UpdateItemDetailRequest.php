<?php

namespace App\Http\Requests\ProjectControl\ItemDetail;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateItemDetailRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'section_id' => [
                'required',
                'integer',
                'exists:sections,id'
            ],
            'category_id' => [
                'required',
                'integer',
                'exists:categories,id'
            ],
            'sub_category_id' => [
                'required',
                'integer',
                'exists:sub_categories,id'
            ],
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'unit' => [
                'nullable',
                'string',
                'max:255',
            ],
            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ]
        ];
    }
}
