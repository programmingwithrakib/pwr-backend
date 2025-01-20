<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseTopicUpdateRequest extends FormRequest
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
            'name' => 'required|string',
            'slug' => 'required|string',
            'time_duration' => 'nullable|string',
            'description' => 'nullable',
            'description_type' => 'nullable|string',
            'video_link' => 'nullable|string',
            'video_type' => 'nullable|string',
            'play_as' => 'nullable|string',
            'is_paid' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ];
    }
}
