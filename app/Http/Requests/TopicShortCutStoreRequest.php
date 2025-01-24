<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TopicShortCutStoreRequest extends FormRequest
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
            'course_id' => 'nullable|exists:courses,id',
            'course_topic_id' => 'nullable|exists:course_topics,id',
            'description' => 'required',
            'description_type' => 'nullable|string',
            'status' => 'nullable|boolean',
            'title' => 'required|string',
            'slug' => 'required|string'
        ];
    }
}
