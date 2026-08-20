<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProjectControlPlanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'project_id' => 'required|exists:projects,id',
            'section' => 'required|string|between:1,255',
            'category' => 'nullable|string|between:1,255',
            'sub_category' => 'nullable|string|between:1,255',
            'item_detail' => 'required|string|between:1,255',
            'unit' => 'required|string|between:1,255',
            'unit_price' => 'required|numeric',
        ];
    }
}
