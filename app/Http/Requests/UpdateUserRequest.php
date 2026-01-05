<?php

namespace App\Http\Requests;

use App\Enum\Role;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $userId = $this->route('user');
        
        return [
            'name' => 'required|string|max:255',
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($userId)],
            'email' => ['nullable', 'email', 'max:255', Rule::unique('users')->ignore($userId)],
            'password' => 'nullable|string|min:8|confirmed',
            'role' => ['required', Rule::in(Role::toArray())],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Jméno je povinný údaj',
            'username.required' => 'Uživatelské jméno je povinný údaj',
            'username.unique' => 'Uživatelské jméno již existuje',
            'email.email' => 'Email není ve správném formátu',
            'email.unique' => 'Email již existuje',
            'password.min' => 'Heslo musí mít alespoň 8 znaků',
            'password.confirmed' => 'Hesla se neshodují',
            'role.required' => 'Role je povinný údaj',
            'role.in' => 'Neplatná role',
        ];
    }
}

