@extends('layouts.main')

@section('content')
<div class="container">
    <div  class="cattype" >
        <button type="button" class="btn btn-default btn-sm">
        <a href="{{ route('product-view', ['product' => $product-> imgcode]) }}"><span class="glyphicon glyphicon-chevron-left"></span> Back </a>
        </button>
    </div>

        @can('update',\App\Models\Product::class)
            <div class="btn-new">
                <a href="{{ route('product-add-location-form',['product'=> $product->code,]) }}">
                    <button type="button" class="btn btn-success">Add location</button></a>
            </div>
        @endcan

        <table class="table table-striped">
            <thead>
                <tr>
                @can('update',\App\Models\Product::class)
                    <th>Code</th>
                    @endcan
                    <th>Name</th>
                    <th>Address</th>
                    @can('update',\App\Models\Product::class)
                    <th>&nbsp;</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
            @foreach($locations as $location)
                <tr>
                @can('update',\App\Models\Product::class)
                    <th>
                        <a href="{{ route('location-view', ['location' => $location-> code]) }}">
                            {{ $location->code}}
                        </a>
                    </th>
                    @endcan
                    <td><a href="{{ route('location-view',['location' => $location->code,]) }}">{{ $location->name }}</a></td>
                    <td>{{ $location->address }}</td>
                    @can('update',\App\Models\Product::class)
                    <td>
                        <a href="{{ route('product-remove-location', ['product' => $product-> code,
                            'location' => $location-> code,]) }}">
                            <button type="button" class="btn btn-danger">Remove</button></a>
                    </td>
                    @endcan
                </tr>
            @endforeach
            </tbody>
        </table>
</div>

@endsection



