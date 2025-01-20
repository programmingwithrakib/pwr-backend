<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseTopicResourceUpdateRequest extends FormRequest
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
            'course_topic_id' => 'required|exists:course_topics,id',
            'title' => 'required',
            'show_in' => 'nullable|string',
            'info' => 'required',
            'info_type' => 'nullable|string',
            'is_paid' => 'nullable|boolean'
        ];
    }
}
