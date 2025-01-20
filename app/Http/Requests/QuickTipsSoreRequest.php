<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuickTipsSoreRequest extends FormRequest
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
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string',
            'slug' => 'required|string',
            'description' => 'nullable|string',
            'description_type' => 'nullable|string',
            'status' => 'nullable|boolean',
            'is_paid' => 'nullable|boolean',
        ];
    }
}
