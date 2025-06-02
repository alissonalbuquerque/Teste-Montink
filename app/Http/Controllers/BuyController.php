<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBuyRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class BuyController extends Controller
{
    /**
     * Create new resource.
     */
    public function create($product_id)
    {   
        $model = Product::findOrFail($product_id);

        return view('buy.create', [
            'model' => $model
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBuyRequest $request)
    {
        $products = Session::get('products');

        $products[$request->variant_id] = ['variant_id' => $request->variant_id, 'units' => $request->units];

        Session::put('products', $products);

        return Redirect::route('product.index');
    }

    /**
     * Display validate from order
     */
    public function order(Request $request)
    {
        dd($request->all());
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
