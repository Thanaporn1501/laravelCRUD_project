@extends('layouts.main')

@section('content')
<div class="container cmp">
    <div class="cattype">
        <button type="button" class="btn btn-default btn-sm">
            <a href="{{ route('location-list') }}"><span class="glyphicon glyphicon-chevron-left"></span> Back </a>
        </button>
    </div>

    <div class="cmp-location-view">
        <div class="card w-50">
            <div class="thumbnail">
                <h3 style="text-align:center">{{ $location->name}}</h3>
                <div class="map">
                    {!! Mapper::render() !!}
                </div>
                <div class="location-view">
                    @can('update',\App\Models\Location::class)
                    <p><b>Code :: </b>{{ $location->code}}</p>
                    @endcan

                    <p><b>Time open - Time close :: </b>{{ $location->timeopen}} am - {{ $location->timeclose}} pm</p>
                    <p><b>Tel :: </b>{{ $location->tel}}</p>
                    <p><b>Email :: </b>{{ $location->email}}</p>
                    <p><b>Address :: </b>{{ $location->address}}</p>
                    <a href="{{ route('location-view-product',['location' => $location->code,]) }}"><button type="button" class="btn btn-warning">Show products</button></a>

                    @can('update',\App\Models\Location::class)
                    <a href="{{ route('location-update-form',['location' => $location->code,]) }}"><button type="button" class="btn btn-info">Update</button></a>
                    <a href="{{ route('location-delete',['location' => $location->code,]) }}"><button type="button" class="btn btn-danger">Delete</button></a>
                    @endcan

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
