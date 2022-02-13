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
        <form action="{{ route('product-create') }}" method="post">
            @csrf
            <div class="table-responsive">
                <div class="form-group">
                    <h2>Create New Product</h2>
                    <label for="code">Code</label>
                    <input type="text" class="form-control" name="code" placeholder="Product code">
                </div>
                <div class="form-group">
                    <label for="imagcode">Image</label>
                    <input type="file" accept="image/gif, image/jpeg, image/png" class="form-control" name="imgcode" required>
                </div>
                <div class="form-group">
                    <label for="type">Category</label>
                    <select class="form-control" name="category">
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ ($category->id == old('category'))? 'selected' :'' }}>
                            [{{ $category->code }}] {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Product Name">
                </div>
                <div class="form-group">
                    <label for="type">Price</label>
                    <input type="text" class="form-control" name="price" id="price" placeholder="Price" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" name="description" id="description" placeholder="Description">
                </div>
                <button type="submit" name="submit" class="btn btn-success">Create</button>
            </div>
        </form>
    </main>
</div>
@endsection
