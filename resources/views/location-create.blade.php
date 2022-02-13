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

<div class="container cmp">
    <main>
        <form action="{{ route('location-create') }}" method="post">
            <div class="table-responsive">
                <h2>Create New shop</h2>
                @csrf
                <div class="form-group">
                    <label for="code">Code</label>
                    <input type="text" class="form-control" name="code" id="code" placeholder="Shop code" required>
                </div>
                <div class="form-group">
                    <label for="code">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Shop name" required>
                </div>
                <div class="form-group">
                    <label for="code">Time open (AM)</label>
                    <input type="text" class="form-control" name="timeopen" id="timeopen" placeholder="Shop time open" required>
                </div>
                <div class="form-group">
                    <label for="code">Time close (PM)</label>
                    <input type="text" class="form-control" name="timeclose" id="timeclose" placeholder="Shop time close" required>
                </div>
                <div class="form-group">
                    <label for="code">Tel</label>
                    <input type="text" class="form-control" name="tel" id="tel" placeholder="Shop tel" required>
                </div>
                <div class="form-group">
                    <label for="code">E-mail</label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="Shop email" required>
                </div>
                <div class="form-group">
                    <label for="description">Address</label>
                    <input type="text" class="form-control" name="address" id="address" placeholder="address">
                </div>
                <div class="form-group">
                    <label for="code">Latitude</label>
                    <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Shop latitude" required>
                </div>
                <div class="form-group">
                    <label for="code">Longitude</label>
                    <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Shop longitude" required>
                </div>
                <button type="submit" name="submit" class="btn btn-success">Create</button>
            </div>
        </form>
    </main>
</div>>
    @endsection
