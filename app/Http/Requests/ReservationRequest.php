<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
            'customer_id' => 'required',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after_or_equal:check_in_date',
            'number_of_days' => 'required|integer|min:1',
            'number_of_adults' => 'required|integer|min:1',
            'number_of_children' => 'required|integer|min:0',
            'description' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:50',
        ];
    }
}
