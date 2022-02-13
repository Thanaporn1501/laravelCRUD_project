@extends('layouts.main')

@section('content')
<div class="container">
    <div class="cattype">
        <button type="button" class="btn btn-default btn-sm"><a href="{{ route('location-view-product',['location'=> $location->code,]) }}">
                <span class="glyphicon glyphicon-chevron-left"></span>Back
        </button></a>
    </div>

    <form action="{{ route('location-add-product', [ 'location' => $location->code,]) }}" method="get" class="search">
        <label>
            <input type="text" name="term" value="{{ $term }}" placeholder="Search.." /></p>
        </label>
    </form>

    <main>
        <form action="{{ route('location-add-product',['location' => $location->code,]) }}" method="post">
            @csrf

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <th>
                            <a href="{{ route('product-view', ['product' => $product-> imgcode]) }}">
                                {{ $product->code}}
                            </a>
                        </th>
                        <td>{{ $product->name }}</td>
                        <td>
                            <button type="submit" name="product" value="{{$product ->id}}" class="btn btn-success">Add</button>
                        </td>
                    </tr>
                    @endforeach
            </table>
        </form>
    </main>
    {{ $products->withQueryString()->links() }}
</div>

@endsection
