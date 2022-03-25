<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;

class NewCartItemController extends Controller
{
    protected $cartService;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $content = $this->cartService->content();
            $total = $this->cartService->total();

            return view('cart.index', [
                'content' => $content,
                'total' => $total,
            ]);
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  \App\Http\Requests\CartItemRequest  $request
         * @return \Illuminate\Http\Response
         */
        public function store(CartItemRequest $request)
        {
            $this->cartService->add($request->id, $request->name, $request->price, $request->quantity, $request->options);

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
            $content = $this->cartService->content();

            $item = $content->get($id);

            return view('cart', compact('item'));
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
            $this->cartService->update($id, $request->id);

            return back()->with('success', 'Item updated in cart');
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            $this->cartService->remove($id);

            return back()->with('success', 'Item removed from cart');
        }
}
