<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'products';
    protected $primaryKey = 'product_id';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'product_name',
        'product_price',
        'product_slug',
        'product_desc',
        'product_quantity',
        'product_img',
        'product_status',
        'product_viewed',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'cate_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_details', 'order_id', 'product_id');
    }
    
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function scopeAvailable($query, $status)
    {
        return $query->where('product_status', $status);
    }

    public function scopeAvailableLatest($query, $status, $order)
    {
        return $query->where('product_status', $status)->orderBy('product_id', $order);
    }

    public function agvRate(){
        return $this->ratings()
                    ->selectRaw('avg(rate_value) as star, product_id')
                    ->groupBy('product_id');
    }

    public function scopeProductBySlug($query, $slug, $status)
    {
        return $query->where([['product_slug', $slug],['product_status', $status]]);
    }

    public function scopeFindByCategorySlug($query, $cate_slug, $cate_status, $product_status)
    {
        return $query->where('product_status', $product_status)
        ->whereHas('category',  function($query) use ($cate_slug, $cate_status){
            $query->where([['cate_slug', $cate_slug], ['cate_status', $cate_status]]); });
    }

    public function scopeSearchProduct($query, $searchText, $product_status, $cate_status)
    {
        return $query->with('category')->where([
            ['product_status', $product_status], 
            ['product_name', 'LIKE', '%'.$searchText.'%'],
        ])
        ->orWhere('product_desc', 'LIKE', '%'.$searchText.'%')
        ->orWhereHas('category', function($query) use ($searchText){
            $query->where('cate_name', 'LIKE', '%'.$searchText.'%');
        })
        ->whereHas('category', function($query) use ($cate_status){
            $query->where('cate_status', $cate_status);
        });
    }

}
