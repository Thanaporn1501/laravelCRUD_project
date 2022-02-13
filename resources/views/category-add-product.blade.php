@extends('layouts.main')

@section('content')
<div class="container">
    <div class="cattype">
        <button type="button" class="btn btn-default btn-sm">
            <a href="{{ route('category-view', [ 'category' => $category->code,]) }}"> <span class="glyphicon glyphicon-chevron-left"></span> Back</a></button>
    </div>

    <form action="{{ route('category-add-product', [ 'category' => $category->code,]) }}" method="get" class="search">
        <label>
            <input type="text" name="term" value="{{ $term }}" placeholder="Search.." /></p>
        </label>
    </form>

    <main>
        <form action="{{ route('category-add-product',['category' => $category->code,]) }}" method="post">
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
                        <th>{{ $product->code}}</th>
                        <td>{{ $product->name }}</td>
                        <td>
                            <button type="submit" name="product" value="{{$product->id}}" class="btn btn-success">Add</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
        {{ $products->withQueryString()->links() }}
    </main>
</div>
@endsection
