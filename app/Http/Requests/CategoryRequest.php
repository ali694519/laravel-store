<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if($this->route('category')) {
              return Gate::allows('categories.update');
        }
        return Gate::allows('categories.update') || Gate::authorize('categories.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
         $id = $this->route('category');
        return Category::rules($id);
    }

    public function message() {
        return [
            'name.unique'=>'This name is already exists!'
        ];
    }
}
