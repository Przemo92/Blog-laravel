<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => [
                'required',
                /*$this->route('post') ? Rule::unique('posts')->ignoreModel($this->route('post')) : */'unique:posts'],
            'body' => ['min:3', 'nullable'],
            'published_at' => ['date', 'nullable'],
        ];
    }
}
