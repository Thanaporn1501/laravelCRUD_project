@extends('layouts.main')

@section('content')
<div class="container">
    <div class="cattype">
        <button type="button" class="btn btn-default btn-sm">
            <a href="{{ route('product-list') }}"><span class="glyphicon glyphicon-chevron-left"></span> Back </a>
        </button>
    </div>

    <main>
        <div class="product-view">
            <div class="col-lg-8">
                <div class="thumbnail">
                    <h3 align="center">{{ $product->name}}</h3>
                    <img src="{{ asset("images/products/{$product['imgcode']}") }}" alt="The image of {{ $product['imgcode'] }}." /></br>
                    <p><b> Code ::</b> {{ $product->code}}</p>
                    <P><b>Price ::</b> {{ $product->price}} ฿</p>
                    <P><b>Description</b> :: {{ $product->description}}</p>

                    @can('update',\App\Models\Product::class)
                    <a href="{{ route('product-update-form',['product' => $product->code,]) }}"><button type="button" class="btn btn-info">Update</button></a>
                    <a href="{{ route('product-delete',['product' => $product->code,]) }}"><button type="button" class="btn btn-danger">Delete</button></a>
                    @endcan

                    <a href="{{ route('product-view-location',['product' => $product->code,]) }}"><button type="button" class="btn btn-warning">Show Shops</button></a>
                </div>
            </div>
        </div>
    </main>
</div>


<footer class="footer2">
    <p>&#xA9; Copyright | Flavour Cafe.</p>
</footer>

@endsection
