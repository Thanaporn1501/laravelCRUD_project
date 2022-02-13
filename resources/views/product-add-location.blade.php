@extends('layouts.main')

@section('content')
<div class="container">
    <div  class="cattype" >
        <button type="button" class="btn btn-default btn-sm">
            <a href="{{ route('product-view-location',['product' => $product->code,]) }}"><span class="glyphicon glyphicon-chevron-left"></span> Back </a>
        </button>
    </div>

        <form action="{{ route('product-add-location', [ 'product' => $product->code,]) }}" method="get" class ="search">
            <label>
                <input type="text" name="term" value="{{ $term }}" placeholder="Search.." /></p>
            </label>
        </form>

    <main>
        <form action="{{ route('product-add-location',['product' => $product->code,]) }}" method="post">
            @csrf

                <table class="table table-dark table-striped">
                    <thead>
                            <th>Name</th>
                            <th>Shop</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($locations as $location)
                        <tr>

                            <td>{{ $location->name }}</td>
                            <td>{{ $location->address }}</td>
                            <td>
                                <button type="submit" name="location" value="{{$location ->id}}"  class="btn btn-success">Add</button>
                            </td>
                        </tr>
                    @endforeach
                </table>

            {{ $locations->withQueryString()->links() }}
        </form>
    </main>
</div>
@endsection
