<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class CustomerRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|string|max:50',
            'password' => [
                'required',
                'max:15',
                Password::min(6)->mixedCase()->numbers()->symbols()
            ],
            'company_name' => 'required|max:30',
            'pic' => 'required|max:30',
            'address' => 'required',
            'phone' => 'required|max:20',
            'logo' => 'image|file|max:1024',
        ];
    }
}
