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
        <form action="{{ route('category-update', [
        'category' => $category->code,]) }}" method="post">
            @csrf
            <div class="form-group">
                <label for="code">Code</label>
                <input type="text" class="form-control" name="code" value="{{old('code')?? $category->code }}" id="code" required>
            </div>
            <div class="form-group">
                <label for="code">Name</label>
                <input type="text" class="form-control" name="name" value="{{old('code')?? $category->name }}" id="name" required>
            </div>
            <div class="form-group">
                <label for="code">tel</label>
                <input type="text" class="form-control" name="description" value="{{old('code')?? $category->description }}" id="description" required>
            </div>
            <button type="submit" name="submit" class="btn btn-success">Update</button>
        </form>
    </main>
</div>
@endsection
