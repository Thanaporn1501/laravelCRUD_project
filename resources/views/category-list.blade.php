@extends('layouts.main')

@section('content')

<div class="container">

    @can('update',\App\Models\Category::class)
    <div class="btn-new">
        <a href="{{ route('category-create-form')}}"><button type="button" class="btn btn-info">New Category</button></a>
    </div>
    @endcan

    <main>
        <table class="table table-striped cat-list">
            <thead>
                <tr>
                    @can('update',\App\Models\Location::class)
                    <th class="text-center">Code</th>
                    @endcan
                    <th class="text-center">Name</th>
                    <th class="text-center">Number of Products</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    @can('update',\App\Models\Location::class)
                    <td class="text-center">
                        <a href="{{ route('category-view-product',['category' => $category->code,]) }}">
                            {{ $category->code}}
                        </a>
                    </td>
                    @endcan
                    <td class="text-center">
                        <a href="{{ route('category-view-product',['category' => $category->code,]) }}">
                            {{ $category->name }}
                    </td class="text-center">
                    <td class="text-center">{{ $category->products_count }}</td>
                    <td class="text-center">
                        <div class="btn-add">
                            <a href="{{ route('category-view',['category' => $category->code,]) }}">Detail</a></button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </main>
    {{ $categories->withQueryString()->links() }}
</div>

<footer class="footer2">
    <p>&#xA9; Copyright | Flavour Cafe.</p>
</footer>

@endsection
