@extends('layouts.master')
@section('title', trans('master.title'))
@section('content')

<section>
    <div class="container">
        <div class="row">

            {{-- include category blade --}}
            @include('include.category')
            @include('common.message')
            <div class="col-sm-9 padding-right">
                <div class="features_items">
                    <!--features_items-->
                    <h2 class="title text-center">@lang('master.all_items')</h2>
                @if(isset($listSearch) && !empty($listSearch))
                    @foreach($listSearch as $product)

                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <form action="" method="">
                                            {{ csrf_field() }}
                                            <input type="hidden" class="cart_product_id_{{ $product->product_id }}"
                                                value="{{ $product->product_id }}">
                                            <input type="hidden" class="cart_product_name_{{ $product->product_id }}"
                                                value="{{ $product->product_name }}">
                                            <input type="hidden" class="cart_product_price_{{ $product->product_id }}"
                                                value="{{ $product->product_price }}">
                                            <input type="hidden" class="cart_product_img_{{ $product->product_id }}"
                                                value="{{ $product->product_img }}">
                                            <input type="hidden" class="cart_product_desc_{{ $product->product_id }}"
                                                value="{{ $product->product_desc }}">
                                            <input type="hidden" class="cart_product_qty_{{ $product->product_id }}" value="1">
                                            
                                            <a
                                                href="{{ route('products.showProductDetails', $product->product_slug) }}">
                                            @if($product->product_img != null && file_exists(public_path().'/images/'.$product->product_img))
                                                <img src="/images/{{ $product->product_img }}"/>
                                            @else
                                                <img src="/images/default-product.png"/>
                                            @endif                                               
                                                <h2>{{ number_format($product->product_price) }} USD</h2>
                                                <h4><b>{{ $product->product_name }}</b></h4>
                                                <p>{{ $product->product_desc }}</p>
                                            </a>
                                            <button url="{{ route('cart.store') }}" data-url="{{ route('cart.index') }}" data-id="{{ $product->product_id }}" type="button"
                                                class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>
                                                @lang('master.add_to_cart.name')
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                @endif
                    <div class="col-sm-12">{!! $listSearch->links() !!}</div>
                </div>
                <!--features_items-->
            </div>
        </div>
    </div>
</section>

@endsection
