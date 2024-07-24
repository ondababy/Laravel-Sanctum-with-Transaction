@extends('layouts.app')
@section('body')
<a href="{{ route('cart.items') }}" class="nav-link-item">
    <i class="fas fa-shopping-cart icon"></i>
    <span class="text nav-text">Cart</span>
</a>
<div class="container container-fluid" id="items">
@endsection
