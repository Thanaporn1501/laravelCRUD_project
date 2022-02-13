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
        <form action="{{ route('category-create') }}" method="post">
            <div class="table-responsive">
                <h2>Create New Category</h2>
                @csrf
                <div class="form-group">
                    <label for="code">Code</label>
                    <input type="text" class="form-control" name="code" value="{{ old('code')}}" id="code" placeholder="Category code" required>
                </div>
                <div class="form-group">
                    <label for="code">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name')}}" id="name" placeholder="Category name" required>
                </div>
                <div class="form-group">
                    <label for="code">Description</label>
                    <input type="text" class="form-control" name="description" value="{{ old('description')}}" id="description" placeholder="Category description" required>
                </div>
                <button type="submit" name="submit" class="btn btn-success">Create</button>
            </div>
        </form>
    </main>
</div>
@endsection
