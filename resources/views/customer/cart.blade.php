@extends('layouts.app')

@section('body')
<div class="container mx-auto p-4">
    @if($cartItems->isEmpty())
        <p class="text-gray-600">ADD ITEM FIRST TO YOUR CART.</p>
    @else
        <table class="min-w-full bg-white border border-gray-300 mb-4">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Product ID</th>
                    <th class="py-2 px-4 border-b">Quantity</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $item->pivot->product_id }}</td>
                        <td class="py-2 px-4 border-b">{{ $item->pivot->quantity }}</td>
                        <td class="py-2 px-4 border-b">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="flex justify-end">
            <button id="checkoutBtn" class="btn btn-primary">Checkout</button>
        </div>
    @endif
</div>
@endsection
