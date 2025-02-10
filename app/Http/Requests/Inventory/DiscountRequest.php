<?php

namespace App\Http\Requests\Inventory;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DiscountRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'required|max:255|unique:discounts,name',
            'type' => 'required|in:perc,fixed',
            'value' => [
                'required',
                'numeric',
                'min:1',
                Rule::when($this->type === 'perc', 'between:1,99'),
            ],
            'max_value' => 'nullable|numeric|min:1|prohibited_if:type,fixed',
            'start_date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    if (Carbon::parse($value)->lt(today())) {
                        $fail('The start date must not be before today.');
                    }
                },
            ],
            'end_date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    if (strtotime($value) <= strtotime($this->start_date)) {
                        $fail('The end date must be after the start date.');
                    }
                }
            ],
        ];
    }

    public function messages()
    {
        return [
            'start_date.required' => 'The start date is required.',
            'start_date.date' => 'The start date must be a valid date.',
            'end_date.required' => 'The end date is required.',
            'end_date.date' => 'The end date must be a valid date.',
        ];
    }
}
