@extends('layouts.main')

@section('content')

@if(session()->has('status'))
<div class="alert alert-success" role="alert">
    <span>{{ session()->get('status')}}</span>
</div>
@endif

@error('input')
<div class="alert alert-danger" role="alert">{{ $message }}</div>
@enderror
<div class="col-sm-10">
    <main class="cmp">
        <form action="{{ route('location-update', ['location' => $location->code,]) }}" method="post">
            @csrf
            <div class="form-group">
                <label for="code">Code</label>
                <input type="text" class="form-control" name="code" value="{{old('code')?? $location->code }}">
            </div>
            <div class="form-group">
                <label for="code">Name</label>
                <input type="text" class="form-control" name="name" value="{{old('code')?? $location->name }}">
            </div>
            <div class="form-group">
                <label for="code">Time open (AM)</label>
                <input type="text" class="form-control" name="timeopen" value="{{old('code')?? $location->timeopen }}" required>
            </div>
            <div class="form-group">
                <label for="code">Time close (PM)</label>
                <input type="text" class="form-control" name="timeclose" value="{{old('code')?? $location->timeclose }}" required>
            </div>
            <div class="form-group">
                <label for="code">tel</label>
                <input type="text" class="form-control" name="tel" value="{{old('code')?? $location->tel }}">
            </div>
            <div class="form-group">
                <label for="code">email</label>
                <input type="text" class="form-control" name="email" value="{{old('code')?? $location->email }}">
            </div>
            <div class="form-group">
                <label for="description">address</label>
                <input type="text" class="form-control" name="address" value="{{old('code')?? $location->address }}">
            </div>
            <div class="form-group">
                <label for="code">Latitude</label>
                <input type="text" class="form-control" name="latitude" value="{{old('code')?? $location->latitude }}">
            </div>
            <div class="form-group">
                <label for="code">Longitude</label>
                <input type="text" class="form-control" name="longitude" value="{{old('code')?? $location->longitude }}">
            </div>

            <button type="submit" name="submit" class="btn btn-success">Update</button>
        </form>
    </main>
</div>
@endsection
