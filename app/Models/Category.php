<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Category extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = [
        'name','parent_id','image','status','slug','description'
    ];

    public function parent() {
        return $this->belongsTo(Category::class,'parent_id','id')
        ->withDefault([
            'name'=>'-'
        ]);
    }

    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

      public function children() {
        return $this->hasMany(Category::class,'parent_id','id');
    }

    public function products() {
        return $this->hasMany(Product::class,'category_id','id');
    }
    //local Scope
    // public function scopeActive(Builder $builder) {
    //     $builder->where('status','=','active');
    // }

    public function scopeFilter(Builder $builder ,$filters) {

        $builder->when($filters['name'] ?? false ,function($builder,$value) {
            $builder->where('categories.name','LIKE',"%{$value}%");
        });
        $builder->when($filters['status'] ?? false ,function($builder,$value) {
           $builder->where('categories.status','=',$value);
        });

    }

    public static function rules($id = 0) {
        return [
            'name'=>[
                'required',
                'string',
                'min:2',
                'max:255',
                //unique:categories,name,$id,
                Rule::unique('categories','name')->ignore($id),
                'filter:php'
            ],
            'parent_id'=>[
               'nullable','int','exists:categories,id'
            ],
            'image'=>[
                // 'image','max:1048576','dimension:min_width=100,min_height=100',
                'image',
            ],
            'status'=>'required|in:active,archived',
        ];
    }

}
