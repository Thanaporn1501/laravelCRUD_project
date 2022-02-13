@extends('layouts.main')

@section('content')
<div class="container cmp">
    <div class="cattype">
        <button type="button" class="btn btn-default btn-sm">
            <a href="{{ route('location-view', ['location' => $location-> code ]) }}"><span class="glyphicon glyphicon-chevron-left"></span> Back </a>
        </button>
    </div>

    @can('update',\App\Models\Location::class)
    <div class="btn-new">
        <a href="{{ route('location-add-product-form',['location'=> $location->code,]) }}"><button type="button" class="btn btn-success">Add Product</button></a>
    </div>
    @endcan

    <main>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    @can('update',\App\Models\Location::class)
                    <th>Action</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <th>
                        {{ $product->code}}
                    </th>
                    <td>{{ $product->name }}</td>
                    @can('update',\App\Models\Location::class)
                    <td>
                        <a href="{{ route('product-remove-location', [
                                'product' => $product-> code,
                                'location' => $location-> code,
                                ]) }}"><button type="button" class="btn btn-danger">Remove</button></a>
                    </td>
                    @endcan
                </tr>
                @endforeach
        </table>
        {{ $products->withQueryString()->links() }}
    </main>
</div>

@endsection
