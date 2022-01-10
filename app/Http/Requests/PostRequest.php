<?php

namespace App\Http\Requests;

use App\Models\Post;
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
        $post ??= new Post();

        return [
            'title'      => 'required',
			'slug'       => ['required', Rule::unique('posts', 'slug')->ignore($post->id)],
			'thumbnail'  => $post->exists ? ['image'] : ['image'],
			'excerpt'    => 'required',
			'body'       => 'required',
			'category_id'=> ['required', Rule::exists('categories', 'id')],
        ];
    }
}
