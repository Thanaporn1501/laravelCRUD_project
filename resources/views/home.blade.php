@extends('layouts.main')

@section('title')

@section('content')
<main>
<div class="clearfix"></div>

    <header class="header">
        <div class="container">
            <div class="header_area">

            </div>
        </div>
    </header>

    <section class="info1">
        <div class="container">
            <div class="info1_area">
                <img src="img/pic1.jpg">
                <div class="info1_text">
                    <h2><a href="{{ route('product-list')}}" class="linkhome">CLICK </h2>
                </div>
            </div></a>
        </div>
    </section>

    <div class="clearfix"></div>
</main>
<footer class="home">
    <p>&#xA9; Copyright | Flavour Cafe.</p>
</footer>

@endsection
