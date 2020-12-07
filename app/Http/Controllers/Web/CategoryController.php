<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    
    public function showCateBySlug($cate_slug){
        $categories = Category::available(config('app.status.enable'))->get();
        $products_by_cate_slug = Product::findByCategorySlug($cate_slug, config('app.status.enable'), config('app.status.enable'))->paginate(config('app.pagination.six'));

        return view('web.pages.show_product_by_cate_slug', compact('categories', 'products_by_cate_slug'));
    }
}
