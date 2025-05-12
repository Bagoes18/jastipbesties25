<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function parentcategory()
    {
        return $this->hasOne('App\Models\Category', 'id', 'parent_id')->select('id', 'category_name', 'url')->where('status', 1);
    }

    public function subcategories()
    {
        return $this->hasMany('App\Models\Category', 'parent_id')->where('status', 1);
    }

    public static function getCategories()
    {
        $getCategories = Category::with([
            'subcategories' => function ($query) {
                $query->with('subcategories');
            }
        ])->where('parent_id', 0)->where('status', 1)->get()->toArray();
        return $getCategories;

    }

    // public static function getCategoryDetails($url)
    // {
    //     $getCategoryDetails = Category::select('id', 'parent_id', 'category_name', 'url')->with('subcategories')->where('url', $url)->first()->toArray();
    //     $catIds = array();
    //     $catIds[] = $getCategoryDetails['id'];
    //     foreach ($getCategoryDetails['subcategories'] as $subcat) {
    //         $catIds[] = $subcat['id'];
    //     }
    //     // Fix penulisan breadcrumbs dan concat string
    //     if ($getCategoryDetails['parent_id'] == 0 || $getCategoryDetails['parent_id'] == 1 || $getCategoryDetails['parent_id'] == 2 || $getCategoryDetails['parent_id'] == 3) {
    //         $breadcrumbs = '<a href="' . url($getCategoryDetails['url']) . '">' . $getCategoryDetails['category_name'] . '</a>';
    //     } else {
    //         $parentCategory = Category::select('category_name', 'url')->where('id', $getCategoryDetails['parent_id'])->first()->toArray();
    //         $breadcrumbs = '<a href="' . url($parentCategory['url']) . '">' . $parentCategory['category_name'] . '</a> <span>' . $getCategoryDetails['category_name'] . '</span>';

    //     }

    //     return array('catIds' => $catIds, 'getCategoryDetails' => $getCategoryDetails, 'breadcrumbs' => $breadcrumbs);
    // }

    public static function getCategoryDetails($url)
    {
        $getCategoryDetails = Category::select('id', 'parent_id', 'category_name', 'url')
            ->with('subcategories')
            ->where('url', $url)
            ->first()
            ->toArray();

        $catIds = [];
        $catIds[] = $getCategoryDetails['id'];

        // Tambahkan semua subkategori rekursif
        $subIds = self::getAllSubcategoryIds($getCategoryDetails['id']);
        $catIds = array_merge($catIds, $subIds);

        // Breadcrumbs
        if ($getCategoryDetails['parent_id'] == 0) {
            $breadcrumbs = '<a href="' . url($getCategoryDetails['url']) . '">' . $getCategoryDetails['category_name'] . '</a>';
        } else {
            $parentCategory = Category::select('category_name', 'url')
                ->where('id', $getCategoryDetails['parent_id'])
                ->first()
                ->toArray();

            $breadcrumbs = '<a href="' . url($parentCategory['url']) . '">' . $parentCategory['category_name'] . '</a> <span>' . $getCategoryDetails['category_name'] . '</span>';
        }

        return [
            'catIds' => $catIds,
            'getCategoryDetails' => $getCategoryDetails,
            'breadcrumbs' => $breadcrumbs
        ];
    }

    public static function getAllSubcategoryIds($categoryId)
    {
        $ids = [];
        $subcategories = Category::select('id')->where('parent_id', $categoryId)->where('status', 1)->get();

        foreach ($subcategories as $subcat) {
            $ids[] = $subcat->id;
            $ids = array_merge($ids, self::getAllSubcategoryIds($subcat->id));
        }

        return $ids;
    }

}
