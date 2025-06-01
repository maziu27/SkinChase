<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
{
    return [
        'email' => ['required', 'email', 'max:255'],
        'password' => ['nullable', 'confirmed', 'min:8'],
        'trade_link' => ['nullable', 'url', 'max:255'],
        'profile_picture' => ['nullable', 'image', 'max:2048'],
    ];
}
}
