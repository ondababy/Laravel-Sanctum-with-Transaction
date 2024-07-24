<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{

    public function index()
    {
        $items = Product::all();
        return response()->json($items);
    }

    public function addtoCart(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        $cartItem = $user->products()->where('product_id', $product_id)->first();

        if ($cartItem) {
            $user->products()->updateExistingPivot($product_id, ['quantity' => $cartItem->pivot->quantity + $quantity]);
        } else {
            $user->products()->attach($product_id, ['quantity' => $quantity]);
        }
        $updatedCartItem = $user->products()->where('product_id', $product_id)->first();

        return response()->json(['message' => 'Product added to cart!', 'cartItem' => $updatedCartItem]);
    }


    // public function checkout(Request $request)
    // {
    //     $auth = Auth::user();

    //     if (!$auth) {
    //         return response()->json(['message' => 'User not authenticated'], 401);
    //     }

    //     $userId = $auth->id;
    //     $userAddress = $auth->customer->address;

    //     try {
    //         DB::beginTransaction();

    //         $order = new Order();
    //         $order->user_id = $userId;
    //         $order->shipping_address = $userAddress;
    //         $order->save();

    //         $cartItems = DB::table('customer_products')
    //             ->where('user_id', $userId)
    //             ->get();

    //         foreach ($cartItems as $cartItem) {
    //             $product = Product::findOrFail($cartItem->product_id);

    //             $product->stock -= $cartItem->quantity;
    //             $product->save();

    //             $order->products()->attach($product->id, [
    //                 'quantity' => $cartItem->quantity,
    //                 'order_id' => $order->id,
    //             ]);
    //         }

    //         DB::table('customer_products')
    //             ->where('user_id', $userId)
    //             ->delete();

    //         DB::commit();

    //         return response()->json([
    //             'status' => 'Order Success',
    //             'code' => 200,
    //             'orderId' => $order->id,
    //         ]);
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         Log::error('Checkout error: ' . $e->getMessage());
    //         return response()->json([
    //             'status' => 'Order Failed',
    //             'code' => 500,
    //             'error' => $e->getMessage(),
    //         ]);
    //     }
    // }

    public function checkout(Request $request)
    {
        $auth = Auth::user();

        if (!$auth) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        $userId = $auth->id;
        $userAddress = $auth->customer->address;

        DB::beginTransaction();

        $order = new Order();
        $order->user_id = $userId;
        $order->shipping_address = $userAddress;
        $order->save();

        $cartItems = DB::table('customer_products')
            ->where('user_id', $userId)
            ->get();

        foreach ($cartItems as $cartItem) {
            $product = Product::findOrFail($cartItem->product_id);

            $product->stock -= $cartItem->quantity;
            $product->save();

            $order->products()->attach($product->id, [
                'quantity' => $cartItem->quantity,
                'order_id' => $order->id,
            ]);
        }

        DB::table('customer_products')
            ->where('user_id', $userId)
            ->delete();

        // Commit the transaction
        DB::commit();

        return response()->json([
            'status' => 'Order Success',
            'code' => 200,
            'orderId' => $order->id,
        ]);
    }



    public function getCartItems()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'User not authenticated');
        }

        $cartItems = $user->products()->withPivot('quantity')->get();
        return view('customer.cart', ['cartItems' => $cartItems]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
