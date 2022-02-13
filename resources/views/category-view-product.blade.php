@extends('layouts.main')

@section('content')

<div class="container">
    <div class="cattype">
        <p>{{ $category->name}}</p>
        <button type="button" class="btn btn-default btn-sm">
            <a href="{{ route('category-list') }}">
                <span class="glyphicon glyphicon-chevron-left"></span>Back
            </a>
        </button>
    </div>

    <main>
        @foreach($products as $product)
        <div class="col-md-4">
            <div class="thumbnail">
                <a href="{{ route('product-view', ['product' => $product-> imgcode]) }}">
                    <img src="{{ asset("images/products/{$product['imgcode']}") }}" alt="The image of {{ $product['imgcode'] }}." />
                </a>
                <div class="caption">
                    <p><a href="{{ route('product-view', ['product' => $product-> imgcode]) }}">
                            {{ $product->code}}
                        </a>
                    </p>
                    <p><a href="{{ route('product-view', ['product' => $product-> imgcode]) }}">{{ $product->name }}</a></p>
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
