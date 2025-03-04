<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\PostStatus;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check(); // Pastikan hanya user yang login yang bisa mengakses request ini
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:60',
            'content' => 'required',
            'scheduled_at' => 'nullable|date',
            'published_at' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => ['required', Rule::in([PostStatus::Draft->value, PostStatus::Scheduled->value, PostStatus::Published->value])],
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages()
    {
        return [
            'title.required' => 'The title is required.',
            'title.max' => 'The title must not exceed 60 characters.',
            'content.required' => 'The content is required.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image format must be jpeg, png, jpg, or gif.',
            'status.required' => 'The status is required.',
            'status.in' => 'The selected status is invalid.',
        ];
    }
}
