<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'password' => 'required|string|min:5',
            'image' => 'required',
            'text' => 'required|string',
            'age' => 'required|numeric|min:18|max:20',
            'hobby' => 'required|string',
            'role'=>'required|numeric|min:0|max:100',
        'gender_id'=>'required|numeric|min:1|max:2',
        ];
    }

    public function message()
    {
        return [
            'name.required' => '名前を入力してください。',
            'email.required' => 'メールアドレスを入力してください。',
            'password.required' => 'パスワードを入力してください。',
            'image.required' => '画像を入れてください。',
            'text.required' => '自己紹介文を書いてください。',
            'age.required' => '年齢を入力してください。',
            'hobby.required' => '趣味を入力してください。',
            'role.required' => '権限を入力してください。',
            'gender_id.required'=>'性別を選択してください。'
        ];
    }
}
