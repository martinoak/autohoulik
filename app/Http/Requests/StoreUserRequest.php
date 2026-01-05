<?php

namespace App\Http\Requests;

use App\Enum\Role;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'nullable|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
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
            'password.required' => 'Heslo je povinný údaj',
            'password.min' => 'Heslo musí mít alespoň 8 znaků',
            'password.confirmed' => 'Hesla se neshodují',
            'role.required' => 'Role je povinný údaj',
            'role.in' => 'Neplatná role',
        ];
    }
}

