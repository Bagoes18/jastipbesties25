<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id')->with('parentcategory');
    }

    public static function productsFilters()
    {
        //Product Filter
        $productFilters['fabricArray'] = array('Cotton', 'Polyester', 'Wool');
        $productFilters['sleeveArray'] = array('Full Sleeve', 'Half Sleeve', 'Short Sleeve', 'Sleeveless');
        $productFilters['patternArray'] = array('Checked', 'Plain', 'Printed', 'Self', 'Solid');
        $productFilters['fitArray'] = array('Reguler', 'Slim');
        $productFilters['occasionArray'] = array('Casual', 'Formal');

        return $productFilters;
    }

    public function images()
    {
        return $this->hasMany('App\Models\ProductsImage');

    }
    public function attributes()
    {
        return $this->hasMany('App\Models\ProductsAttribute');

    }
}
