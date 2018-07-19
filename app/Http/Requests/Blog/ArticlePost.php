<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;

class ArticlePost extends FormRequest
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
            'title'=>'min:3|max:50|required',
            'content'=>'min:3|max:9999|required',
            'tag_id.*'=>'exists:tags,id|null',

        ];
    }


    public function messages()
    {
        return [
            'title.required'=>'标题不能为空',
            'title.min'=>"标题至少三个字符",
            'title:max'=>"标题不能超过50个字符",

            'content.required'=>'内容不能为空',
            'content.min'=>"内容至少三个字符",
            'content.max'=>"超出最大范围9999",

            'tag_id.*.exists:tags,id'=>"你别搞事情啊",
            'tag_id.*.required'=>'标签不能为空'
        ];
    }



}

