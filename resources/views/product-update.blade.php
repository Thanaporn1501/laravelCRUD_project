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
        <form action="{{ route('product-update', ['product' => $product->code,]) }}" method="post">
            @csrf
            <div class="table-responsive">
                <div class="form-group">
                    <label for="code">Code</label>
                    <input type="text" class="form-control" name="code" value="{{old('code')?? $product->code }}" required>
                </div>
                <div class="form-group">
                    <label for="imagcode">Image</label>
                    <input type="file" class="form-control" name="imgcode" value="{{old('code')?? $product->imgcode }}" required>
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
                    <input type="text" class="form-control" name="name" value="{{old('code')?? $product->name }}" required>
                </div>
                <div class="form-group">
                    <label for="type">Price</label>
                    <input type="text" class="form-control" name="price" value="{{old('code')?? $product->price }}" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" name="description" value="{{old('code')?? $product->description }}" required>
                </div>
                <button type="submit" name="submit" class="btn btn-success">Update</button>
            </div>
        </form>
    </main>
</div>
@endsection
