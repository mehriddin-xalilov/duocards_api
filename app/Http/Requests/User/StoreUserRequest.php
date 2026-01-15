<?php

namespace App\Http\Requests\User;

use App\Helpers\Roles;
use App\Http\Requests\BaseRequest;

class StoreUserRequest extends BaseRequest
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
            'name' => 'required|string',
            'email_verified_at' => 'nullable|date',
            'password' => 'required|string|min:6',
            'email' => 'nullable|string|email|unique:users,email',
            'login' => 'required|string|unique:users,login',
            'phone' => 'nullable|string|unique:users,phone',
            'status' => 'nullable|integer|in:0,1',
            'remember_token' => 'nullable|string',
            'photo' => 'nullable|integer|exists:files,id',
            'role' => 'required|string|exists:roles,name',
        ];
    }
}
