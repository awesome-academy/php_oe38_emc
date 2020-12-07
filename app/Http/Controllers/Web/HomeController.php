<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index(){
        $categories = Category::available(config('app.status.enable'))->get();
        $all_product = Product::availableLatest(config('app.status.enable'), config('app.order.latest'))->paginate(config('app.pagination.six'));

        return view('home', compact('all_product', 'categories'));
    }

    public function search(Request $request)
    {
        $categories = Category::available(config('app.status.enable'))->get();
        $searchText = $request->search_home;

        if(!empty($searchText))
        {
            $listSearch = Product::searchProduct($searchText, config('app.status.enable'), config('app.status.enable'))
            ->paginate(config('app.pagination.six'));

            return view('web.pages.search', compact('listSearch', 'categories'));
        }
        
        Session::flash('error', trans('master.message.error'));

        return redirect()->back();
    }
    
}
