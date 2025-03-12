<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class   ProductsCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'parent_id',
        'img',
        'desc',
        'in_main',
        'view',
        'slug',
        'first',
        'second',
        'third',

    ];

    protected $casts = [
        'title' => 'array',
        'desc' => 'array',
        'first' => 'array',
        'second' => 'array',
        'third' => 'array'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'products_category_product', 'products_category_id', 'product_id');
    }

    public function parent()
    {
        return $this->hasOne(self::class, 'id', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }
    protected function getParentIds($category)
    {
        $parents = [];
        while ($category->parent_id) {
            $parents[] = $category->parent_id;
            $category = $category->parent; // Kategoriya modeli orqali parent obyektini olish
        }
        return array_reverse($parents); // Teskari tartibda chiqarish uchun
    }


    protected $appends = [
        'lg_img',
        'md_img',
        'sm_img'
    ];

    public function getLgImgAttribute() {
        return $this->img ? url('').'/upload/images/'.$this->img : null;
    }

    public function getMdImgAttribute() {
        return $this->img ? url('').'/upload/images/600/'.$this->img : null;
    }

    public function getSmImgAttribute() {
        return $this->img ? url('').'/upload/images/200/'.$this->img : null;
    }
}
