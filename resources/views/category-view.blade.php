@extends('layouts.main')

@section('content')
<div class="container">
@can('update',\App\Models\Category::class)

    <div class="button-cat-view">
        <a href="{{ route('category-update-form',['category' => $category->code,]) }}"><button type="button" class="btn btn-info">Update</button></a>
        <a href="{{ route('category-delete',['category' => $category->code,]) }}"><button type="button" class="btn btn-danger">Delete</button></a>
    </div>

@endcan
    <main>
        <table class="table table-striped cat-view" >
            <tr>
                <th scope="col" class="text-center">Code </th>
                <th scope="col" class="text-center">Name</th>
                <th scope="col" class="text-center">Description</th>
                <th scope="col" class="text-center">Product list</th>

                @can('update',\App\Models\Location::class)
                <th scope="col" class="text-center">Edit Product list</th>
                @endcan

            </tr>
            <tr>
                <th scope="row" class="text-center">{{ $category->code}}</th>
                <td class="text-center">{{ $category->name}}</td>
                <td class="text-center">{{ $category->description}}</td>
                <td class="btn-add">
                        <a href="{{ route('category-view-product',['category' => $category->code,]) }}" >Product List</a>
                    </button>
                </td>
                @can('update',\App\Models\Location::class)
                <td class="btn-add">
                        <a href="{{ route('category-add-product', [ 'category' => $category->code,]) }}" >Edit product</a>
                    </button>
                </td>
                @endcan
            </tr>
        </table>
    </main>
</div>
@endsection
