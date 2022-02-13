@extends('layouts.main')

@section('content')
<div class="container">
    <form action="{{ route('location-list')}}" method="get" class="search">
        <label>
            <input type="text" name="term" value="{{ $term }}" placeholder="Search.." /></p>
        </label>
    </form>

    @can('update',\App\Models\Location::class)

    <div class="btn-new">
        <a href="{{ route('location-create-form')}}"><button type="button" class="btn btn-info">New Shop</button></a>
    </div>
    @endcan
    <main>
        <table class="table table-striped">
            <thead>
                <tr>
                    @can('update',\App\Models\Location::class)
                    <th>Code</th>
                    @endcan
                    <th>Name</th>
                    <th>Address</th>
                    <th>Number of products</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($locations as $location)
                <tr>
                    @can('update',\App\Models\Location::class)
                    <th>
                        <a href="{{ route('location-view', [
                            'location' => $location-> code ]) }}">
                            {{ $location->code}}
                        </a>
                    </th>
                    @endcan
                    <td>{{ $location->name }}</td>
                    <td>{{ $location->address }}</td>
                    <td class="number">{{ $location->products_count }}</td>
                    <td>
                        <div class="btn-add">
                            <a href="{{ route('location-view',['location' => $location->code,]) }}">Find us</a></button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</div>

<footer class="footer2">
    <p>&#xA9; Copyright | Flavour Cafe.</p>
</footer>
@endsection
