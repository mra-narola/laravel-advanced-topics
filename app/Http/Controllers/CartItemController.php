<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $content = session()->has('cart') ? session()->get('cart') : collect([]);
        $total = $content->reduce(function ($total, $item) {
            return $total += $item->get('price') * $item->get('quantity');
        });

        return view('cart.index', [
            'content' => $content,
            'total' => $total,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        $cartItem = collect([
            'name' => $request->name,
            'price' => floatval($request->price),
            'quantity' => intval($request->quantity),
            'options' => $request->options,
        ]);

        $content = session()->has('cart') ? session()->get('cart') : collect([]);

        $id = request('id');

        if ($content->has($id)) {
            $cartItem->put('quantity', $content->get($id)->get('quantity') + $request->quantity);
        }

        $content->put($id, $cartItem);

        session()->put('content', $content);
        return back()->with('success', 'Item added to cart');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $content = session()->get('cart');

        if ($content->has($id)) {
            $item = $content->get($id);

            return view('cart', compact('item'));
        }

        return back()->with('fail', 'Item not found');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $content = session()->get('cart');

        if ($content->has($id)) {
            $cartItem = $content->get($id);

            switch ($request->action) {
                case 'plus':
                    $cartItem->put('quantity', $content->get($id)->get('quantity') + 1);
                    break;
                case 'minus':
                    $updatedQuantity = $content->get($id)->get('quantity') - 1;

                    if ($updatedQuantity < 1) {
                        $updatedQuantity = 1;
                    }

                    $cartItem->put('quantity', $updatedQuantity);
                    break;
            }

            $content->put($id, $cartItem);

            session()->put('cart', $content);

            return back()->with('success', 'Item updated in cart');
        }

        return back()->with('fail', 'Item not found');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $content = session()->get('cart');

        if ($content->has($id)) {
            session()->put('cart', $content->except($id));

            return back()->with('success', 'Item removed from cart');
        }

        return back()->with('fail', 'Item not found');
    }
}
