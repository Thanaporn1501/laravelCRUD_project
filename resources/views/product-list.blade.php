@extends('layouts.main')

@section('content')

<div class="container">
    <form action="{{ route('product-list')}}" method="get" class="search">
        <label>
            <input type="text" name="term" value="{{ $term }}" placeholder="Search.." /></p>
        </label>
    </form>

    @can('update',\App\Models\Product::class)
    <div class="btn-new">
        <a href="{{ route('product-create')}}"><button type="button" class="btn btn-info">New Product</button></a>
    </div>
    @endcan

    <main>
        <p class="all-menu">All menu </p>
        @foreach($products as $product)
            <div class="col-md-4">
                <div class="thumbnail">
                    <a href="{{ route('product-view', ['product' => $product-> imgcode]) }}">
                        <img src="{{ asset("images/products/{$product['imgcode']}") }}" alt="The image of {{ $product['imgcode'] }}." />
                    </a>
                    <div class="caption">
                        <p>{{ $product->name}} ({{ $product->category->name }})</p>
                        <p>{{ $product->price}} ฿</p>
                    </div>
                    <div class="btn-add">
                        <a href="{{ route('product-view', ['product' => $product-> imgcode]) }}">Detail</a>
                    </div>
                </div>
            </div>
        @endforeach
    </main>
    {{ $products->withQueryString()->links() }}
</div>

<footer class="footer2">
    <p>&#xA9; Copyright | Flavour Cafe.</p>
</footer>

@endsection
