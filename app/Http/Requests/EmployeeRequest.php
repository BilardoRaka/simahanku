<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class EmployeeRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'password' => [
                'max:15',
                Password::min(6)->mixedCase()->numbers()->symbols()
            ],
            'name' => 'max:30',
            'job_position' => 'max:30',
            'address' => 'string',
            'phone' => 'max:20',
            'logo' => 'image|file|max:1024',
            'role' => 'string'
        ];
        if($this->isMethod('POST')){
            $rules['email'] = ['max:50', 'email', Rule::unique('users')];
        } elseif ($this->isMethod('PUT')) {
            $rules['email'] = ['max:50', 'email', Rule::unique('users')->ignore($this->oldEmail, 'email')];
        }

        return $rules;
    }
}
