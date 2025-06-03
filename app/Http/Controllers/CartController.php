<?php

namespace App\Http\Controllers;

use App\Models\Frete;
use App\Models\Variant;
use App\Models\VirtualProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Create a newly resource.
     */
    public function create()
    {
        $collection = Session::has('products') ? Collection::make(Session::get('products'))
                                                                ->map(fn(array $data) => VirtualProduct::create($data)) : Collection::make([]);
        
        if($collection->isNotEmpty()) {
            
            $vproduct = VirtualProduct::vProductReduced($collection);

            $collection->push($vproduct);
        }

        return view('cart.create', [
            'collection' => $collection
        ]);
    }

    /**
     * Create a newly resource.
     */
    public function order(Request $request)
    {
        $orders = $request->get('items', []);

        $collection = !empty($orders) ? Collection::make($orders)->map(fn(array $data) => VirtualProduct::create($data)) : Collection::make([]);

        $order = [
            'subtotal' => "0.00",
            'fmt_subtotal' => "R$ 0,00"
        ];

        if($collection->isNotEmpty()) {
            
            $vproduct = VirtualProduct::vProductReduced($collection);

            $collection->push($vproduct);

            $order = [
                'subtotal'     => $vproduct->subtotal,
                'fmt_subtotal' => $vproduct->fmt_subtotal,
            ];
        }

        return view('cart.order', [
            'order' => $order,
            'collection' => $collection,
        ]);
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
